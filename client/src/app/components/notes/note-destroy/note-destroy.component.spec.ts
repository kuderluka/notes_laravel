import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NoteDestroyComponent } from './note-destroy.component';

describe('NoteDestroyComponent', () => {
  let component: NoteDestroyComponent;
  let fixture: ComponentFixture<NoteDestroyComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [NoteDestroyComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(NoteDestroyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
