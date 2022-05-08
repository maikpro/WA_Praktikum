/* eslint-disable no-trailing-spaces */
/* eslint-disable @typescript-eslint/quotes */
/* eslint-disable @typescript-eslint/member-ordering */
import { Injectable } from '@angular/core';
import { Geolocation } from '@capacitor/geolocation';

@Injectable({
  providedIn: 'root'
})
export class GPSService {
  public coords: GeolocationCoordinates;

  constructor() { }
  public async setGPSPosition() {
    /*await this.geolocation.getCurrentPosition().then((response) => {
      console.log(response);
      const geolocationPosition: GeolocationPosition  = response;
      this.coords = geolocationPosition.coords;
      console.log("coords:", this.coords);
      
     }).catch((error) => {
       console.log('Error getting location', error);
     });*/

     this.coords = await (await Geolocation.getCurrentPosition()).coords;
     console.log(this.coords);
  }

  


}
