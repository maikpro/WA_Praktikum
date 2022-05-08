/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Injectable } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { Directory, Filesystem } from '@capacitor/filesystem';
import { GpsPostion } from '../models/gps-position';
import { Sight } from '../models/sight';
import { GPSService } from './gps.service';

@Injectable({
  providedIn: 'root'
})
export class SightService {
  private sights: Sight[];
  constructor(private domSantizer: DomSanitizer) { 
    this.sights = [];
    this.loadFromLocalStorage();

    /*if(this.sights.length === 0){
      this.createStaticTestData();
    }*/

    
  }

  public getSights(): Sight[] {
    return this.sights;
  }

  public async saveSight(sight: Sight){
    console.log('saves sight to array!', sight);
    if(sight == null){
      console.log('sight is null!');
      return;
    }

    if(sight.fileName){
      // speichere das Bild ab
      sight = await this.loadImage(sight);
    }
    
    this.sights.push(sight);
    this.persist();
  }

  public async loadImage(sight: Sight) {
    console.log("displaySightImage: ", sight.fileName);
    
    if(!sight.fileName){
      console.log("leer");
      return;
    }
    
    const readFile = await Filesystem.readFile({
      directory: Directory.Data,
      path: `/images/${sight.fileName}`//"/images/" + sight.imageFile
    });

    console.log("=>>> ", readFile);
    //return 'data:image/jpeg;base64,' + readFile;

    //sanitize url to be safe with DomSanitizer
    sight.fileUrl = this.domSantizer.bypassSecurityTrustResourceUrl('data:image/jpeg;base64,' + readFile.data);
    return sight;
    //return this.domSantizer.bypassSecurityTrustResourceUrl('data:image/jpeg;base64,' + readFile.data);
  }

  private persist(): void {
    console.log("save to localstorage");
    localStorage.setItem('sights', JSON.stringify(this.sights));
  }

  private createStaticTestData(): void {
    const gpsPosition: GpsPostion = {
      lat: 123,
      lng: 456
    };

    const sight1: Sight = {
      name: 'sight1',
      description: 'description1',
      ranking: 5,
      gpsPosition
    };
    const sight2: Sight = {
      name: 'sight2',
      description: 'description2',
      ranking: 4,
      gpsPosition
    };
    const sight3: Sight = {
      name: 'sight3',
      description: 'description3',
      ranking: 3,
      gpsPosition
    };

    this.saveSight(sight1);
    this.saveSight(sight2);
    this.saveSight(sight3);
  }

  private loadFromLocalStorage(){
    const dataFromLocalStorage = JSON.parse(localStorage.getItem("sights"));
    if(dataFromLocalStorage){
      dataFromLocalStorage.forEach(sight => {
        this.saveSight(sight);
      });
    } else {
      this.createStaticTestData();
    }
    
  }
}
