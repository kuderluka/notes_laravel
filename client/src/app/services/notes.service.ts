import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from "./auth.service";
import { FormGroup } from "@angular/forms";
import { EventService } from "./event.service";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  private url = environment.appUrl;

  constructor(private http: HttpClient, private auth: AuthService, private eventService: EventService) { }

  getUser() {
    return this.auth.getUser();
  }

  async getAllUsers() {
    const data = await fetch(this.url + '/public/users');
    return (await data.json()) ?? [];
  }

  async getUsersPublicData(id: string) {
    const data = await fetch(this.url + '/public/users/' + id);
    return (await data.json()) ?? [];
  }

  async getPublicNotes() {
    const data = await fetch(this.url + '/public');
    return (await data.json()) ?? [];
  }

  async getUserDetails(id: string) {
    const response = await fetch(this.url + '/users/' + id, {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      }
    });

    if (response.ok) {
      return (await response.json()) ?? [];
    } else {
      console.error('Failed to fetch data:', response);
      return (await response.json()) ?? [];
    }
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
        user_id: form.value.user_id,
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
      return response;
    } else {
      console.error('Failed to create a note:', response);
      return response;
    }
  }

  async updateNote(form: FormGroup, id: string) {
    const response = await fetch(this.url + '/note/store/' + id, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      },
      body: JSON.stringify({
        id: id,
        user_id: form.value.user_id,
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
      return response;
    } else {
      console.error('Failed to update a note:', response);
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
      return (await response.json()) ?? [];
    } else {
      console.error('Failed to fetch categories:', response);
      return (await response.json()) ?? [];
    }
  }

  async deleteNote(id: string) {
    const response = await fetch(this.url + '/note/destroy/' + id, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.auth.getToken()
      }
    });

    if (response.ok) {
      return response;
    } else {
      console.error('Failed to create a category:', response);
      return response;
    }
  }

  private getUrl() {
    return this.url;
  }
}
