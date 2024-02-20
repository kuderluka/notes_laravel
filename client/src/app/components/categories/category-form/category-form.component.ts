import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, ReactiveFormsModule, Validators} from '@angular/forms';
import { CommonModule } from "@angular/common";
import {AuthService} from "../../../services/auth.service";
import {NotesService} from "../../../services/notes.service";
import {Router} from "@angular/router";

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

  constructor(private formBuilder: FormBuilder, private service: NotesService, private router: Router) { }

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

    console.log(JSON.stringify(this.form.value, null, 2));

    this.service.createCategory(this.form).then(res => {
      this.router.navigate(['workspace']);
    });
  }
}
