/* eslint-disable @typescript-eslint/quotes */
import { Component, Input, OnInit } from '@angular/core';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser';
import { ModalController } from '@ionic/angular';
import { Sight } from 'src/app/models/sight';

@Component({
  selector: 'app-preview-sight',
  templateUrl: './preview-sight.component.html',
  styleUrls: ['./preview-sight.component.scss'],
})
export class PreviewSightComponent implements OnInit {
  @Input() public sight: Sight;

  public previewImage: SafeResourceUrl;

  constructor(private modalController: ModalController, private domSantizer: DomSanitizer) { }

  ngOnInit() {
    console.log("sight data:", this.sight);
  }

  public showImage(): SafeResourceUrl {
    const url: SafeResourceUrl = this.domSantizer.bypassSecurityTrustResourceUrl(this.sight.fileName.toString());
    return url;
  }

  public async closeModal(){
    await this.modalController.dismiss(); // Schließt das Modal
  }
}
