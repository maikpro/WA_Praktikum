/* eslint-disable @typescript-eslint/member-ordering */
/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { Sight } from '../models/sight';
import { GPSService } from '../services/gps.service';
import { SightService } from '../services/sight.service';
import { AddSightComponent } from './add-sight/add-sight.component';
import { PreviewSightComponent } from './preview-sight/preview-sight.component';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {

  constructor(public sightService: SightService, private modalController: ModalController, public gpsService: GPSService) {}

  public async showModalForAdd(): Promise<void> {
    const modal = await this.modalController.create({
      component: AddSightComponent
    });

    // hole Daten aus Modal
    modal.onDidDismiss()
      .then((data) => {
        const newSight = data.data;
        if(newSight !== undefined){
          console.log(newSight);
          this.sightService.saveSight(newSight);
        }
    });

    return await modal.present(); // öffnet das Modal AddSightComponent
  }

  public async showModalForPreview(sight: Sight): Promise<void> {
    const modal = await this.modalController.create({
      component: PreviewSightComponent,
      componentProps: {
        sight
      } // sendet Daten mit ins modal
    });
    return await modal.present();
  }

  public showPosition(): void {
    console.log("clicked!");
    this.gpsService.setGPSPosition();
  }
}
