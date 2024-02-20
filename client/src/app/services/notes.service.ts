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
    const response = await fetch(this.url + '/category/store', {
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

  async createNote(form: FormGroup) {
    const response = await fetch(this.url + '/note/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      },
      body: JSON.stringify({
        user_id: this.auth.getUser().id,
        category_id: form.value.category_id,
        title: form.value.title,
        content: form.value.content,
        priority: form.value.priority,
        deadline: form.value.deadline,
        tags: form.value.tags,
        public: form.value.public
      })
    });

    if (response.ok) {
      console.log('Good:', response);
      return response;
    } else {
      console.error('Failed to create a note:', response);
      return response;
    }
  }

  async getCategories() {
    const response = await fetch(this.url + '/categories', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      }
    });

    if (response.ok) {
      console.log('Good:', response);
      return (await response.json()) ?? [];
    } else {
      console.error('Failed to fetch categories:', response);
      return (await response.json()) ?? [];
    }
  }
}
