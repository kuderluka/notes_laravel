import { Component, Input } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { NgxChartsModule } from '@swimlane/ngx-charts';

@Component({
  selector: 'notes-advanced-pie-chart',
  standalone: true,
  imports: [
    NgxChartsModule
  ],
  templateUrl: './advanced-pie-chart.component.html',
  styleUrl: './advanced-pie-chart.component.css'
})
export class AdvancedPieChartComponent {
  @Input() protected data: any[] = [];
  @Input() protected title: string = '';
  protected view: [number, number] = [550, 200];

  protected gradient: boolean = true;
  protected showLegend: boolean = true;
  protected showLabels: boolean = true;
  protected isDoughnut: boolean = false;
}
