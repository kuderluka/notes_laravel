import {Component} from '@angular/core';
import {RouterOutlet} from '@angular/router';

import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';

import {NavigationComponent} from "./navigation/navigation.component";
import {ContentComponent} from "./content/content.component";

@Component({
    selector: 'notes-root',
    standalone: true,
    imports: [RouterOutlet, NavigationComponent, ContentComponent, HttpClientModule],
    templateUrl: './app.component.html',
    styleUrl: './app.component.css'
})
export class AppComponent {
    title = 'client';
}
