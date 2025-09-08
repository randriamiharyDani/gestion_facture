import { CommonModule } from '@angular/common';
import { Component,Input,Output , EventEmitter } from '@angular/core';

@Component({
  selector: 'app-modal-client',
  imports: [CommonModule],
  templateUrl: './modal-client.component.html',
  styleUrl: './modal-client.component.scss'
})
export class ModalClientComponent {

  @Input() isOpen: boolean = false ;
  @Input() title : string = '' ;
  @Output() close = new EventEmitter<void>() ;


  onClose() {
    this.close.emit() ;
  }
}
