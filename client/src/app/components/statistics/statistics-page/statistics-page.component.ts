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

          return { user: element.user, notes: element.notes, events: events};
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

    console.log(this.data.categories)
  }

  /**
   * Extracts and returns the category popularity data for top 5 categories
   *
   * @protected
   */
  protected getCategoryPopularityData(): any {
    return [
      {
        "name": "Germany",
        "value": 894000
      },
      {
        "name": "USA",
        "value": 500000
      },
      {
        "name": "France",
        "value": 720000
      },
      {
        "name": "USAa",
        "value": 500000
      },
      {
        "name": "Fraance",
        "value": 720000
      }
    ];
  }
}
