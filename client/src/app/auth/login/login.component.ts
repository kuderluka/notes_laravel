import { Component } from '@angular/core';
import { AuthService } from "../../services/auth.service";
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { EventService } from "../../services/event.service";
import {NgIf} from "@angular/common";
import {ErrorsComponent} from "../../components/subcomponents/errors/errors.component";

@Component({
  selector: 'notes-login',
  standalone: true,
  imports: [
    RouterLink,
    ReactiveFormsModule,
    NgIf,
    ErrorsComponent
  ],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  public loginForm!: FormGroup;
  protected errors: { [key: string]: string } = {};

  constructor(private authService: AuthService,private eventService: EventService, private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  /**
   * Authenticates an already existing user by fetching tokens from both my and Kristjan's server and storing them
   */
  login(): void {
    this.errors = {};
    this.authService.login(this.loginForm.value).subscribe(
        (res: any) => {
          if (res && res.data && res.data.token !== undefined) {
            this.authService.setData(res.data);

            this.eventService.login(this.loginForm.value).subscribe(
              (res2: any) => {
                if (res && res.data && res.data.token !== undefined) {
                  this.loginForm.reset();
                  this.eventService.setData(res.data);
                  this.router.navigate(['dashboard']);
                } else {
                  this.errors[0] = (res.message);
                }
              },
              (error2: any) => {
                this.errors[1] = 'Server not responding';
              }
            );
          } else {
            this.errors[0] = (res.message);
          }
        },
        (error: any) => {
          this.errors[1] = 'Server not responding';
        }
    );
  }
}
