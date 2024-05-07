$('#tagSearch').on('keyup',function(){
    let searchValue = this.value.toLowerCase();
    let mainDiv = $('.main-div');
    if(this.value != ""){
        mainDiv.addClass('d-none');
    }else{
        mainDiv.removeClass('d-none');
    }
    $('.tag').each(function() {
        let tagText = $(this).text().toLowerCase();
        let closestMainDiv = $(this).closest('.main-div');
        if (tagText.indexOf(searchValue) !== -1) {
            closestMainDiv.removeClass('d-none');
        }
    });
});