import { Component } from '@angular/core';
import { NotesService } from "../../services/notes.service";
import { Note } from "../../interfaces/note";
import { NgForOf, NgIf } from "@angular/common";

@Component({
  selector: 'notes-public',
  standalone: true,
  imports: [
    NgForOf,
    NgIf
  ],
  templateUrl: './public.component.html',
  styleUrl: './public.component.css'
})
export class PublicComponent {
  noteList: Note[] = [];

  constructor(private service:NotesService) {
    this.service.getPublicNotes().then((notes: any) => {
      this.noteList = notes.entries;
    })
  }
}
