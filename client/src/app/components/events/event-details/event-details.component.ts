import { Component } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {EventService} from "../../../services/event.service";
import {NgForOf, NgIf} from "@angular/common";
import {AttendButtonComponent} from "../../subcomponents/attend-button/attend-button.component";

@Component({
  selector: 'notes-event-details',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    AttendButtonComponent
  ],
  templateUrl: './event-details.component.html',
  styleUrl: './event-details.component.css'
})
export class EventDetailsComponent {
  id: string = '';
  event: any;

  constructor(private route: ActivatedRoute, private service: EventService) {}

  ngOnInit() {
    this.id = this.route.snapshot.params['id'];
    this.service.getEventDetails(this.id).then((res: any) => {
      this.event = res.data.event;
    });
  }
}
