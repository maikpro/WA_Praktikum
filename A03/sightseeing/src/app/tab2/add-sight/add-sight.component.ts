/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Camera, CameraResultType, CameraSource, Photo } from '@capacitor/camera';
import { Directory, Filesystem } from '@capacitor/filesystem';
import { ModalController } from '@ionic/angular';
import { GpsPostion } from 'src/app/models/gps-position';

@Component({
  selector: 'app-add-sight',
  templateUrl: './add-sight.component.html',
  styleUrls: ['./add-sight.component.scss'],
})
export class AddSightComponent implements OnInit {
  public sightForm!: FormGroup;

  public photo: Photo;

  constructor(private modalController: ModalController, private formBuilder: FormBuilder) { }

  public ngOnInit() {
    this.sightForm = this.formBuilder.group({
      name: ['', Validators.required],
    });
  }

  public async closeModal(){
    await this.modalController.dismiss(); // Schließt das Modal
  }

  public async selectImage() {
    this.photo = await Camera.getPhoto({
      quality: 100,
      allowEditing: false,
      resultType: CameraResultType.Base64,
      source: CameraSource.Photos // TODO: Hier auf Camera wechseln!
    });

    console.log(this.photo);
    console.log("PATH: ", this.photo.path);
  }

  public displayImage(): string {
    if(this.photo){
      return 'data:image/jpeg;base64,' + this.photo.base64String;
    }
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

    if(this.photo){
      this.saveImage();
    }

    this.modalController.dismiss(testSight);

  }

  private async saveImage(){
    const fileName = 'sightseeing_' + new Date().getTime() + '.jpeg';
    const savedFile = await Filesystem.writeFile({
      directory: Directory.Data, // Saves in data Application folder => when app uninstalled photos deleted!
      path: `images/${fileName}`,
      data: this.photo.base64String
    });

    console.log("saved File: ", savedFile);
  }
}
