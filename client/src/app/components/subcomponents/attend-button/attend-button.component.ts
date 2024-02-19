import {Component, Input} from '@angular/core';
import {AuthService} from "../../../services/auth.service";
import {User} from "../../../interfaces/user";
import {NgIf} from "@angular/common";
import {EventService} from "../../../services/event.service";
import {Router} from "@angular/router";

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

  async ngOnInit() {
    try {
      this.event = await this.eventService.getEventDetails(this.event_id);
    } catch (error) {
      console.error('Failed to fetch event details:', error);
    }
  }

  isAttendee() {
    return false;
  }

  removeAttendee() {
    this.eventService.removeAttendee(this.event_id, this.user.email);
  }

  async addAttendee() {
    try {
      const res = await this.eventService.addAttendee(this.event_id, this.user.email);
      if (res.message) {
        this.router.navigate(['/']).then(() => { this.router.navigate(['/events', this.event_id]) })
      }
    } catch (error) {
      console.error('Failed to add attendee:', error);
    }
  }
}
