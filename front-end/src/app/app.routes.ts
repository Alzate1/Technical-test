import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path:'',
    loadComponent:()=>import('./home/welcome.component').then(c=>c.WelcomeComponent),
    title:'Bienvenido',
  },
  // { path: '**', redirectTo: '' } ,
  {
    path:'screentwo',
    title:'Paso 2',
    loadComponent:()=>import('./home/screentwo/screentwo.component').then(c=>c.ScreenTwoComponent),
  },
  {
    path:'screenthree',
    title:'Paso 3',
    loadComponent:()=>import('./home/screentree/screentree.component').then(c=>c.ScreenThreeComponent),
  },

  {
    path:'history',
    title:'Paso 3',
    loadComponent:()=>import('./home/history/history.component').then(c=>c.HistoryComponent),
  },

];
