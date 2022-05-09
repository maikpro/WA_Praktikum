/* eslint-disable @typescript-eslint/member-ordering */
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
      return sight;
    }

    // Bei statischen Sehenswürdigkeiten ist fileUrl bereits gesetzt!
    if(sight.fileUrl){
      return sight;
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

  public clearLocalStorage(): void {
    console.log("Clear Localstorage!");
    localStorage.clear();
    this.loadFromLocalStorage();
  }

  private createStaticTestData(): void {
    const gpsPosition: GpsPostion = {
      lat: 52.2751897,
      lng: 8.0393919
    };

    const sight1: Sight = {
      fileName: 'static_marktplatz',
      fileUrl: 'https://www.osnabrueck.de/fileadmin/_processed_/1/7/csm_Marktplatz__c__Christoph_Mischke_2df2100a03.jpg',
      name: 'Osnabrücker Marktplatz',
      description: 'Der Osnabrücker Marktplatz',
      ranking: 5,
      gpsPosition: {
        lat: 52.27528,
        lng: 8.05079
      }
    };
    const sight2: Sight = {
      fileName: 'static_schloss',
      fileUrl: 'https://www.osnabrueck.de/fileadmin/_processed_/c/9/csm_Schloss__c__Christoph_Mischke_50b0ec5565.jpg',
      name: 'Osnabrücker Schloss',
      description: 'Das Osnabrücker Schloss',
      ranking: 4,
      gpsPosition: {
        lat: 52.2713446,
        lng: 8.0420381
      }
    };
    const sight3: Sight = {
      fileName: 'static_hegerTor',
      fileUrl: 'https://upload.wikimedia.org/wikipedia/commons/0/0f/OSHegerTor.JPG',
      name: 'Waterloo-Tor',
      description: 'Das Heger Tor in Osnabrück',
      ranking: 3,
      gpsPosition: {
        lat: 52.2762558,
        lng: 8.0388252
      }
    };

    this.saveSight(sight1);
    this.saveSight(sight2);
    this.saveSight(sight3);
  }

  private loadFromLocalStorage(){
    this.sights = [];
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
