import { Component } from '@angular/core';
import { SightService } from '../services/sight.service';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {

  constructor(public sightService: SightService) {}
}
