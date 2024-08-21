import {Component, Input} from '@angular/core';
import {ReactiveFormsModule} from "@angular/forms";
import {NgIf} from "@angular/common";

@Component({
  selector: 'notes-text-input',
  standalone: true,
  imports: [
    ReactiveFormsModule,
    NgIf
  ],
  templateUrl: './text-input.component.html',
  styleUrl: './text-input.component.css'
})
export class TextInputComponent {
  @Input() placeholder: string = '';
  @Input() name: string = '';
  @Input() id: string = '';
  @Input() title: string = '';
  @Input() type: string = "text";

  // protected hasTitle(): boolean {
  //   return this.title;
  // }
}
