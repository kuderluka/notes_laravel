import { Component, Input } from '@angular/core';
import { NgForOf, NgIf } from "@angular/common";
import { Event } from "../../../interfaces/event";
import { EventService } from "../../../services/event.service";
import { EventButtonComponent } from "../../subcomponents/event-button/event-button.component";
import { NgbPagination } from "@ng-bootstrap/ng-bootstrap";
import { EventTableComponent } from "../event-table/event-table.component";

@Component({
  selector: 'notes-event-list',
  standalone: true,
  imports: [
    NgForOf,
    NgIf,
    EventButtonComponent,
    NgbPagination,
    EventTableComponent
  ],
  templateUrl: './event-list.component.html'
})
export class EventListComponent {
    @Input() events!: Event[];
    @Input() public: boolean = true;
    currentPage = 1;
    totalItems = 0;
    itemsPerPage = 0;

    constructor(private eventService: EventService) {}

    ngOnInit() {
      if (this.public) {
        this.loadEvents();
      }
    }

    loadEvents(): void {
      this.eventService.getEvents(this.currentPage).subscribe((res: any) => {
        this.events = res.data.events.data;
        this.totalItems = res.data.events.total;
        this.itemsPerPage = res.data.events.per_page;
      });
    }

    onPageChange(pageNumber: number): void {
      this.currentPage = pageNumber;
      this.loadEvents();
    }
}
