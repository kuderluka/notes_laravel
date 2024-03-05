import { Component } from '@angular/core';
import { NotesService } from "../../services/notes.service";
import { Note } from "../../interfaces/note";
import { NgForOf, NgIf } from "@angular/common";
import { SearchComponent } from "../subcomponents/search/search.component";
import { NgbPagination } from "@ng-bootstrap/ng-bootstrap";

@Component({
  selector: 'notes-public',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    SearchComponent,
    NgbPagination
  ],
  templateUrl: './public.component.html',
  styleUrl: './public.component.css'
})
export class PublicComponent {
  noteList: Note[] = [];
  searchQuery: string = '';
  currentPage = 1;
  totalItems = 0;
  itemsPerPage = 0;

  constructor(private service:NotesService) {}

  ngOnInit() {
    this.loadNotes();
  }

  loadNotes() {
    this.service.getPublicNotes(this.searchQuery).then((res: any) => {
      this.noteList = res.data.notes.data;
      this.totalItems = res.data.notes.total;
      this.itemsPerPage = res.data.notes.per_page;
      console.log(this.noteList);
    })
  }

  searchNotes(search: string) {
    this.searchQuery = search;
    this.loadNotes();
  }

  onPageChange(pageNumber: number) {
    this.currentPage = pageNumber;
    this.loadNotes();
  }
}
