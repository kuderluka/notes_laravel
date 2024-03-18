import { Component } from '@angular/core';
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { AuthService } from "../../services/auth.service";
import { EventService } from "../../services/event.service";

@Component({
  selector: 'notes-register',
  standalone: true,
  imports: [
    RouterLink,
    ReactiveFormsModule
  ],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {
  public registerForm!: FormGroup;

  constructor(private formBuilder: FormBuilder, private authService: AuthService, private eventService: EventService, private router: Router) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
      password_confirmation: ['', Validators.required]
    });
  }

  /*
    Creates new accounts on both mine and Kristjan's site, and stores the given tokens
   */
  register(): void {
    this.authService.register(this.registerForm.value).subscribe(
      (res: any) => {
        if (res && res.data && res.data.token !== undefined) {
          this.authService.setData(res.data);
        } else {
          console.error(res);
        }
      },
      (error: any) => {
        console.error(error);
      }
    );

    this.eventService.register(this.registerForm.value).subscribe(
        (res: any) => {
          if (res && res.data && res.data.token !== undefined) {
            this.registerForm.reset();
            this.eventService.setData(res.data);
            this.router.navigate(['dashboard']);
          } else {
            console.error(res);
          }
        },
        (error: any) => {
          console.error(error);
        }
    );
  }
}
