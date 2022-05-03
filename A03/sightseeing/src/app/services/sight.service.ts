/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable no-trailing-spaces */
import { Injectable } from '@angular/core';
import { GpsPostion } from '../models/gps-position';
import { Sight } from '../models/sight';

@Injectable({
  providedIn: 'root'
})
export class SightService {
  private sights: Sight[];
  constructor() { 
    this.sights = [];
    this.createStaticTestData();
  }

  public getSights(): Sight[] {
    return this.sights;
  }

  public saveSight(sight: Sight){
    console.log('saves sight to array!', sight);
    if(sight == null){
      console.log('sight is null!');
      return;
    }
    this.sights.push(sight);
    this.persist();
  }

  private persist(): void {
    console.log("save to localstorage");
    localStorage.setItem('sights', JSON.stringify(this.sights));
  }

  private createStaticTestData(): void {
    const gpsPosition: GpsPostion = {
      lat: '123',
      lng: '456'
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
}
