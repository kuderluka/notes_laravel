import { Routes } from '@angular/router';
import {UserListComponent} from "./user/user-list/user-list.component";
import {LandingComponent} from "./landing/landing.component";

export const routes: Routes = [
  {
    path: '',
    component: LandingComponent,
    title: 'LandingPage',
  },
  {
    path: 'public',
    component: UserListComponent,
    title: 'All users',
  }
];
