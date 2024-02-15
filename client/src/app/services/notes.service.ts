import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { UserList } from "../interfaces/user-list";
import { UserDetails } from "../interfaces/user-details";

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  private url = 'http://127.0.0.1:8000/api';

  getAllUsers() {
    return this.httpClient.get(this.url + '/users');
  }

  getUserDetails(id: string) {
    return this.httpClient.get(this.url + '/users' + id);
  }
  constructor(private httpClient: HttpClient) { }
}
