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

  /**
   * Performs authentication by getting a token from the server
   *
   * @param data
   */
  login(data: any): any {
    return this.http.post(this.url + '/login', data);
  }

  /**
   * Performs authentication by getting a token from the server
   *
   * @param data
   */
  register(data: any): any {
    return this.http.post(this.url + '/register', data);
  }

  /**
   * Performs authentication by getting a token from the server
   *
   * @param data
   */
  authenticateSocials(data: any): any {
    return this.http.post(this.url + '/login/socials', data);
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
   * Returns the token
   */
  getToken() {
    return this.token;
  }

  /**
   * Performs logout
   */
  logout() {
    this.token = '';
    this.user = false;
  }

  /**
   * Sets the currently authenticated user
   *
   * @param user
   */
  setUser(user: User) {
      this.user = user;
  }

  /**
   * Returns the currently authenticated user
   */
  getUser() {
      return this.user;
  }

  /**
   * Sets the current session data
   *
   * @param data
   */
  setData(data: any) {
    this.user = data.user;
    this.token = data.token;
  }
}
