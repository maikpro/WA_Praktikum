$( document ).ready(function() {
    console.log("ready!");

    $(".edit").click(() => {
        console.log("clicked!");
        console.log($(this));
    });
});