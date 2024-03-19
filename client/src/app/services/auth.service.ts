import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { User } from "../interfaces/user";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private url: string = environment.appUrl;
  private token: string = '';
  private user: any;

  constructor(private http: HttpClient) {}

  login(data: any): any {
    return this.http.post(this.url + '/login', data);
  }

  register(data: any): any {
    return this.http.post(this.url + '/register', data);
  }

  setToken(token: string) {
    this.token = token;
  }

  getToken() {
    return this.token;
  }

  logout() {
    this.token = '';
    this.user = false;
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
