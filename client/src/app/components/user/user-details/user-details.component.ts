import { Component, inject } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { NotesService } from "../../../services/notes.service";
import { NgForOf, NgIf } from "@angular/common";
import { UserDetails } from "../../../interfaces/user-details";
import { EventTableComponent } from "../../events/event-table/event-table.component";
import {NoteListComponent} from "../../notes/note-list/note-list.component";

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
    id: string = '';
    data: UserDetails | undefined;

    constructor(private route: ActivatedRoute, private notesService: NotesService) {
        this.id = this.route.snapshot.params['id'];
        this.notesService.getUsersPublicData(this.id).subscribe((user: any) => {
            this.data = user;
        });
    }
}
