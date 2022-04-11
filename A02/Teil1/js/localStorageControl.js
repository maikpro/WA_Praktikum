$(document).ready(function(){
    $("#clearStorageBtn").click(clearLocalStorage);
});

/**
 * Erweiterung von Meilenstein 1 mit Localstorage
 * * JSON.stringify converts data into an JSON String
 */

 function saveToLocalStorage(rowAsJSON){
    // wenn bereits ein Buch im Localstorage enthalten ist dann überschreibe es nicht!
    const dataFromLocalStorage = JSON.parse(localStorage.getItem("books"));
    if(dataFromLocalStorage != null){
        // wenn bereits daten im Localstorage drin sind...
        dataFromLocalStorage.push(rowAsJSON);
        localStorage.setItem("books", JSON.stringify(dataFromLocalStorage));
    } else {
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
function loadFromLocalStorage(){
    const dataFromLocalStorage = JSON.parse(localStorage.getItem("books"));

    if(dataFromLocalStorage != null){
        console.log("Localstorage data: ", dataFromLocalStorage);
        $.each(dataFromLocalStorage, (i, jsonData) => {
            addRow(jsonData);
        });
    }
}

function clearLocalStorage(){
    console.log("clear Storage!!");
    localStorage.removeItem("books"); // Localstorage Item entfernen / Leeren
    window.location.reload(); // Seite neuladen!
}