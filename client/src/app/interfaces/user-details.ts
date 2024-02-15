import {User} from "./user";
import {Note} from "./note";

export interface UserDetails {
  user: User
  notes: Note[];
  events: Event[];
}
