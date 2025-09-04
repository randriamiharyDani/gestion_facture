import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalProduitComponent } from './modal-produit.component';

describe('ModalProduitComponent', () => {
  let component: ModalProduitComponent;
  let fixture: ComponentFixture<ModalProduitComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ModalProduitComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalProduitComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
