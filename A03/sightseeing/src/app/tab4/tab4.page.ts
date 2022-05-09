/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable object-shorthand */
/* eslint-disable no-trailing-spaces */
import { AfterViewInit, Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { GoogleMap } from '@capacitor/google-maps';
import { Sight } from '../models/sight';
import { SightService } from '../services/sight.service';

@Component({
  selector: 'app-tab4',
  templateUrl: 'tab4.page.html',
  styleUrls: ['tab4.page.scss']
})
export class Tab4Page {
  @ViewChild('map')
  mapRef: ElementRef<HTMLElement>;
  newMap: GoogleMap;

  constructor(public sightService: SightService) {}

  ionViewDidEnter(){
    this.createMap();
  }

  async createMap() {
    this.newMap = await GoogleMap.create({
      id: 'map',
      element: this.mapRef.nativeElement,
      apiKey: 'AIzaSyDGUwDlE0mSkU6FnAwGtGmY0SuCxq6ib44',
      config: {
        center: {
          lat: 52.27528,
          lng: 8.05079,
        },
        zoom: 14,
      },
    });

    this.sightService.getSights().forEach(sight => this.addMarker(sight));
  }

  public async addMarker(sight: Sight){
    await this.newMap.addMarker({
      coordinate: {
        lat: sight.gpsPosition.lat,
        lng: sight.gpsPosition.lng,
      }, draggable: false
    });
  }
  

  
}
