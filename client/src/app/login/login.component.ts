import { Component } from '@angular/core';
import {NotesService} from "../services/notes.service";
import {AuthService} from "../services/auth.service";

@Component({
  selector: 'notes-login',
  standalone: true,
  imports: [],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  data: any;
  credentials: { email: string, password: string } = {
    email: "luka.kuder@gmail.com",
    password: "Aspiria00"
  };
  constructor(private service:AuthService) {

    this.service.login(this.credentials).subscribe(
        (res: any) => {
          localStorage.setItem('server_token', res.data.token)
          console.log(localStorage.getItem('server_token'));
        },
        (error: any) => {
          console.error(error);
        }
    );
  }
}
