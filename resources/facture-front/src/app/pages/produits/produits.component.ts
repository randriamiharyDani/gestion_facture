import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { NavbarComponent } from "../../components/navbar/navbar.component";
import { ModalProduitComponent } from "../../components/shared/modal-produit/modal-produit.component";

@Component({
  selector: 'app-produits',
  imports: [CommonModule, NavbarComponent, ModalProduitComponent],
  templateUrl: './produits.component.html',
  styleUrl: './produits.component.scss'
})
export class ProduitsComponent {

  isModalOpen = false;
  users = [
    {
      nom: 'bolo',
      prix: '200',
      tva: '20',
      stock: '600',
      description: 'Iori Bowcher',
      activity: 80
    },

  ];

  openModal() {
    this.isModalOpen = true ;
  }

  closeModal() {
    this.isModalOpen = false ;
  }
}

