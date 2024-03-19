import { Component } from '@angular/core';
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { AuthService } from "../../services/auth.service";
import { EventService } from "../../services/event.service";
import {NgIf} from "@angular/common";
import {ErrorsComponent} from "../../components/subcomponents/errors/errors.component";

@Component({
  selector: 'notes-register',
  standalone: true,
  imports: [
    RouterLink,
    ReactiveFormsModule,
    NgIf,
    ErrorsComponent
  ],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {
  public registerForm!: FormGroup;
  protected errors: string[] = [];

  constructor(private formBuilder: FormBuilder, private authService: AuthService, private eventService: EventService, private router: Router) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required]
    });
  }

  /**
   * Creates new accounts on both mine and Kristjan's site, and stores the given tokens
   */
  register(): void {
    this.errors = [];
    this.authService.register(this.registerForm.value).subscribe(
      (res: any) => {
        if (res && res.data && res.data.token !== undefined) {
          this.authService.setData(res.data);
        } else {
          this.errors[0] = (res.message);
        }
      },
      (error: any) => {
        this.errors[1] = 'Server not responding';
      }
    );

    this.eventService.register(this.registerForm.value).subscribe(
        (res: any) => {
          if (res && res.data && res.data.token !== undefined) {
            this.registerForm.reset();
            this.eventService.setData(res.data);
            this.router.navigate(['dashboard']);
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
