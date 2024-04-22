import {EventService} from "../../services/event.service";

declare var google: any;
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
  templateUrl: './socials-authentication.component.html',
  styleUrl: './socials-authentication.component.css'
})
export class SocialsAuthenticationComponent implements AfterViewInit {
  //public google: any;
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
  private decodeToken(token: string) {
    return JSON.parse(atob(token.split(".")[1]))
  }

  /**
   * Makes the request to the server that then handles authentication
   *
   * @param res
   * @private
   */
  private handleGoogleLogin(res: any) {
    if (res) {
      const data = this.decodeToken(res.credential)
      this.authService.authenticateSocials(data).subscribe(
        (res: any) => {
          if (res && res.data && res.data.token !== undefined) {
            this.authService.setData(res.data);

            this.eventService.authenticateSocials(data).subscribe(
              (res2: any) => {
                if (res && res.data && res.data.token !== undefined) {
                  this.eventService.setData(res.data);
                  this.router.navigate(['dashboard']);
                }
              },
              (error2: any) => {
                this.errors[1] = 'Server not responding';
              }
            );
          }
        },
        (error: any) => {
          this.errors[0] = 'Server not responding';
        }
      );
    }
  }
}
