import { Component, inject } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { NoteService } from "../../../services/note.service";
import { NgForOf, NgIf } from "@angular/common";
import { UserDetails } from "../../../interfaces/user-details";
import { EventTableComponent } from "../../events/event-table/event-table.component";
import { NoteListComponent } from "../../notes/note-list/note-list.component";
import { EventService } from "../../../services/event.service";

@Component({
  selector: 'notes-user-details',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    EventTableComponent,
    NoteListComponent
  ],
  templateUrl: './user-details.component.html',
  styleUrl: './user-details.component.css'
})
export class UserDetailsComponent {
    protected data: any;
    protected events: any;

    constructor(private route: ActivatedRoute, private noteService: NoteService, private eventService: EventService) {
        this.noteService.getUsersPublicData(this.route.snapshot.params['id']).subscribe((user: any) => {
            this.data = user;
        });
        this.eventService.getUsersEvents(this.route.snapshot.params['email']).subscribe((events: any) => {
            this.events = events;
        })
    }
}
