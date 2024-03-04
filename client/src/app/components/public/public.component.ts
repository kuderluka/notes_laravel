import { Component } from '@angular/core';
import { NotesService } from "../../services/notes.service";
import { Note } from "../../interfaces/note";
import { NgForOf, NgIf } from "@angular/common";
import {SearchComponent} from "../subcomponents/search/search.component";

@Component({
  selector: 'notes-public',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    SearchComponent
  ],
  templateUrl: './public.component.html',
  styleUrl: './public.component.css'
})
export class PublicComponent {
  noteList: Note[] = [];
  searchQuery: string = '';

  constructor(private service:NotesService) {
    this.getNotes();
  }

  getNotes() {
    this.service.getPublicNotes(this.searchQuery).then((notes: any) => {
      this.noteList = notes.entries;
      console.log(this.noteList);
    })
  }

  searchNotes(search: string) {
    this.searchQuery = search;
    this.getNotes();
  }
}
