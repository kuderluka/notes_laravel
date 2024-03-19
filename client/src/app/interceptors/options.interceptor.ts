import { HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Observable } from "rxjs";
import { AuthService } from "../services/auth.service";
import { Injectable } from "@angular/core";
import { EventService } from "../services/event.service";

@Injectable()
export class OptionsInterceptor implements HttpInterceptor {
  private token: string = '';

  constructor(private authService: AuthService, private eventService: EventService) {}

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

    if (req.url.includes('events')) {
      this.token = this.eventService.getToken();
    } else {
      this.token = this.authService.getToken();
    }

    req = req.clone({
      setHeaders: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + this.token
      },
    });

    return next.handle(req);
  }
}
