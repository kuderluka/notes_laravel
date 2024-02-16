import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private url = 'http://127.0.0.1:8000/api';
  private token = '';


  private headers: HttpHeaders;
  private options: any;

  constructor(private http: HttpClient) {
    this.token = sessionStorage.getItem('server_token') ?? '';

    this.headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + this.token
    });
    this.options = { headers: this.headers };
  }

  login(data: any): any {
    return this.http.post(this.url + '/login', data, this.options);
  }

  register(data: any):any {
    return this.http.post(this.url + '/register', data, this.options);
  }
}
