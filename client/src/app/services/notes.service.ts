import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  private url = 'http://127.0.0.1:8000/api';

  constructor() { }

  async getAllUsers() {
    const data = await fetch(this.url + '/users');
    return (await data.json()) ?? [];
  }

  async getUserDetails(id: string) {
    const data = await fetch(this.url + '/users/' + id);
    return (await data.json()) ?? [];
  }

  async getPublicNotes() {
    const data = await fetch(this.url + '/public');
    return (await data.json()) ?? [];
  }
}
