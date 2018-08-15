
Query(document).ready(function(){
//click on save changes button then Save via ajax
    $("#saveChanges").click(function() {
        $.ajax({
            type: "POST",
            url: "saveData.action",
            data: "{}",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function() {

                msgBox("Saved Changes");
            },
            error: function(){
                msgbox("Falied to save Changes");
            }
        });
        return false;
    });
});
