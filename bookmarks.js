
$('form.bookmark-form-actions').submit(function(event){

    // Stop the browser from submitting the form.
    event.preventDefault();

    // getting current form
    var currentForm = $(this);     

    // Serialize the form data.
    var formData = $(currentForm).serialize();


    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(currentForm).data('ajax-processor'),
        data: formData
    }).done(function(response) {
        console.log($.cookie("bookmarks"));
        notie.alert({
            type: "success",
            text: "Erfolgreich"
        })

    }).fail(function(data){
        notie.alert({
            type: "error",
            text: "Fehlgeschlagen"
        })
        
    });
});