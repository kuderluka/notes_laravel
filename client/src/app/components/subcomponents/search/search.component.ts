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

  /**
   * Emits the value entered into the search field on button click
   *
   * @param value
   */
  onSearch(value: string): void {
    this.searchEvent.emit(value);
  }
}
