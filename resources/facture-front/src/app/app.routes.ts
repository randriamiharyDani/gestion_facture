import { Routes } from '@angular/router';

export const routes: Routes = [
   {
    path: '',
    redirectTo: '',
    pathMatch: 'full'
  },
  {
    path: '',
    loadComponent: () => import('./pages/dashboard/dashboard.component')
      .then(m => m.DashboardComponent)
  },
  {
    path : 'clients',
    loadComponent: () => import('./pages/client/client.component')
      .then(m=> m.ClientComponent)
  },
   {
    path : 'produits',
    loadComponent: () => import('./pages/produits/produits.component')
      .then(m=> m.ProduitsComponent)
  },
   {
    path : 'fournisseurs',
    loadComponent: () => import('./pages/fournisseurs/fournisseurs.component')
      .then(m=> m.FournisseursComponent)
  },
    {
    path : 'factures',
    loadComponent: () => import('./pages/factures/factures.component')
      .then(m=> m.FacturesComponent)
  },
     {
    path : 'devis',
    loadComponent: () => import('./pages/devis/devis.component')
      .then(m=> m.DevisComponent)
  },
   {
    path : 'commandes',
    loadComponent: () => import('./pages//commandes/commandes.component')
      .then(m=> m.CommandesComponent)
  },
   {
    path : 'statistiques',
    loadComponent: () => import('./pages/statistiques/statistiques.component')
      .then(m=> m.StatistiquesComponent)
  },
   {
    path : 'parametres',
    loadComponent: () => import('./pages/parametres/parametres.component')
      .then(m=> m.ParametresComponent)
  },

  { path: '**', redirectTo: 'dashboard' }
];
