import {Component} from '@angular/core';
import {RouterOutlet} from '@angular/router';

import {NavigationComponent} from "./navigation/navigation.component";
import {ContentComponent} from "./content/content.component";

@Component({
    selector: 'notes-root',
    standalone: true,
    imports: [RouterOutlet, NavigationComponent, ContentComponent],
    templateUrl: './app.component.html',
    styleUrl: './app.component.css'
})
export class AppComponent {
    title = 'client';
}
