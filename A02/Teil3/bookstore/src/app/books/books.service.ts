import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BooksService {
  private rowData: any[] = [];
  
  constructor() { }

  public getLastId(): number {
    return this.rowData[this.rowData.length-1].id
  }

  public getRowData(): any[] {
    return this.rowData;
  }

  public add(data: any): void {
    this.rowData.push(data);
  }

  public update(editedRow: any): void {
    // Durchläuft das Array und ändert nur die Row mit den abgeänderten Daten
    // neues Array mit Änderung wird zurückgegeben
    this.rowData = this.rowData.map(row => row.id !== editedRow.id ? row : editedRow);
  }

  public delete(selectedRow: any): void {
    // Durchläuft das Array und löscht nur die Row mit der gewählten ID
    // neues Array ohne die gelöschte Row wird zurückgegeben
    this.rowData = this.rowData.filter(row => row.id !== selectedRow.id);
  }

  public loadStaticData(): void {
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
}
