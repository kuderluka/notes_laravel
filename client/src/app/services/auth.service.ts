import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private url = 'http://127.0.0.1:8000/api';
  private token: string | null = null;
  private user: any = null;

  private headers: HttpHeaders = new HttpHeaders();
  private options: any;

  constructor(private http: HttpClient) {
    this.setHeaders();
  }

  login(data: any): any {
    return this.http.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.http.post(this.url + '/register', data, this.options);
  }

  private setHeaders() {
    this.token = this.getToken() ?? '';

    this.headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + this.token
    });
    this.options = { headers: this.headers };
  }

  setToken(token: string | null) {
    this.token = token;
  }

  getToken() {
    return this.token;
  }

  logout() {
    this.token = null;
    this.setHeaders();
  }
}
