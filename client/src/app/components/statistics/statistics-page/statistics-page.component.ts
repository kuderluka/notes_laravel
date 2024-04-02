import { Component } from '@angular/core';
import {NgIf} from "@angular/common";
import {AdvancedPieChartComponent} from "../advanced-pie-chart/advanced-pie-chart.component";
import {AuthService} from "../../../services/auth.service";
import {NoteService} from "../../../services/note.service";
import {EventService} from "../../../services/event.service";
import {VerticalBarChartComponent} from "../vertical-bar-chart/vertical-bar-chart.component";

@Component({
  selector: 'notes-statistics-page',
  standalone: true,
  imports: [
    NgIf,
    AdvancedPieChartComponent,
    VerticalBarChartComponent
  ],
  templateUrl: './statistics-page.component.html',
  styleUrl: './statistics-page.component.css'
})
export class StatisticsPageComponent {
  protected data: any = [];

  public constructor(
    public authService: AuthService,
    public noteService: NoteService,
    public eventService: EventService
  ) {}

  public ngOnInit(): void {
    this.fetchData();
  }

  private fetchData(): void {
    this.noteService.getStatisticsData().subscribe({
      next: (res: any) => {
        this.data.notes = res.data.notes;
        this.data.categories = res.data.categories;
        this.data.users = res.data.users.map((element: any) => {
          let events: any = [];
          this.eventService.getUsersEvents(element.user.email).subscribe((res: any) => {
            events = res;
          });

          return {user: element.user, notes: element.notes, events: events};
        });
      },

      error: (res: any) => {
        console.error('Error fetching users');
      }
    });

    this.eventService.getAllEvents().subscribe({
      next: (res: any) => {
        this.data.events = res.data.events.total
      },
      error: (res: any) => {
        console.error('Error fetching events');
      }
    });
  }

  /**
   * Extracts and returns the data for the Notes-Events ratio pie chart
   *
   * @protected
   */
  protected getNotesEventsRatio(): any {
    return [
      {
        "name": "Events",
        "value": this.data.events
      },
      {
        "name": "Notes",
        "value": this.data.notes.length
      }
    ];
  }

  /**
   * Return the data needed to display the note privacy pie chart
   *
   * @protected
   */
  protected getNotePrivacyData(): any {
    const publicNotes: any = this.data.notes.filter((note: any) => note.public);
    const publicCount: number = publicNotes.length;

    return [
      {
        name: "Public",
        value: publicCount
      },
      {
        name: "Private",
        value: this.data.notes.length - publicCount
      }
    ];
  }

  /**
   * Extracts and returns the data about how many users have an event connected to their account
   *
   * @protected
   */
  protected getEventAttendanceData(): any {
    let attending: number = 0;

    this.data.users.forEach((user: any) => {
      if (user.events.length != 0) {
        attending++;
      }
    });

    return [
      {
        "name": "Have attended",
        "value": attending
      },
      {
        "name": "Have not attended",
        "value": this.data.users.length - attending
      }
    ];
  }

  /**
   * Extracts and returns the category popularity data for top 5 categories
   *
   * @protected
   */
  protected getCategoryPopularityData(): any {
    let output: any[] = [];
    this.data.notes.forEach((note: any) => {
      let existing = output.find(entry => entry.name === note.category.title);

      if (existing) {
        existing.value += 1;
      } else {
        output.push({
          "name": note.category.title,
          "value": 1
        });
      }
    });

    return output.sort((a, b) => b.value - a.value).slice(0,5);
  }

  /**
   * Extracts and returns the data about users note creation
   *
   * @protected
   */
  protected getNoteCreationData(): any {
    let haveCreated: number = 0;
    this.data.users.forEach((user: any) => {
      if (user.notes.length != 0) {
        haveCreated++;
      }
    });

    return [
      {
        "name": "Have created",
        "value": haveCreated
      },
      {
        "name": "Have not created",
        "value": this.data.users.length - haveCreated
      }
    ];
  }
}
