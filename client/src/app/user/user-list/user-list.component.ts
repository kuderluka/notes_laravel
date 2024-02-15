import { Component, inject } from '@angular/core';
import { CommonModule } from "@angular/common";
import { NotesService } from "../../services/notes.service";
import { UserList } from "../../interfaces/user-list";
import {RouterLink} from "@angular/router";

@Component({
  selector: 'notes-user-list',
  standalone: true,
  imports: [CommonModule, RouterLink],
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
