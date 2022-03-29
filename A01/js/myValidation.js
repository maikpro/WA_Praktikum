const currentYear = new Date().getFullYear();

const minInput = 3;
const maxInput = 50;

/**
 * rules for adding books are set through jQuery Validation Plugin
 * @returns checks fields if they are valid
 */
 function validateBookFields(){
    addRowForm.validate({
        rules: {
            // Über die input names werden die Felder identfiziert
            titel: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            autor: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            jahr: {
                required: true,
                digits: true,
                max: currentYear, // aktuelles Jahr Buch kann nicht aus der Zukunft stammen
                noSpace: true
            },
            seiten: {
                required: true,
                digits: true,
                min: 1,
                noSpace: true
            },
            verlag: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            preis: {
                required: true,
                price: true, // custom Method for price
                noSpace: true
            }
        },
        messages: {
            titel: {
                required: "Bitte gebe einen Titel an!",
                minlength: "Titel muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            autor: {
                required: "Bitte gebe einen Autor an!",
                minlength: "Autor muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            jahr: {
                required: "Bitte gebe ein Jahr an!",
                digits: "Nur Jahreszahlen sind möglich",
                max: "Bitte gebe ein gültiges Jahr an, das kleiner gleich " + currentYear + " ist."
            },
            seiten:{
                required: "Bitte gebe die Seitenanzahl an!",
                digits: "Nur Zahlen großer als 0 sind möglich",
                min: "Nur Zahlen größer als 0"
            },
            verlag: {
                required: "Bitte gebe ein Verlag an!",
                minlength: "Verlag muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            preis: {
                required: "Bitte gebe einen Preis an!"
            }
        }
    });

    return addRowForm.valid();
}

/**
 * Use regex expression for price validation
 * Exp: 100000,99
 */

jQuery.validator.addMethod(
    "price",
    function(value, element) {
        var isValidMoney = /^\d{0,6}(\,\d{0,2})?$/.test(value); // Bsp: 100000,99
        return this.optional(element) || isValidMoney;
    },
    "Bitte geben Sie einen gültigen Preis ein! (mit Komma und gleich kleiner 100.000)"
);

jQuery.validator.addMethod("noSpace", function(value, element) { 
    return value == '' || value.trim().length != 0;  
}, "Bitte keine Leerzeichen eingeben!");

/*Contact form*/
function validateContactform(kontaktForm){
    kontaktForm.validate({
        rules: {
            vorname: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            nachname: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            email: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                email: true,
                noSpace: true            
            },
            betreff: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            },
            message: {
                required: true,
                minlength: minInput,
                maxlength: maxInput,
                noSpace: true
            }

        },
        messages:{
            vorname: {
                required: "Bitte gebe einen Vornamen an!",
                minlength: "Vorname muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            nachname: {
                required: "Bitte gebe einen Nachnamen an!",
                minlength: "Nachname muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            email: {
                required: "Bitte gebe eine E-Mail an!",
                minlength: "E-Mail muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt",
                email: "Es muss eine gültige E-Mail sein!"
            },
            betreff: {
                required: "Bitte gebe einen Betreff an!",
                minlength: "Betreff muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            },
            message: {
                required: "Bitte gebe eine Nachricht ein!",
                minlength: "Die Nachricht muss mindestens " + minInput + " Zeichen enthalten",
                maxlength: "Es sind maximal " + maxInput + " Zeichen erlaubt"
            }
        }
    });

    return kontaktForm.valid();
}