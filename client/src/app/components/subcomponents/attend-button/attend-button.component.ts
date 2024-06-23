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
  @Input() disabled: boolean = false;
  private user: User = this.authService.getUser();
  private event: any;

  constructor(private router: Router, private authService: AuthService, private eventService: EventService) {}

  ngOnInit() {
    try {
      this.eventService.getEventDetails(this.event_id).subscribe((res: any) => {
        this.event = res.data.event;
      })
    } catch (error) {
      console.error('Failed to fetch event details:', error);
    }
  }

  /*
    Checks if the authenticated user is an attendee of a certain event
   */
  isAttendee(): boolean {
    if (!this.event || !this.event.participants || !this.user) {
      return false;
    }
    return this.event.participants.some((participant: any) => participant.email === this.user.email);
  }

  /**
   * Removes an attendee from an event
   */
  removeAttendee(): void {
    this.eventService.removeAttendee(this.event_id, this.user.email).subscribe((res: any) => {
      if (res.message) {
        //Vem da to ni pravi nacin ampak za angular 17 nisem nasl vredu dokumentacijo kak spremenit route reuse zato sm kr to uporabu
        this.router.navigate(['/']).then(() => { this.router.navigate(['/events', this.event_id]) })
      } else {
        console.error('Failed to remove attendee:' + res);
      }
    })
  }

  /**
   * Adds the user as an attendee of an event
   */
  addAttendee(): void {
    this.eventService.addAttendee(this.event_id, this.user.email).subscribe(
      {
        next: (res: any) => {

        }
      }




      // (res: any) => {
      // if (res.message) {
      //   //Vem da to ni pravi nacin ampak za angular 17 nisem nasl vredu dokumentacijo kak spremenit route reuse zato sm kr to uporabu
      //   this.router.navigate(['/']).then(() => { this.router.navigate(['/events', this.event_id]) })
      // } else {
      //   console.error('Failed to add attendee:' + res);
      // }
    )
  }
}
