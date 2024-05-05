import { Component } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { EventService } from "../../../services/event.service";
import { NgForOf, NgIf } from "@angular/common";
import { AttendButtonComponent } from "../../subcomponents/attend-button/attend-button.component";
import { NotificationPrimaryComponent } from "../../notifications/notification-primary/notification-primary.component";

@Component({
  selector: 'notes-event-details',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    AttendButtonComponent,
    NotificationPrimaryComponent
  ],
  templateUrl: './event-details.component.html'
})
export class EventDetailsComponent {
  private id: string = '';
  protected event: any;
  protected user: any;
  protected disabled: boolean = true;

  constructor(private route: ActivatedRoute, private eventService: EventService) {}

  ngOnInit() {
    this.id = this.route.snapshot.params['id'];
    this.eventService.getEventDetails(this.id).subscribe({
      next: (res: any) => {
        this.event = res.data.event;
        this.user = this.eventService.getUser();

        if (this.user.email_verified_at) {
          this.disabled = false;
        }
      }
    });
  }
}
