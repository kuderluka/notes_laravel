import {Component, Input} from '@angular/core';
import {NgxChartsModule} from "@swimlane/ngx-charts";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";

@Component({
  selector: 'notes-vertical-bar-chart',
  standalone: true,
  imports: [
    NgxChartsModule
  ],
  templateUrl: './vertical-bar-chart.component.html',
  styleUrl: './vertical-bar-chart.component.css'
})
export class VerticalBarChartComponent {
  @Input() data: any[] = [];
  @Input() title: string = '';
  @Input() xAxisLabel: string = 'xLabel';
  @Input() yAxisLabel: string = 'yLabel';
  view: [number, number] = [550, 300];

  showXAxis = true;
  showYAxis = true;
  gradient = false;
  showLegend = true;
  showXAxisLabel = true;
  showYAxisLabel = true;

  constructor() {
    Object.assign(this, { this: this.data })
  }
}
