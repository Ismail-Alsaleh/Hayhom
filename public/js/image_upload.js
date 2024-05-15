FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
const inputElement = document.querySelector('input[type="file"]');
const pond = FilePond.create(inputElement, {
    allowFileEncode: false,
    // acceptedFileTypes: ['image/png','image/jpeg'],
    allowMultiple: false,
    required:true,
    maxFileSize: '2MB'
});

var validationMessages = {
    en: {
        required: "This field is required!",
        minlength: "It must be More than 7 digits",
        maxlength: "This Number is too long",
        extension: "Only jpg and png are accepted",
    },
    ar: {
        required: "هذا الحقل مطلوب.",
        minlength: "هذا الرقم قصير جدا",
        maxlength: "هذا الرقم طويل جدا",
        extension: "هي الصيغ المقبولة فقط jpg,png",
    },
};
$("#imageForm").on('submit',function(event){
    event.preventDefault();
});
$(function(){
    $("#imageForm").validate({
        rules: {
            image: {
                required:true,
                extension:'jpg|png',
            },
            title: {
                required:true,
            },
        },
        messages: validationMessages[lang],
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function(){
            document.querySelector('.imageErr').textContent= '';
            let myUrl= $('#imageForm').attr('action');
            const myData = new FormData();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            myData.append('_token', csrfToken);
            const files = pond.getFiles();     
            const filesArray = Array.from(files);
            filesArray.forEach(function(file) {
                myData.append('image', file.file);
            });
            myData.append('tags', $('#tags').tagsinput('items'));
            myData.append('title', document.getElementById('title').value);

            console.log('FormData:', myData);
            $.ajax({
                url: myUrl,
                processData: false,
                contentType: false,
                traditional: true,
                type: "POST",
                data: myData,
                dataType:"JSON",
                success: function(response) {
                    console.log(response.errors);
                    if (response.errors) {
                        var errorMsg = '';

                        $.each(response.errors, function(field, errors) {
                            $.each(errors, function(index, error) {
                                if(error.includes('tag')){
                                    document.querySelector('.tagErr').textContent= error;
                                }
                                else{
                                    document.querySelector('.imageErr').textContent= error;
                                }
                                errorMsg += error + '<br>';
                            });
    
                        });
    
                        iziToast.error({
                            message: errorMsg,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.success({
                            message: response.success,
                            position: 'topRight'
                        });
                        html = `<div id="imagePart" class="w-50 text-center shadow align-items-center">
                                    <h1 class="text-success">Image Added Successfully</h1>
                                </div>`;
                        $('.container-floid').html(html);
                    }  
                },
                // error: function(err) {
                //     console.log(err.responseJSON);
                //     iziToast.error({
                //         message: 'An error occurred: ' + err,
                //         position: 'topRight'
                //     });
                // }
            })
        }
    
    })
});
