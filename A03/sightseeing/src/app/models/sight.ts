import { SafeResourceUrl } from '@angular/platform-browser';
import { GpsPostion } from './gps-position';

export interface Sight {
    fileUrl?: SafeResourceUrl;
    fileName?: string;
    name: string;
    description: string;
    ranking: number;
    gpsPosition: GpsPostion;
}
