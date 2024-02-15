import { Injectable } from '@angular/core';
import { UserList } from "../interfaces/user-list";
import {UserDetails} from "../interfaces/user-details";

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

  detailsInput: string = '{"user":{"id":"9b352b3e-2934-4909-993a-50fd960cb575","username":"lukak","email":"luka.kuder@gmail.com","password":"$2y$10$D5NY0\/pMekYrddDdsiCGPO558IjxWzmm\/xY5NS43WX1DTfjPe\/Oei","image":"images\/ProfilePic.jpg","remember_token":null,"created_at":"2024-01-29T11:10:10.000000Z","updated_at":"2024-01-29T11:10:10.000000Z"},"notes":[{"id":"9b5758ae-0b2c-4671-89cd-7a359df57985","user_id":"9b352b3e-2934-4909-993a-50fd960cb575","category_id":"9b575895-9835-4bd8-b359-aa2f57856639","title":"asdasd","content":"asdasd","priority":1,"deadline":"24-02-2024 11:55:00","tags":"123123","public":1,"created_at":"2024-02-15T10:55:22.000000Z","updated_at":"2024-02-15T10:55:22.000000Z"}],"events":[{"id":"9b3520a9-6696-49d4-8a48-299b48d1f82a","name":"temporibus corrupti eius odit commodi","address":"2799 Clement Rue Apt. 126Lake Amandabury, CA 28948-9786","date":"17-02-2024","time":"14:02:00","description":"Est in vel molestias velit.","ticketPrice":47,"user_id":"a2e806b0-fac5-43fd-98e0-788cf12dccf2","pivot":{"user_id":"9b352b3e-8069-4170-963b-401b1deb02b7","event_id":"9b3520a9-6696-49d4-8a48-299b48d1f82a"}},{"id":"9b3520a9-a05b-44c7-b2af-025f79e36b60","name":"eaque esse asperiores consequuntur dolor","address":"4380 Von CornersPort Elvietown, AL 57707-7678","date":"17-02-2024","time":"14:08:00","description":"Sint qui sequi ea quod qui consequatur voluptates.","ticketPrice":21,"user_id":"a2e806b0-fac5-43fd-98e0-788cf12dccf2","pivot":{"user_id":"9b352b3e-8069-4170-963b-401b1deb02b7","event_id":"9b3520a9-a05b-44c7-b2af-025f79e36b60"}}]}';

  userDetails: UserDetails = JSON.parse(this.detailsInput);



  getAllUsers(): UserList {
    return this.userList;
  }

  getUserDetails(userId: string): UserDetails {
    return this.userDetails;
  }
  constructor() { }
}
