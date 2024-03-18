import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators} from '@angular/forms';
import { CommonModule } from "@angular/common";
import { AuthService } from "../../../services/auth.service";
import { NotesService } from "../../../services/notes.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'notes-note-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './note-form.component.html',
  styleUrl: './note-form.component.css'
})
export class NoteFormComponent implements OnInit {
  form!: FormGroup;
  submitted = false;
  categories: any[] = [];
  entry: any;

  constructor(private route: ActivatedRoute, private formBuilder: FormBuilder, private notesService: NotesService, private router: Router) { }

  ngOnInit(): void {
    if (this.route.snapshot.params['note']) {
      this.entry = JSON.parse(this.route.snapshot.params['note']);
    }

    this.form = this.formBuilder.group({
      user_id: [this.notesService.getUser().id],
      category_id: [this.entry?.category_id, Validators.required],
      title: [this.entry?.title, [Validators.required, Validators.minLength(5), Validators.maxLength(30)]],
      content: [this.entry?.content, [Validators.required, Validators.maxLength(500)]],
      priority: [this.entry?.priority, [Validators.required, Validators.min(1), Validators.max(5)]],
      deadline: [this.entry?.date, [Validators.required, this.validateDeadline]],
      tags: [this.entry?.tags, [Validators.required, Validators.maxLength(200)]],
      public: [this.entry?.public]
    });

    this.notesService.getCategories().then((res: any) => {
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
      console.log(JSON.stringify(this.form.value, null, 2));
      return;
    }

    console.log(JSON.stringify(this.form.value, null, 2));

    if (this.entry) {
      this.notesService.updateNote(this.form, this.entry.id).then(res => {
        this.router.navigate(['workspace']);
      })
    } else {
      this.notesService.createNote(this.form).then(res => {
        this.router.navigate(['workspace']);
      })
    }
  }
}
