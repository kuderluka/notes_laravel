import { Routes } from '@angular/router';
import { UserListComponent } from "./components/user/user-list/user-list.component";
import { LandingComponent } from "./components/landing/landing.component";
import { UserDetailsComponent } from "./components/user/user-details/user-details.component";
import { PublicComponent } from "./components/public/public.component";
import { LoginComponent } from "./auth/login/login.component";
import { RegisterComponent } from "./auth/register/register.component";
import { AuthService } from "./services/auth.service";
import {WorkspaceComponent} from "./components/user/workspace/workspace.component";
import {authGuard} from "./guards/auth.guard";
import {EventsListComponent} from "./components/events/events-list/events-list.component";
import {ProfileComponent} from "./components/user/profile/profile.component";

export const routes: Routes = [
  {
    path: '',
    component: LandingComponent,
    title: 'LandingPage',
  },
  {
    path: 'public',
    component: PublicComponent,
    title: 'All public notes',
  },
  {
    path: 'users',
    component: UserListComponent,
    title: 'All users',
  },
  {
    path: 'users/:id',
    component: UserDetailsComponent,
    title: 'Details about a user',
  },
  {
    path: 'login',
    component: LoginComponent,
    title: 'Login form',
  },
  {
    path: 'register',
    component: RegisterComponent,
    title: 'Register form',
  },
  {
    path: 'dashboard',
    component: LandingComponent,
    title: 'Dashboard',
  },
  {
    path: 'workspace',
    canActivate: [authGuard],
    component: WorkspaceComponent,
    title: 'Workspace',
  },
  {
      path: 'events',
      canActivate: [authGuard],
      component: EventsListComponent,
      title: 'Events',
  },
  {
      path: 'profile',
      canActivate: [authGuard],
      component: ProfileComponent,
      title: 'Profile',
  }
];
