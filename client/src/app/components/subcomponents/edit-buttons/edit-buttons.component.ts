import { Component, Input } from '@angular/core';
import { RouterLink } from "@angular/router";

@Component({
  selector: 'notes-edit-buttons',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './edit-buttons.component.html',
  styleUrl: './edit-buttons.component.css'
})
export class EditButtonsComponent {
  @Input() note: any;
}
