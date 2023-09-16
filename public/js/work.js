
$(document).ready(function(){

    setTimeout(function()
    {
        $("div.alert").fadeOut('slow');
    },2200);
    
    $('#usersTable').DataTable( {
        responsive: true
    });
    
    
});
