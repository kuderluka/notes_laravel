import {Component, Input} from '@angular/core';
import {FormBuilder, FormGroup, ReactiveFormsModule, Validators} from "@angular/forms";
import {Router, RouterLink} from "@angular/router";
import {AuthService} from "../../services/auth.service";
import {EventService} from "../../services/event.service";
import {TextInputComponent} from "../subcomponents/text-input/text-input.component";

@Component({
    selector: 'notes-profile',
    standalone: true,
    imports: [
      ReactiveFormsModule,
      RouterLink,
      TextInputComponent
    ],
    templateUrl: './profile.component.html',
    styleUrl: './profile.component.css'
})
export class ProfileComponent {
    public usernameForm!: FormGroup;

    constructor(private authService: AuthService, private formBuilder: FormBuilder) {}

    ngOnInit(): void {
        this.usernameForm = this.formBuilder.group({
            username: ['', Validators.required]
        });
    }

    protected change_username(): void {
        console.log(this.usernameForm.value);
    }
}
