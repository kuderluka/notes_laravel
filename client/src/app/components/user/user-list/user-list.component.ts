import { Component, inject } from '@angular/core';
import { NoteService } from "../../../services/note.service";
import { RouterLink } from "@angular/router";
import { NgForOf } from "@angular/common";
import { User } from "../../../interfaces/user";
import { UserList } from "../../../interfaces/user-list";

@Component({
  selector: 'notes-user-list',
  standalone: true,
  imports: [RouterLink, NgForOf],
  templateUrl: './user-list.component.html'
})
export class UserListComponent {
  protected userList: User[] = [];

  constructor(private notesService:NoteService) {
    this.notesService.getAllUsers().subscribe((users: UserList) => {
      this.userList = users.entries;
    })
  }
}
