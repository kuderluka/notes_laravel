import { Component, Input } from '@angular/core';
import { RouterLink } from "@angular/router";

@Component({
  selector: 'notes-redirect-button',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './redirect-button.component.html',
  styleUrl: './redirect-button.component.css'
})
export class RedirectButtonComponent {
  @Input() public path: string = '';
  @Input() public text: string = '';
}
