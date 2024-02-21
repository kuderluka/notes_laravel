import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";

@Injectable({
  providedIn: 'root'
})

export class EventService {
  private url = 'http://127.0.0.1:8001/api';
  private token: string | boolean = false;

  private headers: HttpHeaders = new HttpHeaders();
  private options: any;

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.setHeaders()
  }

  private setHeaders() {
    this.headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + this.token
    });
    this.options = { headers: this.headers };
  }

  async getEvents() {
    const data = await fetch(this.url + '/events', this.options);
    return (await data.json()) ?? [];
  }

  async getEventDetails(id: string) {
    const data = await fetch(this.url + '/events/' + id, this.options);
    return (await data.json()) ?? [];
  }

  async addAttendee(event_id: string, user_id: string) {
    const response = await fetch(this.url + '/events/' + event_id + '/add-user/' + user_id, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.token
      },
    });

    if (response.ok) {
      return await response.json();
    } else {
      console.error('Failed to add attendee:', response);
      return [];
    }
  }

  async removeAttendee(event_id: string, user_id: string) {
    const response = await fetch(this.url + '/events/' + event_id + '/remove-user/' + user_id, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.token
      },
    });

    if (response.ok) {
      return await response.json();
    } else {
      console.error('Failed to remove attendee:', response);
      return [];
    }
  }

  setToken(token: string | false) {
    this.token = token;
  }

  getToken() {
    return this.token;
  }

  logout() {
    this.token = false;
    this.setHeaders();
  }

  setData(data: any) {
    this.token = data.token;
  }

  login(data: any): any {
    return this.http.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.http.post(this.url + '/register', data, this.options);
  }
}
