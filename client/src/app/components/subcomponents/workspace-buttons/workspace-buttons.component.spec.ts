import { ComponentFixture, TestBed } from '@angular/core/testing';

import { WorkspaceButtonsComponent } from './workspace-buttons.component';

describe('WorkspaceButtonsComponent', () => {
  let component: WorkspaceButtonsComponent;
  let fixture: ComponentFixture<WorkspaceButtonsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [WorkspaceButtonsComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(WorkspaceButtonsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
