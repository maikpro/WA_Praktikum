import { GpsPostion } from './gps-position';

export interface Sight {
    name: string;
    description: string;
    ranking: number;
    gpsPosition: GpsPostion;
}
