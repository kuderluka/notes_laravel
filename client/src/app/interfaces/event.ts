import { Musician } from "./musician";

export interface Event {
  id: string;
  name: string;
  address: string;
  date: string;
  time: string;
  description: string;
  ticketPrice: number;
  user_id: string;
  musicians?: Musician[];
}
