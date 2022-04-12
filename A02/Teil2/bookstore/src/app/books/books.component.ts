import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.css']
})
export class BooksComponent implements OnInit {
  public rowData: any[] = [];
  public rowForm!: FormGroup;
  public index!: number;
  constructor(private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.rowData = [
      {
        id: 1,
        title: "Algorithmen in Java",
        author: "David Kopec",
        year: 2021,
        sites: 333,
        publisher: "Rheinwerk Verlag GmbH",
        price: 29.99
      },
      {
        id: 2,
        title: "PHP 8 und MySQL",
        author: "Christian Wenz, Tobias Hauser",
        year: 2021,
        sites: 1075,
        publisher: "Rheinwerk Verlag GmbH",
        price: 49.99
      },
      {
        id: 3,
        title: "C# 8 mit Visual Studio 2019",
        author: "Andreas Kühnel",
        year: 2019,
        sites: 1478,
        publisher: "Rheinwerk Verlag GmbH",
        price: 49.99
      },
      {
        id: 4,
        title: "HTML & CSS für Dummies",
        author: "Florence Maurice",
        year: 2019,
        sites: 428,
        publisher: "Wiley-VCH",
        price: 24.99
      },
      {
        id: 5,
        title: "Das Curry-Buch - Funktional programmieren lernen mit JavaScript",
        author: "Jens Ohlig, Stefanie Schirmer, Hannes Mehnert",
        year: 2013,
        sites: 208,
        publisher: "O'Reilly Verlag GmbH & Co. KG",
        price: 29.99
      },
    ];

    this.index = this.rowData.length;

    this.loadFromLocalStorage();

    this.rowForm = this.formBuilder.group({
      title: ['', Validators.required],
      author: ['', Validators.required],
      year: ['', Validators.required],
      sites: ['', Validators.required],
      publisher: ['', Validators.required],
      price: ['', Validators.required]
    });
  }

  public addRow(): void {
    console.log("addRow!");
    this.rowForm.reset();
    console.log(this.rowForm.value);
    if(this.rowForm.value != null){
      const rowDataObject = this.rowForm.value;
      this.index++;
      rowDataObject.id = this.index;
      this.rowData.push(rowDataObject);
      this.saveToLocalStorage(rowDataObject);
      this.rowForm.reset();
    }
  }

  // TODO: beim Öffnen nach Editklick werden editdaten beim hinzufügen button angezeigt...
  public editRow(index: number): void {
    console.log("editRow with index: ", index);
    const row = this.rowData[index];
    this.rowForm = this.formBuilder.group({
      title: [row.title, Validators.required],
      author: [row.author, Validators.required],
      year: [row.year, Validators.required],
      sites: [row.sites, Validators.required],
      publisher: [row.publisher, Validators.required],
      price: [row.price, Validators.required]
    });
  }

  public deleteRow(index: number): void {
    console.log("deleteRow with index: ", index);
  }

  /**
 * Erweiterung von Meilenstein 1 mit Localstorage
 * * JSON.stringify converts data into an JSON String
 */

  private saveToLocalStorage(rowAsJSON: any): void {
    // wenn bereits ein Buch im Localstorage enthalten ist dann überschreibe es nicht!
    const rawDataFromLocalStorage = localStorage.getItem("books");
    if(rawDataFromLocalStorage != null){
      const dataFromLocalStorage = JSON.parse(rawDataFromLocalStorage);
      if(dataFromLocalStorage != null){
          // wenn bereits daten im Localstorage drin sind...
          dataFromLocalStorage.push(rowAsJSON);
          localStorage.setItem("books", JSON.stringify(dataFromLocalStorage));
      } 
    } 
    else {
      const newLocalstorageArray = [];
      newLocalstorageArray.push(rowAsJSON);
      // wenn noch keine Daten im localstorage sind...
      localStorage.setItem("books", JSON.stringify(newLocalstorageArray)); // Überschreibt das Feld books im Localstorage
    }
  }

/**
* Wenn Daten im LocalStorage enthalten sind, dann lade sie direkt in die Tabelle
* * JSON.parse converts JSON String into an JSON Object
*/
  private loadFromLocalStorage(): void{
    const rawDataFromLocalStorage = localStorage.getItem("books");
    if(rawDataFromLocalStorage != null){
      const dataFromLocalStorage = JSON.parse(rawDataFromLocalStorage);

      if(dataFromLocalStorage != null){
        console.log("Localstorage data: ", dataFromLocalStorage);
        /*$.each(dataFromLocalStorage, (i, jsonData) => {
            addRow(jsonData);
        });*/
        dataFromLocalStorage.forEach((element: any) => {
          this.index++;
          this.rowData.push(element);
        });
      }
    }
  }

  public clearLocalStorage(): void {
    console.log("clear Storage!!");
    localStorage.removeItem("books"); // Localstorage Item entfernen / Leeren
    window.location.reload(); // Seite neuladen!
  }
}
