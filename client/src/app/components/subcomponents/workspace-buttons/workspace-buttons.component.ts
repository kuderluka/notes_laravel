import { Component } from '@angular/core';
import {RouterLink} from "@angular/router";

@Component({
  selector: 'notes-workspace-buttons',
  standalone: true,
  imports: [
    RouterLink
  ],
  templateUrl: './workspace-buttons.component.html',
  styleUrl: './workspace-buttons.component.css'
})
export class WorkspaceButtonsComponent {

}
