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
  id: string = this.route.snapshot.params['id'];

  user: any;

  constructor(private service:NotesService) {}

  ngOnInit() {
    this.service.getUserDetails(this.id)
      .subscribe(response => {
        this.user = response;
      });
  }
}
