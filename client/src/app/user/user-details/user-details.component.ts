import { Component, inject } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { NotesService } from "../../services/notes.service";
import { NgForOf, NgIf } from "@angular/common";

@Component({
  selector: 'notes-user-details',
  standalone: true,
    imports: [
        NgForOf,
        NgIf
    ],
  templateUrl: './user-details.component.html',
  styleUrl: './user-details.component.css'
})
export class UserDetailsComponent {
    id: string;
    data: any;

    constructor(private route: ActivatedRoute, private service: NotesService) {
        this.id = this.route.snapshot.params['id'];
        this.service.getUserDetails(this.id).then((user: any) => {
            this.data = user;
        });
    }
}
