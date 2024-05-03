declare var google: any;
import {EventService} from "../../services/event.service";
import {AfterViewInit, Component, NgZone, OnInit} from '@angular/core';
import { environment } from "../../../environments/environment";
import { AuthService } from "../../services/auth.service";
import { Router } from "@angular/router";
import { ErrorsComponent } from "../../components/subcomponents/errors/errors.component";

@Component({
  selector: 'notes-socials-authentication',
  standalone: true,
  imports: [
    ErrorsComponent
  ],
  templateUrl: './socials-authentication.component.html'
})
export class SocialsAuthenticationComponent implements AfterViewInit {
  protected errors: { [key: string]: string } = {};

  constructor(private authService: AuthService, private eventService: EventService, private router: Router, private ngZone: NgZone) {}

  ngAfterViewInit() {
    google.accounts.id.initialize({
      client_id: environment.google_client_id,
      callback: (res: any) => this.ngZone.run(() => this.handleGoogleLogin(res))
    });

    google.accounts.id.renderButton(document.getElementById("google-btn"), {
      theme: 'outline',
      size: 'medium',
      shape: 'rectangle'
    });
  }

  /**
   * Decodes the JWT request and extracts the data
   *
   * @param token
   * @private
   */
  private decodeToken(token: string): string {
    return JSON.parse(atob(token.split(".")[1]))
  }

  /**
   * Makes the request to the server that then handles authentication
   *
   * @param res
   * @private
   */
  private handleGoogleLogin(res: any): void {
    const data = this.decodeToken(res.credential);

    this.authService.authenticateSocials(data).subscribe({
      next: (res: any) => {
        this.authService.setData(res.data);

        this.eventService.authenticateSocials(data).subscribe({
          next: (res2: any) => {
              this.eventService.setData(res2.data);
              this.router.navigate(['dashboard']);
          },
          error: (err2: any) => {
            if (err2.status === 401) {
              this.errors[1] = err2.message;
            } else {
              this.errors[1] = 'Events server not responding';
            }
          }
        });
      },
      error: (err: any) => {
        if (err.status === 401) {
          this.errors[0] = err.message;
        } else {
          this.errors[0] = 'Notes server not responding';
        }
      }
    });
  }
}
