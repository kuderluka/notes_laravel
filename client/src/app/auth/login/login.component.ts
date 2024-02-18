import { Component } from '@angular/core';
import { NotesService } from "../../services/notes.service";
import { AuthService } from "../../services/auth.service";
import { Router, RouterLink } from "@angular/router";
import { FormBuilder, FormGroup, ReactiveFormsModule } from "@angular/forms";
import {EventService} from "../../services/event.service";

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
  constructor(private service: AuthService,private eventService: EventService, private formBuilder: FormBuilder, private router: Router) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: [''],
      password: ['']
    });
  }

  login() {
    try {
      this.service.logout();
      this.service.login(this.loginForm.value).subscribe(
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
      this.eventService.login(this.loginForm.value).subscribe(
          (res: any) => {
            if (res && res.data && res.data.token !== undefined) {
              this.loginForm.reset();
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
    } catch (error) {
      console.log(this.eventService.getToken());
      console.log(error);
    }
    console.log(this.eventService.getToken());
  }
}
