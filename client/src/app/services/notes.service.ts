import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AuthService } from "./auth.service";
import { FormGroup } from "@angular/forms";
import { EventService } from "./event.service";
import { environment } from "../../environments/environment";
import { Note } from "../interfaces/note";

@Injectable({
  providedIn: 'root'
})
export class NotesService {
  private url = environment.appUrl;
  private note!: any;

  constructor(private httpClient: HttpClient, private authService: AuthService, private eventService: EventService) { }

  getUser() {
    return this.authService.getUser();
  }

  getNote(): Note {
    return this.note;
  }

  setNote(note: any): void {
    this.note = note;
  }

  getAllUsers() {
    return this.httpClient.get<any>(this.url + '/public/users');
  }

  getUsersPublicData(id: string) {
    return this.httpClient.get<any>(this.url + '/public/users/' + id);
  }

  getPublicNotes(search: string) {
    let queryParams = search ? `?search=${search}` : '';
    return this.httpClient.get<any>(this.url + '/public' + queryParams);
  }

  getUserDetails(id: string) {
    return this.httpClient.get<any>(this.url + '/users/' + id);
  }

  createCategory(form: FormGroup) {
    return this.httpClient.post<any>(this.url + '/category/store',
      {
        users: this.authService.getUser().id,
        title: form.value.title,
        color: form.value.color
      }
    );
  }

  createNote(form: FormGroup) {
    return this.httpClient.post<any>(this.url + '/note/store',
      {
        user_id: form.value.user_id,
        category_id: form.value.category_id,
        title: form.value.title,
        content: form.value.content,
        priority: form.value.priority,
        deadline: form.value.deadline,
        tags: form.value.tags,
        public: form.value.public
      }
    );
  }

  updateNote(form: FormGroup, id: string) {
    return this.httpClient.put<any>(this.url + '/note/store/' + id,
      {
        id: id,
        user_id: form.value.user_id,
        category_id: form.value.category_id,
        title: form.value.title,
        content: form.value.content,
        priority: form.value.priority,
        deadline: form.value.deadline,
        tags: form.value.tags,
        public: form.value.public
      }
    );
  }

  getCategories() {
    return this.httpClient.get<any>(this.url + '/categories');
  }

  deleteNote(id: string) {
    return this.httpClient.delete<any>(this.url + '/note/destroy/' + id);
  }

  private getUrl() {
    return this.url;
  }
}
