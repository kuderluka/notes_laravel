import { Component} from '@angular/core';
import { Router, RouterLink } from "@angular/router";
import { AbstractControl, FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { AuthService } from "../../services/auth.service";
import { EventService } from "../../services/event.service";
import { NgClass, NgIf } from "@angular/common";
import { ErrorsComponent } from "../../components/subcomponents/errors/errors.component";
import { SocialsAuthenticationComponent } from "../socials-authentication/socials-authentication.component";

@Component({
  selector: 'notes-register',
  standalone: true,
  imports: [
    RouterLink,
    ReactiveFormsModule,
    NgIf,
    ErrorsComponent,
    NgClass,
    SocialsAuthenticationComponent
  ],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {
  public registerForm!: FormGroup;
  protected errors: { [key: string]: string } = {};
  protected submitted: boolean = false;

  constructor(private formBuilder: FormBuilder, private authService: AuthService, private eventService: EventService, private router: Router) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required]
    });
  }

  get f(): { [key: string]: AbstractControl } {
    return this.registerForm.controls;
  }

  /**
   * Creates new accounts on both mine and Kristjan's site, and stores the given tokens
   */
  register(): void {
    this.submitted = true;

    if (this.registerForm.invalid) {
      return;
    }

    this.errors = {};
    this.authService.register(this.registerForm.value).subscribe({
      next: (res: any) => {
        this.authService.setData(res.data);

        this.eventService.register(this.registerForm.value).subscribe({
          next: (res2: any) => {
            this.registerForm.reset();
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
