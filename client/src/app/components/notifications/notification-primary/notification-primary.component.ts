import { Component, Input } from '@angular/core';
import { NgIf } from "@angular/common";
import { RedirectButtonComponent } from "../../subcomponents/buttons/redirect-button/redirect-button.component";

@Component({
  selector: 'notes-notification-primary',
  standalone: true,
  imports: [
    NgIf,
    RedirectButtonComponent
  ],
  templateUrl: './notification-primary.component.html',
  styleUrl: './notification-primary.component.css'
})
export class NotificationPrimaryComponent {
  @Input() public color: any;
  @Input() public text: string = '';
  @Input() public button: any;
}
