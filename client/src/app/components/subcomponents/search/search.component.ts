import { Component, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'notes-search',
  standalone: true,
  imports: [],
  templateUrl: './search.component.html',
  styleUrl: './search.component.css'
})
export class SearchComponent {
  @Output() searchEvent = new EventEmitter<string>()

  constructor() { }

  onSearch(value: string): void {
    this.searchEvent.emit(value);
  }
}
