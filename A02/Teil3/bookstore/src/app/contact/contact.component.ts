import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {
  public contactForm!: FormGroup;
  public sendData!: any;

  constructor(private formBuilder: FormBuilder) { }

  public ngOnInit(): void {
    this.contactForm = this.formBuilder.group({
      firstname: ['', Validators.required],
      lastname: ['', Validators.required],
      email: ['', [Validators.email, Validators.required]],
      subject: ['', Validators.required],
      message: ['', Validators.required]
    });
  }

  public sendMessage(): void {
    console.log("send Message!");
    this.sendData = this.contactForm.value;
    console.log(this.sendData);

    // After 5 Sec hide
    setTimeout(() => this.sendData = null, 5000);
  }

}
