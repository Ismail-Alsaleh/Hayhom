var validationMessages = {
    en: {
        required: "This field is required!",
        minlength: "It must be More than 9 digits",
        maxlength: "This Number is too long",
    },
    ar: {
        required: "هذا الحقل مطلوب.",
        minlength: "هذا الرقم قصير جدا",
        maxlength: "يجب الا يتجاوز الجوال اكثر من 15 رقما"
    },
};
var lang = document.querySelector("#lang").textContent;



$('#phone').on('keyup',function () {
    document.querySelector('.phoneErr').textContent='';
    document.querySelector('.phoneCountry').textContent='';
});
$.validator.addMethod("regex", function(value, element, param) {
    if (this.optional(element) || value.match(typeof param === "string" ? new RegExp(param) : param)) {
        return true; // Validation passed
    } else {
        // Set custom error message
        if(lang=="en")
            $.validator.messages.regex = "Enter Valid format. EX:+996547068000";
        else
            $.validator.messages.regex = "ادخل صيغة صحيحة, مثال:966547068000+";
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
        phone:validationMessages[lang],
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
