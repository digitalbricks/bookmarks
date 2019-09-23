
$('form.bookmark-form-actions').submit(function(event){

    // Stop the browser from submitting the form.
    event.preventDefault();

    // getting current form
    var currentForm = $(this);     

    // Serialize the form data.
    var formData = $(currentForm).serialize();

    // get type of action
    var action = $(currentForm).find("input[name=action]").val();

    // get item id
    var id = $(currentForm).find("input[name=id]").val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(currentForm).data('ajax-processor'),
        data: formData
    }).done(function(response) {
        console.log($.cookie("bookmarks"),response);
        if(action=="add"){
            item_added();
        }
        if(action=="remove"){
            item_removed(id);
        }
        

    }).fail(function(data){
        notie.alert({
            type: "error",
            text: "Fehlgeschlagen"
        })
        
    });
});



function item_added(){
    notie.alert({
        type: "success",
        text: "Erfolgreich hinzugefügt"
    })
}

function item_removed(id){
    notie.alert({
        type: "success",
        text: "Erfolgreich entfernt ("+id+")"
    });
    var selector = "#item-"+id;
    $(selector).fadeOut();
}