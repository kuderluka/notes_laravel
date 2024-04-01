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
  @Input() data: any[] = [];
  @Input() title: string = '';
  view: [number, number] = [550, 200];

  gradient: boolean = true;
  showLegend: boolean = true;
  showLabels: boolean = true;
  isDoughnut: boolean = false;

  constructor() {
    Object.assign(this, { this: this.data });
  }
}