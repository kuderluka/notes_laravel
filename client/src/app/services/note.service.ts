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
export class NoteService {
  private url = environment.appUrl;
  private note!: any;

  constructor(private httpClient: HttpClient, private authService: AuthService, private eventService: EventService) { }

  /**
   * Returns the authenticated user
   */
  getUser() {
    return this.authService.getUser();
  }

  /**
   * Returns the currently active note
   */
  getNote(): Note {
    return this.note;
  }

  /**
   * Sets the note
   *
   * @param note
   */
  setNote(note: any): void {
    this.note = note;
  }

  /**
   * Fetches all of the users
   */
  getAllUsers() {
    return this.httpClient.get<any>(this.url + '/public/users');
  }

  /**
   * Fetches the data needed for statistics
   */
  getStatisticsData() {
    return this.httpClient.get<any>(this.url + '/statistics')
  }

  /**
   * Fetches the publicly available users data
   *
   * @param id
   */
  getUsersPublicData(id: string) {
    return this.httpClient.get<any>(this.url + '/public/users/' + id);
  }

  /**
   * Fetches the public notes
   *
   * @param search
   */
  getPublicNotes(search: string) {
    let queryParams = search ? `?search=${search}` : '';
    return this.httpClient.get<any>(this.url + '/public' + queryParams);
  }

  /**
   * Fetches the details about a user
   *
   * @param id
   */
  getUserDetails(id: string) {
    return this.httpClient.get<any>(this.url + '/users/' + id);
  }

  /**
   * Creates a category
   *
   * @param form
   */
  createCategory(form: FormGroup) {
    return this.httpClient.post<any>(this.url + '/category/store',
      {
        users: this.authService.getUser().id,
        title: form.value.title,
        color: form.value.color
      }
    );
  }

  /**
   * Creates a note
   *
   * @param form
   */
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

  /**
   * Updates a note
   *
   * @param form
   * @param id
   */
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

  /**
   * Fetches all of the categories
   */
  getCategories() {
    return this.httpClient.get<any>(this.url + '/categories');
  }

  /**
   * Deletes a note
   *
   * @param id
   */
  deleteNote(id: string) {
    return this.httpClient.delete<any>(this.url + '/note/destroy/' + id);
  }
}
