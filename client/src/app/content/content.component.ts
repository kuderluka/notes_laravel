import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserListComponent } from "../user/user-list/user-list.component";

@Component({
  selector: 'notes-content',
  standalone: true,
  imports: [CommonModule, UserListComponent],
  templateUrl: './content.component.html',
  styleUrl: './content.component.css'
})
export class ContentComponent {

}
