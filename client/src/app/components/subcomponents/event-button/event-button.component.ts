import { Component, Input } from '@angular/core';
import { Router, RouterLink } from "@angular/router";

@Component({
  selector: 'notes-event-button',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './event-button.component.html',
  styleUrl: './event-button.component.css'
})
export class EventButtonComponent {
  @Input() id!: string;
}
