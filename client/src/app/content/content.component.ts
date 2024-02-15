import { Component } from '@angular/core';


import { UserListComponent } from "../user/user-list/user-list.component";

@Component({
  selector: 'notes-content',
  standalone: true,
  imports: [UserListComponent],
  templateUrl: './content.component.html',
  styleUrl: './content.component.css'
})
export class ContentComponent {

}
