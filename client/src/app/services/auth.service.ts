import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private url = 'http://127.0.0.1:8000/api';
  private token: string | boolean = false;
  private user: any;

  private headers: HttpHeaders = new HttpHeaders();
  private options: any;

  constructor(private http: HttpClient) {}

  ngOnInit() {
    this.setHeaders()
  }

  login(data: any): any {
    return this.http.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.http.post(this.url + '/register', data, this.options);
  }

  private setHeaders() {
    this.headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + this.token
    });
    this.options = { headers: this.headers };
  }

  getHeaders() {
    return this.options;
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
}
