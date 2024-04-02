import { Component, Input } from '@angular/core';
import {Router, RouterLink} from "@angular/router";
import { NoteService } from "../../../services/note.service";

@Component({
  selector: 'notes-edit-buttons',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './edit-buttons.component.html',
  styleUrl: './edit-buttons.component.css'
})
export class EditButtonsComponent {
  @Input() public note: any;

  constructor(private noteService: NoteService, private router: Router) {}

  /**
   * Updates a note and redirects
   */
  edit() {
    this.noteService.setNote(this.note);
    this.router.navigate(['note', this.note.id]);
  }

  /**
   * Deletes a note and redirects
   */
  destroyNote(): void {
    this.noteService.deleteNote(this.note.id).subscribe(() => {
      this.router.navigate(['/workspace']);
    });
  }
}
