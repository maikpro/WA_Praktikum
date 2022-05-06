import { SafeResourceUrl } from '@angular/platform-browser';
import { GpsPostion } from './gps-position';

export interface Sight {
    fileName?: SafeResourceUrl;
    name: string;
    description: string;
    ranking: number;
    gpsPosition: GpsPostion;
}
