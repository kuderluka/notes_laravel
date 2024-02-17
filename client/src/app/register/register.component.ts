import { Component } from '@angular/core';
import { Router, RouterLink } from "@angular/router";
import { FormGroup, FormBuilder, ReactiveFormsModule } from "@angular/forms";
import { AuthService } from "../services/auth.service";

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

  constructor(private formBuilder: FormBuilder, private service: AuthService, private router: Router) {}

  ngOnInit(): void {
    this.registerForm = this.formBuilder.group({
      username: [''],
      email: [''],
      password: [''],
      password_confirmation: ['']
    });
  }

  register() {
    this.service.setToken(null);
    this.service.register(this.registerForm.value).subscribe(
      (res: any) => {
        if (res && res.data && res.data.token !== undefined) {
          this.registerForm.reset();
          this.service.setToken(res.data.token);
          console.log(localStorage.getItem('server_token'))
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
