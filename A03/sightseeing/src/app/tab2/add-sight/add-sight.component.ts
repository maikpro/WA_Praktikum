/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Camera, CameraResultType, CameraSource, Photo } from '@capacitor/camera';
import { Directory, Filesystem } from '@capacitor/filesystem';
import { ModalController } from '@ionic/angular';
import { GpsPostion } from 'src/app/models/gps-position';
import { GPSService } from 'src/app/services/gps.service';

@Component({
  selector: 'app-add-sight',
  templateUrl: './add-sight.component.html',
  styleUrls: ['./add-sight.component.scss'],
})
export class AddSightComponent implements OnInit {
  public sightForm!: FormGroup;

  public photo: Photo;

  constructor(private modalController: ModalController, private formBuilder: FormBuilder, public gpsService: GPSService) { }

  public ngOnInit() {
    this.sightForm = this.formBuilder.group({
      name: ['name', Validators.required],
      description: ['description', Validators.required],
      ranking: [3, Validators.required]
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
      source: CameraSource.Camera // TODO: Hier auf Camera wechseln!
    });

    console.log(this.photo);
    console.log("PATH: ", this.photo.path);
  }

  public displayImage(): string {
    // Placeholder
    if(!this.photo){
      return "https://clap-club.de/wp-content/themes/15zine/library/images/placeholders/placeholder-360x240@2x.png";
    }

    // Vorschaubild
    return 'data:image/jpeg;base64,' + this.photo.base64String;
  }

  public async save() {

    /* get form values */
    if(this.sightForm.valid){
      // save the selected photo
      if(this.photo){
        const fileName = await this.saveImage();
        console.log(fileName);
        this.saveNewSight(fileName);
      }

      // ohne Foto speichern
      else{
        this.saveNewSight();
      }
    }
  }


  private async saveNewSight(fileName?){
    // get Current GPS from Sensor!
    await this.gpsService.setGPSPosition();
    const gpsPosition: GpsPostion = {
      lat: this.gpsService.coords.latitude,
      lng: this.gpsService.coords.longitude
    };

    // get form values
    console.log(this.sightForm.value);

    const newSight = this.sightForm.value;
    //add gpsPosition to data
    newSight.gpsPosition = gpsPosition;

    if(fileName){
      // add photo if available
      newSight.fileName = fileName;
      //newSight.fileName = this.photo.base64String;
    }

    this.modalController.dismiss(this.sightForm.value);
  }

  private async saveImage(){
    const fileName = 'sightseeing_' + new Date().getTime() + '.jpeg';
    const savedFile = await Filesystem.writeFile({
      directory: Directory.Data, // Saves in data Application folder => when app uninstalled photos deleted!
      path: `/images/${fileName}`,
      data: this.photo.base64String,
      recursive: true //erstellt alle Ordner die auf diesem Pfad liegen!
    });

    console.log("saved File: ", savedFile);
    return fileName;
  }
}
