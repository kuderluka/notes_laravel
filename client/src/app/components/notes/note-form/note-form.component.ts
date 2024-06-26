import { Component, Input, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { CommonModule } from "@angular/common";
import { NoteService } from "../../../services/note.service";
import { ActivatedRoute, Router } from "@angular/router";

@Component({
  selector: 'notes-note-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './note-form.component.html'
})
export class NoteFormComponent implements OnInit {
  protected form!: FormGroup;
  protected submitted = false;
  protected categories: any[] = [];
  @Input() note: any;

  constructor(private route: ActivatedRoute, private formBuilder: FormBuilder, private notesService: NoteService, private router: Router) { }

  ngOnInit(): void {
    this.note = this.notesService.getNote();

    this.form = this.formBuilder.group({
      user_id: [this.notesService.getUser().id],
      category_id: [this.note?.category_id, Validators.required],
      title: [this.note?.title, [Validators.required, Validators.minLength(5), Validators.maxLength(30)]],
      content: [this.note?.content, [Validators.required, Validators.maxLength(500)]],
      priority: [this.note?.priority, [Validators.required, Validators.min(1), Validators.max(5)]],
      deadline: [this.note?.date, [Validators.required, this.validateDeadline]],
      tags: [this.note?.tags, [Validators.required, Validators.maxLength(200)]],
      public: [this.note?.public]
    });

    this.notesService.getCategories().subscribe((res: any) => {
      this.categories = res.data.categories;
    })
  }

  /*
    Checks if the entered date is in the future
   */
  validateDeadline(control: any) {
    const deadline = new Date(control.value);
    const currentDate = new Date();
    return deadline > currentDate ? null : { invalidDate: true };
  }

  get f(): { [key: string]: AbstractControl } {
    return this.form.controls;
  }

  onSubmit(): void {
    this.submitted = true;

    if (this.form.invalid) {
      return;
    }

    if (this.note) {
      this.notesService.updateNote(this.form, this.note.id).subscribe(res => {})
    } else {
      this.form.value.public = 0;
      this.notesService.createNote(this.form).subscribe(res => {})
    }

    this.router.navigate(['workspace']);
  }
}
