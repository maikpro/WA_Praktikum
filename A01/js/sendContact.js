const kontaktForm = $("#kontaktForm");

$(document).ready(function(){
   
    kontaktForm.submit((e) => {
        e.preventDefault();
        const isValid = validateContactform(kontaktForm);

        if(isValid){
            sendContact();
            // clear form fields after submit
            kontaktForm.trigger("reset");
        }
    });
    
});

function sendContact(){
    // show notification
    $("#notification").toggle();
    $("#notification").delay(5000).fadeToggle();
}