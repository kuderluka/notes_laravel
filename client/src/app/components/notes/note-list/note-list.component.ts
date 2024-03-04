import { Component, Input } from '@angular/core';
import { NgForOf, NgIf } from "@angular/common";
import { Note } from "../../../interfaces/note";
import { NotesService } from "../../../services/notes.service";
import {EditButtonsComponent} from "../../subcomponents/edit-buttons/edit-buttons.component";

@Component({
  selector: 'notes-note-list',
  standalone: true,
    imports: [
        NgForOf,
        NgIf,
        EditButtonsComponent
    ],
  templateUrl: './note-list.component.html',
  styleUrl: './note-list.component.css'
})
export class NoteListComponent {
    @Input() notes: Note[] | undefined;
    @Input() public: boolean = true;

    constructor(private service:NotesService) {}

    ngOnInit() {
        if (this.public) {
            this.service.getPublicNotes('').then((notes: any) => {
                this.notes = notes.entries;
            });
        }
    }
}
