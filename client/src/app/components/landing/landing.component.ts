import { Component } from '@angular/core';
import { NgIf } from "@angular/common";
import { AuthService } from "../../services/auth.service";

@Component({
  selector: 'notes-landing',
  standalone: true,
  imports: [
    NgIf
  ],
  templateUrl: './landing.component.html',
  styleUrl: './landing.component.css'
})
export class LandingComponent {
  constructor(private authService: AuthService) {
  }

  isAuthenticated() {
    return this.authService.getToken();
  }
}
