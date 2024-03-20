import { Component, Input } from '@angular/core';
import { KeyValuePipe, NgForOf } from "@angular/common";

@Component({
  selector: 'notes-errors',
  standalone: true,
  imports: [
    NgForOf,
    KeyValuePipe
  ],
  templateUrl: './errors.component.html',
  styleUrl: './errors.component.css'
})
export class ErrorsComponent {
  @Input() errors: { [key: string]: string } = {};
}
