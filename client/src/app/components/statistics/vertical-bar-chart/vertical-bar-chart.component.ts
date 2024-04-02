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
  @Input() protected data: any[] = [];
  @Input() protected title: string = '';
  @Input() protected xAxisLabel: string = 'xLabel';
  @Input() protected yAxisLabel: string = 'yLabel';
  protected view: [number, number] = [550, 300];

  protected showXAxis = true;
  protected showYAxis = true;
  protected gradient = false;
  protected showLegend = true;
  protected showXAxisLabel = true;
  protected showYAxisLabel = true;
}
