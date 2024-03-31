import { Component } from '@angular/core';
import { NoteListComponent } from "../../notes/note-list/note-list.component";
import { Note } from "../../../interfaces/note";
import { NotesService } from "../../../services/notes.service";
import { AuthService } from "../../../services/auth.service";
import { User } from "../../../interfaces/user";
import { NgIf } from "@angular/common";
import { WorkspaceButtonsComponent } from "../../subcomponents/workspace-buttons/workspace-buttons.component";
import { EventService } from "../../../services/event.service";
import { EventTableComponent } from "../../events/event-table/event-table.component";

@Component({
  selector: 'notes-workspace',
  standalone: true,
  imports: [
    NoteListComponent,
    NgIf,
    WorkspaceButtonsComponent,
    EventTableComponent
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
    this.noteService.getUserDetails(this.id).subscribe((user: any) => {
      this.notes = user.notes;
    });

    this.eventService.getUsersEvents(this.user.email).subscribe((res: any) => {
      this.events = res;
    })
  }
}
