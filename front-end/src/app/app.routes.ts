import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path:'',
    loadComponent:()=>import('./home/welcome.component').then(c=>c.WelcomeComponent),
    title:'Inicio de sesión'
  },
];
