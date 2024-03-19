import {Component, Input} from '@angular/core';
import {NgForOf} from "@angular/common";

@Component({
  selector: 'notes-errors',
  standalone: true,
  imports: [
    NgForOf
  ],
  templateUrl: './errors.component.html',
  styleUrl: './errors.component.css'
})
export class ErrorsComponent {
  @Input() errors: any[] = [];
}
