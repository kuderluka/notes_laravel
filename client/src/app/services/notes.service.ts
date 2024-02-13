import { Injectable } from '@angular/core';
import { UserList } from "../user-list";

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  userList: UserList = {
    heading: "users",
    public: false,
    entries: [
      {
        id: "9b352b3e-2934-4909-993a-50fd960cb575",
        username: "luka",
        email: "luka.kuder@gmail.com",
        password: "$2y$10$D5NY0/pMekYrddDdsiCGPO558IjxWzmm/xY5NS43WX1DTfjPe/Oei",
        image: "images/ProfilePic.jpg",
        remember_token: null,
        created_at: "2024-01-29T11:10:10.000000Z",
        updated_at: "2024-01-29T11:10:10.000000Z"
      },
      {
        id: "9b352b3e-2934-4909-993a-50fd960cb575",
        username: "lukakdddd",
        email: "luka.kuder2@gmail.com",
        password: "$2y$10$D5NY0/pMekYrddDdsiCGPO558IjxWzmm/xY5NS43WX1DTfjPe/Oei",
        image: "images/ProfilePic.jpg",
        remember_token: null,
        created_at: "2024-01-29T11:10:10.000000Z",
        updated_at: "2024-01-29T11:10:10.000000Z"
      }
    ]
  }

  getAllUsers(): UserList {
    return this.userList;
  }
  constructor() { }
}
