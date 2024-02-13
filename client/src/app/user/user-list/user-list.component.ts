import { Component, inject } from '@angular/core';
import { CommonModule } from "@angular/common";
import { NotesService } from "../../services/notes.service";
import { User } from "../../user";
import { UserList } from "../../user-list";

@Component({
  selector: 'notes-user-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './user-list.component.html',
  styleUrl: './user-list.component.css'
})
export class UserListComponent {
  userList: UserList;
  notesService: NotesService = inject(NotesService);

  constructor() {
    this.userList = this.notesService.getAllUsers();
  }
}
