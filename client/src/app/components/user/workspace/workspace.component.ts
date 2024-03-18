import { Component } from '@angular/core';
import { NoteListComponent } from "../../notes/note-list/note-list.component";
import { Note } from "../../../interfaces/note";
import { UserDetails } from "../../../interfaces/user-details";
import { NotesService } from "../../../services/notes.service";
import { AuthService } from "../../../services/auth.service";
import { User } from "../../../interfaces/user";
import {NgIf} from "@angular/common";
import {EventListComponent} from "../../events/event-list/event-list.component";
import {WorkspaceButtonsComponent} from "../../subcomponents/workspace-buttons/workspace-buttons.component";
import {EventService} from "../../../services/event.service";

@Component({
  selector: 'notes-workspace',
  standalone: true,
  imports: [
    NoteListComponent,
    NgIf,
    EventListComponent,
    WorkspaceButtonsComponent
  ],
  templateUrl: './workspace.component.html',
  styleUrl: './workspace.component.css'
})
export class WorkspaceComponent {
  notes: Note[] = [];
  user: User = this.authService.getUser();
  id: string = this.user.id;
  events: any;

  constructor(private eventService: EventService, private noteService: NotesService, private authService: AuthService) {
    this.noteService.getUserDetails(this.id).then((user: any) => {
      this.notes = user.notes;
    });

    this.eventService.getUsersEvents(this.user.email).then((res: any) => {
      this.events = res;
    })
  }
}
