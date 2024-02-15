import { User } from "./user";
import { Note } from "./note";
import { Event } from "./event";

export interface UserDetails {
  user: User
  notes: Note[];
  events: Event[];
}
