import { Component, Input } from '@angular/core';
import { NgForOf, NgIf } from "@angular/common";
import { Note } from "../../../interfaces/note";
import { EditButtonsComponent } from "../../subcomponents/edit-buttons/edit-buttons.component";

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
    @Input() notes!: Note[];
    @Input() public: boolean = true;
}
