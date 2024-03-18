import { Component } from '@angular/core';
import { NotesService } from "../../services/notes.service";
import { AuthService } from "../../services/auth.service";
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from "@angular/forms";
import { EventService } from "../../services/event.service";

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
  constructor(private authService: AuthService,private eventService: EventService, private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  /*
    Authenticates an already existing user by fetching tokens from both my and Kristjan's server and storing them
   */
  login(): void {
    try {
      this.authService.login(this.loginForm.value).subscribe(
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

      this.eventService.login(this.loginForm.value).subscribe(
          (res: any) => {
            if (res && res.data && res.data.token !== undefined) {
              this.loginForm.reset();
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
    } catch (error) {
      console.log(error);
    }
  }
}
