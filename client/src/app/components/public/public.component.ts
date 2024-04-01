import { Component } from '@angular/core';
import { NoteService } from "../../services/note.service";
import { Note } from "../../interfaces/note";
import { NgForOf, NgIf } from "@angular/common";
import { SearchComponent } from "../subcomponents/search/search.component";
import { NgbPagination } from "@ng-bootstrap/ng-bootstrap";
import {NoteListComponent} from "../notes/note-list/note-list.component";

@Component({
  selector: 'notes-public',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    SearchComponent,
    NgbPagination,
    NoteListComponent
  ],
  templateUrl: './public.component.html',
  styleUrl: './public.component.css'
})
export class PublicComponent {
  notes: Note[] = [];
  searchQuery: string = '';
  currentPage = 1;
  totalItems = 0;
  itemsPerPage = 0;

  constructor(private notesService:NoteService) {}

  ngOnInit() {
    this.loadNotes();
  }

  /**
   * Loads a new page of notes from the server
   */
  loadNotes(): void {
    this.notesService.getPublicNotes(this.searchQuery).subscribe((res: any) => {
      this.notes = res.data.notes.data;
      this.totalItems = res.data.notes.total;
      this.itemsPerPage = res.data.notes.per_page;
    })
  }

  /**
   * Loads notes that match the search query
   *
   * @param search
   */
  searchNotes(search: string): void {
    this.searchQuery = search;
    this.loadNotes();
  }

  /**
   * Handles a page change and loads notes again
   *
   * @param pageNumber
   */

  onPageChange(pageNumber: number): void {
    this.currentPage = pageNumber;
    this.loadNotes();
  }
}
