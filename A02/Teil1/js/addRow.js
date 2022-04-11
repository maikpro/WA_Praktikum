const table = $('#bookTable');

const addRowForm = $('#addRow');
let bookRowsLength;

$(document).ready(function(){
    bookRowsLength = $("#bookrows > tr").length;

    // Check if data is in Localstorage and load into Table
    loadFromLocalStorage();

    /**
     * Beim Klicken von Hinzufügen wird die Fuktion submit ausgeführt.
     */
    addRowForm.submit((e) => {
        console.log("submitted!");
        e.preventDefault(); // prevent window reload!
        
        // Check if form is valid
        const isFormValid = validateBookFields();
        console.log(isFormValid);

        // only add row if form is valid!
        if(isFormValid){
            const rowAsJSON = getFormdataAsJSONObject(addRowForm);
            addRow(rowAsJSON);
            saveToLocalStorage(rowAsJSON);
            
            // close modal
            $("#exampleModal").modal('hide');
            
            // clear form fields after submit
            addRowForm.trigger("reset");
        }
    });
});

/**
 * 
 * @returns returns an Array from a Form as a JSON Object
 */

function getFormdataAsJSONObject(form){
    const array = form.serializeArray();
    let obj = {}
    $.each(array, (i, field) => {
        obj[field.name] = field.value;
    })
    console.log(obj);
    return obj;
}

/**
 * Fügt ein neues Buch in die Tabelle ein.
 */
function addRow(jsonData){
    bookRowsLength++;
    $("#bookrows").append("<tr id='newrow-" + bookRowsLength +"'><th scope='row'>"+ bookRowsLength + "</th></tr>");
    $('#newrow-' + bookRowsLength).append(
        "<td>" + jsonData.titel + "</td>" +
        "<td>" + jsonData.autor + "</td>" +
        "<td>" + jsonData.jahr + "</td>" +
        "<td>" + jsonData.seiten + "</td>" +
        "<td>" + jsonData.verlag + "</td>" +
        "<td>" + jsonData.preis + "€</td>" 
    );
}