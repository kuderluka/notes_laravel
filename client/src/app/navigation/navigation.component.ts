import { Component } from '@angular/core';
import { Router, RouterLink, RouterLinkActive } from "@angular/router";
import { AuthService } from "../services/auth.service";
import { CommonModule, NgIf } from "@angular/common";

@Component({
  selector: 'notes-navigation',
  standalone: true,
  imports: [
    RouterLink,
    RouterLinkActive,
    NgIf
  ],
  templateUrl: './navigation.component.html',
  styleUrl: './navigation.component.css'
})
export class NavigationComponent {

  constructor(private service: AuthService, private router: Router) {}

  isAuthenticated() {
    return this.service.getToken();
  }

  logout() {
    this.service.logout();
    this.router.navigate(['/landing']);
  }
}
