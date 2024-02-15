import { Component, inject } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { NotesService } from "../../services/notes.service";
import { UserDetails } from "../../interfaces/user-details";
import { NgForOf } from "@angular/common";

@Component({
  selector: 'notes-user-details',
  standalone: true,
  imports: [
    NgForOf
  ],
  templateUrl: './user-details.component.html',
  styleUrl: './user-details.component.css'
})
export class UserDetailsComponent {
  route: ActivatedRoute = inject(ActivatedRoute);
  notesService: NotesService = inject(NotesService);

  userId: string = this.route.snapshot.params['id'];
  userDetails: UserDetails;

  constructor() {
    this.userDetails = this.notesService.getUserDetails(this.userId);
    console.log(this.userDetails);
  }
}
