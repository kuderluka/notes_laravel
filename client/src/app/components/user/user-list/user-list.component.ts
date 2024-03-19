import { Component, inject } from '@angular/core';
import { NotesService } from "../../../services/notes.service";
import { RouterLink } from "@angular/router";
import { NgForOf } from "@angular/common";
import { User } from "../../../interfaces/user";
import { UserList } from "../../../interfaces/user-list";

@Component({
  selector: 'notes-user-list',
  standalone: true,
  imports: [RouterLink, NgForOf],
  templateUrl: './user-list.component.html',
  styleUrl: './user-list.component.css'
})
export class UserListComponent {
  userList: User[] = [];

  constructor(private notesService:NotesService) {
    this.notesService.getAllUsers().subscribe((users: UserList) => {
      this.userList = users.entries;
    })
  }
}
