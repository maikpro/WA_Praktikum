import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BooksComponent } from './books/books.component';
import { ContactComponent } from './contact/contact.component';
import { HomeComponent } from './home/home.component';
import { RatingComponent } from './rating/rating.component';

const routes: Routes = [
  {
    // Standardroute: Umleitung auf '/home'
    path: '',
    redirectTo: 'home',
    pathMatch: 'full'
  },
  {
    path: 'home',
    component: HomeComponent
  },
  {
    path: 'books',
    component: BooksComponent
  },
  {
    path: 'rating',
    component: RatingComponent
  },
  {
    path: 'contact',
    component: ContactComponent  
  }
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
