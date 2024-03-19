import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})

export class EventService {
  private url = environment.eventsUrl;
  private token: string | boolean = false;

  private headers: HttpHeaders = new HttpHeaders();
  private options: any;

  constructor(private httpClient: HttpClient) {}

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

  getEvents(currentPage: number) {
    return this.httpClient.get<any>(this.url + '/events/?page=' + currentPage, this.options);
  }

  getUsersEvents(email: string) {
    return this.httpClient.get<any>(this.url + '/events/user/' + email, this.options);
  }

  getEventDetails(id: string) {
    return this.httpClient.get<any>(this.url + '/events/' + id, this.options);
  }

  addAttendee(event_id: string, email: string) {
    this.setHeaders();
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/add-user/' + email,
      {
        user_id: email,
        event_id: event_id
      },
      this.options
    );
  }

  removeAttendee(event_id: string, email: string) {
    this.setHeaders();
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/remove-user/' + email,
      {
        user_id: email,
        event_id: event_id
      },
      this.options
    );
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
    return this.httpClient.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.httpClient.post(this.url + '/register', data, this.options);
  }

  getUrl() {
    return this.url;
  }
}
