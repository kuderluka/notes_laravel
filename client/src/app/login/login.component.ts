import { Component } from '@angular/core';
import { NotesService } from "../services/notes.service";
import { AuthService } from "../services/auth.service";
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule } from "@angular/forms";

@Component({
  selector: 'notes-login',
  standalone: true,
    imports: [
        RouterLink,
        ReactiveFormsModule
    ],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  public loginForm!: FormGroup;
  constructor(private service:AuthService, private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: [''],
      password: ['']
    });
  }

  login() {
    this.service.setToken(null);
    this.service.login(this.loginForm.value).subscribe(
      (res: any) => {
        if (res && res.data && res.data.token !== undefined) {
          this.loginForm.reset();
          this.service.setToken(res.data.token);
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
