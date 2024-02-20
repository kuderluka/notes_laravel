import { Component } from '@angular/core';
import { Router, RouterLink } from "@angular/router";

@Component({
  selector: 'notes-workspace-buttons',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './workspace-buttons.component.html',
  styleUrl: './workspace-buttons.component.css'
})
export class WorkspaceButtonsComponent {
  constructor(private router: Router) {}
}
