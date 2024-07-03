import {Component, OnInit} from '@angular/core';
import { AuthService } from "../../services/auth.service";
import { Router, RouterLink } from "@angular/router";
import { AbstractControl, FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { EventService } from "../../services/event.service";
import { NgIf } from "@angular/common";
import { ErrorsComponent } from "../../components/subcomponents/errors/errors.component";
//import { SocialsAuthenticationComponent } from "../socials-authentication/socials-authentication.component";


@Component({
  selector: 'notes-login',
  standalone: true,
  imports: [
    RouterLink,
    ReactiveFormsModule,
    NgIf,
    ErrorsComponent,
    //SocialsAuthenticationComponent,
  ],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent implements OnInit {
  public loginForm!: FormGroup;
  protected errors: { [key: string]: string } = {};
  protected submitted: boolean = false;

  constructor(private authService: AuthService, private eventService: EventService, private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  get f(): { [key: string]: AbstractControl } {
    return this.loginForm.controls;
  }

  /**
   * Authenticates an already existing user by fetching tokens from both my and Kristjan's server and storing them
   */
  protected login(): void {
    this.submitted = true;

    if (this.loginForm.invalid) {
      return;
    }

    this.errors = {};
    this.authService.login(this.loginForm.value).subscribe({
      next: (res: any) => {
        this.authService.setData(res.data);

        this.eventService.login(this.loginForm.value).subscribe({
          next: (res2: any) => {
            this.loginForm.reset();
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
