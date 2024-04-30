$('#phone').on('keyup',function () {
    document.querySelector('.phoneErr').textContent='';
    document.querySelector('.phoneCountry').textContent='';
});
$.validator.addMethod("regex", function(value, element, param) {
    if (this.optional(element) || value.match(typeof param === "string" ? new RegExp(param) : param)) {
        return true; // Validation passed
    } else {
        // Set custom error message
        $.validator.messages.regex = "Enter Valid format. EX:+996547068000";
        return false; // Validation failed
    }
}); 
$("#phoneForm").on('submit',function(event){
    event.preventDefault();
});
$("#phoneForm").validate({
    rules: {
        phone: {
            required:true,
            minlength: 9,
            maxlength: 15,
            regex: /^\+\d+$/,
        },
    
    },
    messages: {
        phone:{
            required: "This field is required!",
            // number: "Letters Are not allowed",
            minlength: "It must be More than 9 digits",
            maxlength: "This Number is too long",
        },
    },
    submitHandler: function(){
        document.querySelector('.phoneErr').textContent= '';
        let myUrl= $('#phoneForm').attr('action');
        var phoneForm = document.getElementById('phoneForm');
        var myData = new FormData(phoneForm);
        $.ajax({
            url: myUrl,
            processData: false,
            contentType: false,
            type: "POST",
            data: myData,
            dataType:"JSON",
            success: function(response) {
                if (response.errors) {
                    var errorMsg = '';
                    $.each(response.errors, function(field, errors) {
                        $.each(errors, function(index, error) {
                            document.querySelector('.phoneErr').textContent= error;
                            errorMsg += error + '<br>';
                        });

                    });

                    // iziToast.error({
                    //     message: errorMsg,
                    //     position: 'topRight'
                    // });
                } else {
                    document.querySelector('.phoneCountry').textContent= response.country;
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'
                    });
                    console.log(response.country)
                }  
            },
            error: function(err) {
                console.log(err.responseJSON);
                iziToast.error({
                    message: 'An error occurred: ' + err,
                    position: 'topRight'
                });
            }
        })
    }

})
