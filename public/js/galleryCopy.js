$('#sort').on('change',function(){
    divArr = $(".main-div")
    sortType = this.value;
    console.log(sortType);
    switch(sortType){
        case 'title_asc':
            divArr.sort(function(a, b) {
                return $(a).find(".title").text().toLowerCase() > $(b).find(".title").text().toLowerCase() ? 1: -1;
            })
            $(".gallery-container").append(divArr);
            break
        case 'title_desc':
            divArr.sort(function(a, b) {
                return $(a).find(".title").text().toLowerCase() < $(b).find(".title").text().toLowerCase() ? 1: -1;
            })
            $(".gallery-container").append(divArr);
            break;
        case 'date_asc':
            divArr.sort(function(a, b) {
                return $(a).find(".date").text().toLowerCase() > $(b).find(".date").text().toLowerCase() ? 1: -1;
            })
            $(".gallery-container").append(divArr);
            break;
        case 'date_desc':
            divArr.sort(function(a, b) {
                return $(a).find(".date").text().toLowerCase() < $(b).find(".date").text().toLowerCase() ? 1: -1;
            })
            $(".gallery-container").append(divArr);
            break;
        default:
            break;
    }
});




$('#titleOrTagSearch').on('keyup',function(){
    let searchValue = this.value.toLowerCase();
    let greaterThan = $('#greaterThan').val();
    if(greaterThan ==''){
        greaterThan = undefined;
    }
    let lessThan = $('#lessThan').val();
    if(lessThan == ''){
        lessThan = undefined;
    }
    applyfilters(searchValue,greaterThan,lessThan);
});

$('#greaterThan, #lessThan').on('change',function(){
    let greaterThan = $('#greaterThan').val();
    if(greaterThan ==''){
        greaterThan = undefined;
    }
    let lessThan = $('#lessThan').val();
    if(lessThan == ''){
        lessThan = undefined;
    }
    let searchValue = $('#titleOrTagSearch').val().toLowerCase();
    applyfilters(searchValue,greaterThan,lessThan);

});

function applyfilters(searchValue, greaterThan = '01/01/0001', lessThan = new Date().toISOString()){
    $('.main-div').addClass('d-none'); // Hide all initially
    
    $('.main-div').each(function() {
        let titleText = $(this).find('.title').text().toLowerCase();
        let tagText = $(this).find('.tag').text().toLowerCase();
        let dateVal = $(this).find('.date').text();

        let titleTagFilterPass = titleText.indexOf(searchValue) !== -1 || tagText.indexOf(searchValue) !== -1;
        let lessThanDate = new Date(lessThan);
        lessThanDate.setHours(23, 59, 59, 999);
        let dateFilterPass = new Date(greaterThan) <= new Date(dateVal) && new Date(dateVal) <= lessThanDate;
        if (titleTagFilterPass && dateFilterPass) {
            $(this).removeClass('d-none');
        }
    });
}