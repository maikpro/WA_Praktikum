import { Component } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { SightService } from '../services/sight.service';
import { AddSightComponent } from './add-sight/add-sight.component';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {

  constructor(public sightService: SightService, private modalController: ModalController) {}

  public async showModal(): Promise<void> {
    const modal = await this.modalController.create({
      component: AddSightComponent
    });

    // hole Daten aus Modal
    modal.onDidDismiss()
      .then((data) => {
        const newSight = data.data;
        if(newSight !== undefined){
          console.log(newSight);
          // TODO: Speichere Sight in Array ab!
          this.sightService.saveSight(newSight);
        }
    });

    return await modal.present(); // öffnet das Modal AddSightComponent
  }
}
