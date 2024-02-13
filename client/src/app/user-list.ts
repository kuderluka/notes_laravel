import { User } from "./user";

export interface UserList {
  heading: string;
  public: boolean;
  entries: User[];
}
