import { Routes } from '@angular/router';
import { UserListComponent } from "./components/user/user-list/user-list.component";
import { LandingComponent } from "./components/landing/landing.component";
import { UserDetailsComponent } from "./components/user/user-details/user-details.component";
import { PublicComponent } from "./components/public/public.component";
import { LoginComponent } from "./auth/login/login.component";
import { RegisterComponent } from "./auth/register/register.component";
import { WorkspaceComponent } from "./components/user/workspace/workspace.component";
import { authGuard } from "./guards/auth.guard";
import { EventListComponent } from "./components/events/event-list/event-list.component";
import { EventDetailsComponent } from "./components/events/event-details/event-details.component";
import { CategoryFormComponent } from "./components/categories/category-form/category-form.component";
import { NoteFormComponent } from "./components/notes/note-form/note-form.component";
import {StatisticsPageComponent} from "./components/statistics/statistics-page/statistics-page.component";

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
    children: [
      {
        path: '',
        component: UserListComponent,
        title: 'All users',
      },
      {
        path: ':id/:email',
        component: UserDetailsComponent,
        title: 'Details about a user',
      }
    ]
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
    path: 'statistics',
    component: StatisticsPageComponent,
    title: 'Statistics',
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
    children: [
      {
        path: '',
        component: EventListComponent,
        title: 'Events'
      },
      {
        path: ':id',
        component: EventDetailsComponent,
        title: 'Event details'
      }
    ]
  },
  {
    path: 'category/create',
    canActivate: [authGuard],
    component: CategoryFormComponent,
    title: 'New Category',
  },
  {
    path: 'note',
    canActivate: [authGuard],
    children: [
      {
        path: 'create',
        component: NoteFormComponent,
        title: 'New Note',
      },
      {
        path: ':note',
        component: NoteFormComponent,
        title: 'Edit Note',
      }
    ]
  }
];
