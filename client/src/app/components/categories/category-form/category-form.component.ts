import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators} from '@angular/forms';
import { CommonModule } from "@angular/common";
import { NoteService } from "../../../services/note.service";
import { Router } from "@angular/router";

@Component({
  selector: 'notes-category-form',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './category-form.component.html',
  styleUrl: './category-form.component.css'
})
export class CategoryFormComponent implements OnInit {
  form!: FormGroup;
  submitted = false;

  constructor(private formBuilder: FormBuilder, private notesService: NoteService, private router: Router) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      title: ['', [Validators.required, Validators.minLength(3), Validators.maxLength(30)]],
      color: ['', Validators.required]
    });
  }

  get f(): { [key: string]: AbstractControl } {
    return this.form.controls;
  }

  onSubmit(): void {
    this.submitted = true;

    if (this.form.invalid) {
      return;
    }

    this.notesService.createCategory(this.form).subscribe((res: any) => {
      this.router.navigate(['workspace']);
    });
  }
}
