import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from "./auth.service";
import {FormGroup} from "@angular/forms";

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  private url = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient, private auth: AuthService) { }

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

  async createCategory(form: FormGroup) {
    const response = await fetch(this.url + '/note/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      },
      body: JSON.stringify({
        users: this.auth.getUser().id,
        title: form.value.title,
        color: form.value.color
      })
    });

    if (response.ok) {
      console.log('Good:', response);
      return response;
    } else {
      console.error('Failed to create a category:', response);
      return response;
    }
  }
}
