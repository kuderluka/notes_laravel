import { Component } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { EventService } from "../../../services/event.service";
import { NgForOf, NgIf } from "@angular/common";
import { AttendButtonComponent } from "../../subcomponents/attend-button/attend-button.component";

@Component({
  selector: 'notes-event-details',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    AttendButtonComponent
  ],
  templateUrl: './event-details.component.html'
})
export class EventDetailsComponent {
  id: string = '';
  event: any;

  constructor(private route: ActivatedRoute, private eventService: EventService) {}

  ngOnInit() {
    this.id = this.route.snapshot.params['id'];
    this.eventService.getEventDetails(this.id).subscribe((res: any) => {
      this.event = res.data.event;
    });
  }
}
