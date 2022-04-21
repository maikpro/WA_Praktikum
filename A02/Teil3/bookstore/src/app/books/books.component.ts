import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { BooksService } from './books.service';

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
  public rowForm!: FormGroup;
  public lastId!: number;
  
  public action: typeof Action = Action;
  public currentAction!: Action;
  public selectedRow: any;

  public currentYear: number = new Date().getFullYear();

  // Bsp: 10000.99
  private currencyCheck = /^\d{0,5}(\.\d{0,2})?$/;

  constructor(private formBuilder: FormBuilder, public booksService: BooksService) { }

  public ngOnInit(): void {
    this.loadFromLocalStorage();
    //this.lastId = this.rowData[this.rowData.length-1].id;
    this.lastId = this.booksService.getLastId();
    console.log(this.lastId);

    this.rowForm = this.formBuilder.group({
      title: ['', Validators.required],
      author: ['', Validators.required],
      year: ['', Validators.required],
      sites: ['', Validators.required],
      publisher: ['', Validators.required],
      price: ['', [Validators.required, Validators.pattern(this.currencyCheck)]]
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
      //this.rowData.push(rowDataObject);
      this.booksService.add(rowDataObject);
      this.updateLocalStorage();
      this.rowForm.reset();
    }
  }

  public openEditModal(index: number): void {
    console.log("openEditModal with index: ", index);
    //this.selectedRow = this.rowData[index];
    this.selectedRow = this.booksService.getRowData()[index];
    this.rowForm = this.formBuilder.group({
      title: [this.selectedRow.title, Validators.required],
      author: [this.selectedRow.author, Validators.required],
      year: [this.selectedRow.year, Validators.required],
      sites: [this.selectedRow.sites, Validators.required],
      publisher: [this.selectedRow.publisher, Validators.required],
      price: [this.selectedRow.price, Validators.pattern(this.currencyCheck)]
    });
    this.openModal(Action.EDIT);
  }

  public editRow(): void {
    // Ändere das JSON Object im Array
    const editedRow = this.rowForm.value;
    editedRow.id = this.selectedRow.id; // weise ID zu, da es in der Form keine ID gibt
    // Durchläuft alle rows im Array und sucht nach der geänderten Row mit der selected ID und ersetzt diese
    //this.rowData = this.rowData.map(row => row.id !== editedRow.id ? row : editedRow);
    this.booksService.update(editedRow);
    // Update Localstorage!
    this.updateLocalStorage();
  }

  public openDeleteModal(index: number): void {
    console.log("openDeleteModal with index: ", index);
    //this.selectedRow = this.rowData[index];
    this.selectedRow = this.booksService.getRowData()[index];
  }

  public deleteRow(): void {
    console.log("delete row with id: ", this.selectedRow);
    //this.rowData = this.rowData.filter(row => row.id !== this.selectedRow.id);
    this.booksService.delete(this.selectedRow);
    this.updateLocalStorage();
  }

  /**
 * Erweiterung von Meilenstein 1 mit Localstorage
 * * JSON.stringify converts data into an JSON String
 */

  private updateLocalStorage(): void {
    // wenn noch keine Daten im localstorage sind...
    //localStorage.setItem("books", JSON.stringify(this.rowData)); // Überschreibt das Feld books im Localstorage
    localStorage.setItem("books", JSON.stringify(this.booksService.getRowData())); // Überschreibt das Feld books im Localstorage
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
        this.booksService.loadStaticData();
        this.updateLocalStorage();
      }

      else if(dataFromLocalStorage != null){
        console.log("Localstorage data: ", dataFromLocalStorage);
        dataFromLocalStorage.forEach((element: any) => {
          //this.rowData.push(element);
          this.booksService.add(element);
        });
      }

     
    }
    else{
      // Wenn Localstorage leer ist:
      // Lade static data
      //this.loadStaticData();
      this.booksService.loadStaticData();
      this.updateLocalStorage();
    }
  }

  

  public clearLocalStorage(): void {
    console.log("clear Storage!!");
    localStorage.removeItem("books"); // Localstorage Item entfernen / Leeren
    window.location.reload(); // Seite neuladen!
  }
}
