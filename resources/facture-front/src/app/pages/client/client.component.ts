import { Component } from '@angular/core';
import { NavbarComponent } from "../../components/navbar/navbar.component";
import { CommonModule } from '@angular/common';
import { ModalClientComponent } from "../../components/shared/modal-client/modal-client.component";

@Component({
  selector: 'app-client',
  imports: [NavbarComponent, CommonModule, ModalClientComponent],
  templateUrl: './client.component.html',
  styleUrl: './client.component.scss'
})
export class ClientComponent {

  isOpenModal = false ;

  OpenModalClient() {
    this.isOpenModal = true ;
  }

    closeModal() {
    this.isOpenModal = false ;
  }

}
