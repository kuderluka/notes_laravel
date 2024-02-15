export interface Note {
  id: string;
  user_id: string;
  category_id: string;
  title: string;
  content: string;
  priority: number;
  deadline: string;
  tags: string;
  public: boolean;
}
