import { Component, Input } from '@angular/core';
import { NgForOf, NgIf } from "@angular/common";
import { Event } from "../../../interfaces/event";
import {NotesService} from "../../../services/notes.service";
import {EventService} from "../../../services/event.service";

@Component({
  selector: 'notes-event-list',
  standalone: true,
    imports: [
        NgForOf,
        NgIf
    ],
  templateUrl: './event-list.component.html',
  styleUrl: './event-list.component.css'
})
export class EventListComponent {
    @Input() events: Event[] | undefined;
    @Input() public: boolean | undefined;

    constructor(private service: EventService) {}

    ngOnInit() {
        if (!this.public) {
            this.service.getEvents().then((events: any) => {
                this.events = events.data.events;
            });
        }
    }
}
