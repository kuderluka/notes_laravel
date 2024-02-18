import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";

@Injectable({
  providedIn: 'root'
})

export class EventService {
  private url = 'http://127.0.0.1:8001/api';
  private token: string | boolean = false;
  private user: User | boolean = false;

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
    const data = await fetch(this.url + '/events');
    return (await data.json()) ?? [];
  }

  setToken(token: string | false) {
    this.token = token;
  }

  getToken() {
    return this.token;
  }

  logout() {
    this.token = false;
    this.user = false;
    this.setHeaders();
  }

  setUser(user: User) {
    this.user = user;
  }

  getUser() {
    return this.user;
  }

  setData(data: any) {
    this.user = data.user;
    this.token = data.token;
  }

  login(data: any): any {
    return this.http.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.http.post(this.url + '/register', data, this.options);
  }
}
