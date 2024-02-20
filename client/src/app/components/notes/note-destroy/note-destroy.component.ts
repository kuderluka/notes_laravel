import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {NotesService} from "../../../services/notes.service";

@Component({
  selector: 'notes-note-destroy',
  standalone: true,
  imports: [],
  templateUrl: './note-destroy.component.html',
  styleUrl: './note-destroy.component.css'
})
export class NoteDestroyComponent implements OnInit {
  id!: string;

  constructor(
      private route: ActivatedRoute,
      private router: Router,
      private noteService: NotesService
  ) { }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = params['id'];
      this.destroyNote();
    });
  }

  destroyNote(): void {
    this.noteService.deleteNote(this.id).then(() => {
      this.router.navigate(['/workspace']);
    });
  }
}
