$( document ).ready(function() {
    console.log("script embedded!");

    const path = location.href;
    if(path.includes("?edit=")){
        console.log("öffne modal");
        $('#exampleModal').modal("show");
    }
    
});

