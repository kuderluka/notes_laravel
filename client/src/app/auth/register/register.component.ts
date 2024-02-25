import { Component } from '@angular/core';
import { Router, RouterLink } from "@angular/router";
import { FormGroup, FormBuilder, ReactiveFormsModule } from "@angular/forms";
import { AuthService } from "../../services/auth.service";
import {EventService} from "../../services/event.service";

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

  constructor(private formBuilder: FormBuilder, private service: AuthService, private eventService: EventService, private router: Router) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: [''],
      email: [''],
      password: [''],
      password_confirmation: ['']
    });
  }

  register() {
    this.service.logout();
    this.service.register(this.registerForm.value).subscribe(
      (res: any) => {
        if (res && res.data && res.data.token !== undefined) {
          this.service.setData(res.data);
          console.log(this.service.getToken());
        } else {
          console.error(res);
        }
      },
      (error: any) => {
        console.error(error);
      }
    );

    this.eventService.logout();
    this.eventService.register(this.registerForm.value).subscribe(
        (res: any) => {
          if (res && res.data && res.data.token !== undefined) {
            this.registerForm.reset();
            this.eventService.setData(res.data);
            console.log(this.eventService.getToken());
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
