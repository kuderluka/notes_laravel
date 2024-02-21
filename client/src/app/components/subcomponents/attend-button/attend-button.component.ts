import {Component, Input} from '@angular/core';
import {AuthService} from "../../../services/auth.service";
import {User} from "../../../interfaces/user";
import {NgIf} from "@angular/common";
import {EventService} from "../../../services/event.service";
import {Router} from "@angular/router";
import {log} from "util";

@Component({
  selector: 'notes-attend-button',
  standalone: true,
  imports: [
    NgIf
  ],
  templateUrl: './attend-button.component.html',
  styleUrl: './attend-button.component.css'
})
export class AttendButtonComponent {
  @Input() event_id: string = '';
  private user: User = this.authService.getUser();
  private event: any;

  constructor(private router: Router, private authService: AuthService, private eventService: EventService) {}

  ngOnInit() {
    try {
      this.eventService.getEventDetails(this.event_id).then((res: any) => {
        this.event = res.data.event;
      })
    } catch (error) {
      console.error('Failed to fetch event details:', error);
    }
  }

  isAttendee() {
    if (!this.event || !this.event.participants || !this.user) {
      return false;
    }
    return this.event.participants.some((participant: any) => participant.email === this.user.email);
  }

  async removeAttendee() {
    try {
      const res = await this.eventService.removeAttendee(this.event_id, this.user.email);
      if (res.message) {
        //Vem da to ni pravi nacin ampak za angular 17 nisem nasl vredu dokumentacijo kak spremenit route reuse zato sm kr to uporabu
        this.router.navigate(['/']).then(() => { this.router.navigate(['/events', this.event_id]) })
      }
    } catch (error) {
      console.error('Failed to remove attendee:', error);
    }
  }

  async addAttendee() {
    try {
      const res = await this.eventService.addAttendee(this.event_id, this.user.email);
      if (res.message) {
        //Vem da to ni pravi nacin ampak za angular 17 nisem nasl vredu dokumentacijo kak spremenit route reuse zato sm kr to uporabu
        this.router.navigate(['/']).then(() => { this.router.navigate(['/events', this.event_id]) })
      }
    } catch (error) {
      console.error('Failed to add attendee:', error);
    }
  }
}
