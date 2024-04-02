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

  /**
   * Fetches a page of events
   *
   * @param currentPage
   */
  getEvents(currentPage: number) {
    return this.httpClient.get<any>(this.url + '/events/?page=' + currentPage);
  }

  /**
   * Fetches all events
   */
  getAllEvents() {
    return this.httpClient.get<any>(this.url + '/events');
  }

  /**
   * Fetches all of the certain users events
   *
   * @param email
   */
  getUsersEvents(email: string) {
    return this.httpClient.get<any>(this.url + '/events/user/' + email);
  }

  /**
   * Fetches the details of a certain event
   *
   * @param id
   */
  getEventDetails(id: string) {
    return this.httpClient.get<any>(this.url + '/events/' + id);
  }

  /**
   * Adds an attendee to an event
   *
   * @param event_id
   * @param email
   */
  addAttendee(event_id: string, email: string) {
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/add-user/' + email,
      {
        user_id: email,
        event_id: event_id
      }
    );
  }

  /**
   * Removes an attendee from an event
   *
   * @param event_id
   * @param email
   */
  removeAttendee(event_id: string, email: string) {
    return this.httpClient.post<any>(this.url + '/events/' + event_id + '/remove-user/' + email,
      {
        user_id: email,
        event_id: event_id
      }
    );
  }

  /**
   * Sets the token
   *
   * @param token
   */
  setToken(token: string) {
    this.token = token;
  }

  /**
   * Fetches the token
   */
  getToken() {
    return this.token;
  }

  /**
   * Performs logout
   */
  logout() {
    this.token = '';
  }

  /**
   * Sets the needed session data
   *
   * @param data
   */
  setData(data: any) {
    this.token = data.token;
  }

  /**
   * Performs login by getting the token from the server
   *
   * @param data
   */
  login(data: any): any {
    return this.httpClient.post(this.url + '/login', data);
  }

  /**
   * Performs registration by getting the token from the server
   *
   * @param data
   */
  register(data: any):any {
    return this.httpClient.post(this.url + '/register', data);
  }
}
