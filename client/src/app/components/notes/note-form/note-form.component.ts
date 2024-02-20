import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators} from '@angular/forms';
import { CommonModule } from "@angular/common";
import { AuthService } from "../../../services/auth.service";
import { NotesService } from "../../../services/notes.service";
import { Router } from "@angular/router";

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

  constructor(private formBuilder: FormBuilder, private service: NotesService, private router: Router) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      category_id: ['', Validators.required],
      title: ['', [Validators.required, Validators.minLength(5), Validators.maxLength(30)]],
      content: ['', [Validators.required, Validators.maxLength(500)]],
      priority: [1, [Validators.required, Validators.min(1), Validators.max(5)]],
      deadline: ['', [Validators.required, this.validateDeadline]],
      tags: ['', [Validators.required, Validators.maxLength(200)]],
      public: [false]
    });

    this.service.getCategories().then((res: any) => {
      this.categories = res.data.categories;
    })
  }

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

    this.service.createNote(this.form).then(res => {
      this.router.navigate(['workspace']);
    });
  }
}
