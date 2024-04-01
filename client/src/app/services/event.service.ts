import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})

export class EventService {
  private url = environment.eventsUrl;
  private token: string = '';

  constructor(private httpClient: HttpClient) {}

  getEvents(currentPage: number) {
    return this.httpClient.get<any>(this.url + '/events/?page=' + currentPage);
  }

  getAllEvents() {
    return this.httpClient.get<any>(this.url + '/events');
  }

  getUsersEvents(email: string) {
    return this.httpClient.get<any>(this.url + '/events/user/' + email);
  }

  getEventDetails(id: string) {
    return this.httpClient.get<any>(this.url + '/events/' + id);
  }

  addAttendee(event_id: string, email: string) {
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/add-user/' + email,
      {
        user_id: email,
        event_id: event_id
      }
    );
  }

  removeAttendee(event_id: string, email: string) {
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/remove-user/' + email,
      {
        user_id: email,
        event_id: event_id
      }
    );
  }

  setToken(token: string) {
    this.token = token;
  }

  getToken() {
    return this.token;
  }

  logout() {
    this.token = '';
  }

  setData(data: any) {
    this.token = data.token;
  }

  login(data: any): any {
    return this.httpClient.post(this.url + '/login', data);
  }

  register(data: any):any {
    return this.httpClient.post(this.url + '/register', data);
  }

  getUrl() {
    return this.url;
  }
}
