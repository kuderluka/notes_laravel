import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OptionsInterceptorProviderComponent } from './options-interceptor-provider.component';

describe('OptionsInterceptorProviderComponent', () => {
  let component: OptionsInterceptorProviderComponent;
  let fixture: ComponentFixture<OptionsInterceptorProviderComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [OptionsInterceptorProviderComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(OptionsInterceptorProviderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
