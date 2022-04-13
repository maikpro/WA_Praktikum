import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

export enum Action {
  ADD = "ADD",
  EDIT = "EDIT",
  DELETE = "DELETE"
}

@Component({
  selector: 'app-books',
  templateUrl: './books.component.html',
  styleUrls: ['./books.component.css']
})
export class BooksComponent implements OnInit {
  public rowData: any[] = [];
  public rowForm!: FormGroup;
  public lastId!: number;
  
  public action: typeof Action = Action;
  public currentAction!: Action;
  public selectedRow: any;

  public currentYear: number = new Date().getFullYear();

  constructor(private formBuilder: FormBuilder) { }

  public ngOnInit(): void {
    this.loadFromLocalStorage();
    this.lastId = this.rowData[this.rowData.length-1].id;
    console.log(this.lastId);

    this.rowForm = this.formBuilder.group({
      title: ['', Validators.required],
      author: ['', Validators.required],
      year: ['', Validators.required],
      sites: ['', Validators.required],
      publisher: ['', Validators.required],
      price: ['', Validators.required]
    });
  }

  public openModal(action: Action): void {
    console.log("OpenModal!");
    // Hinzufügen
    if(action === Action.ADD){
      this.currentAction = Action.ADD;
      this.rowForm.reset();
      return;
    }

    // Ändern
    else if(action === Action.EDIT){
      this.currentAction = Action.EDIT
    }
   
  }

  public addRow(): void {
    console.log("addRow!");
    console.log(this.rowForm.value);
    if(this.rowForm.value != null){
      const rowDataObject = this.rowForm.value;
      this.lastId++;
      rowDataObject.id = this.lastId;
      this.rowData.push(rowDataObject);
      this.updateLocalStorage();
      this.rowForm.reset();
    }
  }

  public openEditModal(index: number): void {
    console.log("openEditModal with index: ", index);
    this.selectedRow = this.rowData[index];
    this.rowForm = this.formBuilder.group({
      title: [this.selectedRow.title, Validators.required],
      author: [this.selectedRow.author, Validators.required],
      year: [this.selectedRow.year, Validators.required],
      sites: [this.selectedRow.sites, Validators.required],
      publisher: [this.selectedRow.publisher, Validators.required],
      price: [this.selectedRow.price, Validators.required]
    });
    this.openModal(Action.EDIT);
  }

  public editRow(): void {
    // Ändere das JSON Object im Array
    const editedRow = this.rowForm.value;
    editedRow.id = this.selectedRow.id; // weise ID zu, da es in der Form keine ID gibt
    // Durchläuft alle rows im Array und sucht nach der geänderten Row mit der selected ID und ersetzt diese
    this.rowData = this.rowData.map(row => row.id !== editedRow.id ? row : editedRow);

    // Update Localstorage!
    this.updateLocalStorage();
  }

  public openDeleteModal(index: number): void {
    console.log("openDeleteModal with index: ", index);
    this.selectedRow = this.rowData[index];
  }

  public deleteRow(): void {
    console.log("delete row with id: ", this.selectedRow);
    this.rowData = this.rowData.filter(row => row.id !== this.selectedRow.id);
    this.updateLocalStorage();
  }

  /**
 * Erweiterung von Meilenstein 1 mit Localstorage
 * * JSON.stringify converts data into an JSON String
 */

  private updateLocalStorage(): void {
    // wenn noch keine Daten im localstorage sind...
    localStorage.setItem("books", JSON.stringify(this.rowData)); // Überschreibt das Feld books im Localstorage
  }

/**
* Wenn Daten im LocalStorage enthalten sind, dann lade sie direkt in die Tabelle
* * JSON.parse converts JSON String into an JSON Object
*/
  private loadFromLocalStorage(): void{
    const rawDataFromLocalStorage = localStorage.getItem("books");
    if(rawDataFromLocalStorage != null){
      const dataFromLocalStorage = JSON.parse(rawDataFromLocalStorage);

      // wenn das Array im Localstorage leer ist
      if(dataFromLocalStorage.length === 0){
        // Wenn Localstorage leer ist:
        // Lade static data
        this.loadStaticData();
        this.updateLocalStorage();
      }

      else if(dataFromLocalStorage != null){
        console.log("Localstorage data: ", dataFromLocalStorage);
        dataFromLocalStorage.forEach((element: any) => {
          //this.index++;
          this.rowData.push(element);
        });
      }

     
    }
    else{
      // Wenn Localstorage leer ist:
      // Lade static data
      this.loadStaticData();
      this.updateLocalStorage();
    }
  }

  private loadStaticData(): void {
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
  }

  public clearLocalStorage(): void {
    console.log("clear Storage!!");
    localStorage.removeItem("books"); // Localstorage Item entfernen / Leeren
    window.location.reload(); // Seite neuladen!
  }
}
