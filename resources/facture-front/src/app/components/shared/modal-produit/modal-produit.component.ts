import { CommonModule } from '@angular/common';
import { Component, EventEmitter, Input, Output, output } from '@angular/core';

@Component({
  selector: 'app-modal-produit',
  imports: [CommonModule],
  templateUrl: './modal-produit.component.html',
  styleUrl: './modal-produit.component.scss'
})
export class ModalProduitComponent {

  @Input() isOpen: boolean = false ;
  @Input() title : string = '' ;
  @Output() close = new EventEmitter<void>() ;


  onClose() {
    this.close.emit() ;
  }

}
