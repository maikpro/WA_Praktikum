/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { GpsPostion } from 'src/app/models/gps-position';

@Component({
  selector: 'app-add-sight',
  templateUrl: './add-sight.component.html',
  styleUrls: ['./add-sight.component.scss'],
})
export class AddSightComponent implements OnInit {

  constructor(private modalController: ModalController) { }

  public ngOnInit() {}

  public async closeModal(){
    await this.modalController.dismiss(); // Schließt das Modal
  }

  public save(): void {
    const gpsPosition: GpsPostion = {
      lat: "666",
      lng: "777"
    };

    const testSight = {
      name: 'sightFromModal',
      description: 'descriptionFromModal',
      ranking: 11,
      gpsPosition
    };

    this.modalController.dismiss(testSight);
  }
}
