import { Routes } from '@angular/router';
import { UserListComponent } from "./user/user-list/user-list.component";
import { LandingComponent } from "./landing/landing.component";
import { UserDetailsComponent } from "./user/user-details/user-details.component";
import { PublicComponent } from "./public/public.component";
import { LoginComponent } from "./login/login.component";
import { RegisterComponent } from "./register/register.component";

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
  }
];
