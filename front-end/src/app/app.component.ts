import { Component, OnInit } from '@angular/core';
import { Router, RouterOutlet } from '@angular/router';
import { WelcomeComponent } from './home/welcome.component';
import { ScreenTwoComponent } from './home/screentwo/screentwo.component';
import { ScreenThreeComponent } from './home/screentree/screentree.component';
import { HistoryComponent } from './home/history/history.component';
import { TranslateModule } from '@ngx-translate/core';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet,WelcomeComponent,ScreenTwoComponent,ScreenThreeComponent,HistoryComponent,TranslateModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent implements OnInit{
  constructor(private router: Router) { }
  ngOnInit(): void {

      this.router.navigate(['']);

  }
}
