import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AttendButtonComponent } from './attend-button.component';

describe('AttendButtonComponent', () => {
  let component: AttendButtonComponent;
  let fixture: ComponentFixture<AttendButtonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AttendButtonComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(AttendButtonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
