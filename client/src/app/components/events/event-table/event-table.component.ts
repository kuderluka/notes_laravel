import { Component, Input } from '@angular/core';
import { NgForOf, NgIf } from "@angular/common";
import { EventButtonComponent } from "../../subcomponents/event-button/event-button.component";

@Component({
  selector: 'notes-event-table',
  standalone: true,
  imports: [
    NgForOf,
    EventButtonComponent,
    NgIf
  ],
  templateUrl: './event-table.component.html',
  styleUrl: './event-table.component.css'
})
export class EventTableComponent {
  @Input() events: any;
}
