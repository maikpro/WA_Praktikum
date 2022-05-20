$( document ).ready(function() {
    console.log("script embedded!");

    const path = location.href;
    if(path.includes("?edit=")){
        console.log("öffne edit modal");
        $('#exampleModal').modal("show");
    }

    else if(path.includes("?delete=")){
        console.log("öffne delete modal");
        $('#deleteModal').modal("show");
    }
});

