import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

import { NavigationComponent } from "./navigation/navigation.component";

@Component({
    selector: 'notes-root',
    standalone: true,
    imports: [
      RouterOutlet,
      NavigationComponent,
      HttpClientModule
    ],
    templateUrl: './app.component.html',
    styleUrl: './app.component.css'
})
export class AppComponent {
    title = 'client';
}
