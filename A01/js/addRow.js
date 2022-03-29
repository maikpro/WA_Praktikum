console.log("script embedded");

const table = $('#bookTable');

const addRowForm = $('#addRow');
let bookRowsLength;

$(document).ready(function(){
    bookRowsLength = $("#bookrows > tr").length;

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
            addRow();
            
            // close modal
            $("#exampleModal").modal('hide');
            
            // clear form fields after submit
            addRowForm.trigger("reset");
        }
    });
});

/**
 * Fügt ein neues Buch in die Tabelle ein.
 */
function addRow(){
    const addRowFormArray = addRowForm.serializeArray();
    bookRowsLength++;
    $("#bookrows").append("<tr id='newrow-" + bookRowsLength +"'><th scope='row'>"+ bookRowsLength + "</th></tr>");
    $.each(addRowFormArray, (i, field) => {
        console.log(field)
        $('#newrow-' + bookRowsLength).append(
            // Füge € hinter Preis ein falls Preisfeld
            field.name !== "preis" ? "<td>" + field.value + "</td>" : "<td>" + field.value + "€</td>"
        );
    });
}

