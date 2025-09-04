import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { NavbarComponent } from "../../components/navbar/navbar.component";

@Component({
  selector: 'app-produits',
  imports: [CommonModule, NavbarComponent],
  templateUrl: './produits.component.html',
  styleUrl: './produits.component.scss'
})
export class ProduitsComponent {
  users = [
  {
    name: 'James Butt',
    country: 'Algeria',
    flag: 'https://flagcdn.com/dz.svg',
    joinDate: '01/15/2023',
    createdBy: 'Iori Bowcher',
    activity: 80
  },
  {
    name: 'Josephine Darakjy',
    country: 'Panama',
    flag: 'https://flagcdn.com/pa.svg',
    joinDate: '03/22/2023',
    createdBy: 'Amy Eisner',
    activity: 65
  },
  {
    name: 'Art Venere',
    country: 'Slovenia',
    flag: 'https://flagcdn.com/si.svg',
    joinDate: '06/10/2023',
    createdBy: 'Iori Bowcher',
    activity: 90
  },  {
    name: 'Francois',
    country: 'Slovenia',
    flag: 'https://flagcdn.com/si.svg',
    joinDate: '06/10/2023',
    createdBy: 'Iori Bowcher',
    activity: 20
  },  {
    name: 'Belagny',
    country: 'Slovenia',
    flag: 'https://flagcdn.com/si.svg',
    joinDate: '06/10/2023',
    createdBy: 'Iori Bowcher',
    activity: 55
  },  {
    name: 'Rapierre',
    country: 'Slovenia',
    flag: 'https://flagcdn.com/si.svg',
    joinDate: '06/10/2023',
    createdBy: 'Iori Bowcher',
    activity: 100
  }
];


}
