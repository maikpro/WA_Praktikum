/* eslint-disable no-trailing-spaces */
/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable @typescript-eslint/member-ordering */
import { Injectable } from '@angular/core';
import { Geolocation } from '@awesome-cordova-plugins/geolocation/ngx';

@Injectable({
  providedIn: 'root'
})
export class GPSService {
  public coords: GeolocationCoordinates;

  constructor(private geolocation: Geolocation) { }
  public async setGPSPosition() {
    await this.geolocation.getCurrentPosition().then((response) => {
      console.log(response);
      const geolocationPosition: GeolocationPosition  = response;
      this.coords = geolocationPosition.coords;
      console.log("coords:", this.coords);
      
     }).catch((error) => {
       console.log('Error getting location', error);
     });
  }


}
