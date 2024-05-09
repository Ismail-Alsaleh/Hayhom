
$('.page-item').on('click', function(event) {
    event.preventDefault();
    var page = $(this).find('.page-link').text();
    console.log(page);
    let [searchValue,greaterThan,lessThan,pageNumber] = findFilterAttr();
    applyfilters(searchValue,greaterThan,lessThan,page);
});
// Event listener for pagination links
// $(document).on('click', '.pagination a', function(e) {
//     e.preventDefault();
//     var url = $(this).attr('href');
//     $.ajax({
//         url: url,
//         type: 'GET',
//         success: function(response) {
//             $('.gallery-sorter').html(response.html);
//         },
//         error: function(_xhr, status, error) {
//             console.error(error);
//         }
//     });
// });






$('#titleOrTagSearch').on('keyup',function(){
    let [searchValue,greaterThan,lessThan,pageNumber] = findFilterAttr();
    applyfilters(searchValue,greaterThan,lessThan,pageNumber);

    // console.log(pageNumber1);
});

$('#greaterThan, #lessThan').on('change',function(){
    let [searchValue,greaterThan,lessThan,pageNumber] = findFilterAttr();
    applyfilters(searchValue,greaterThan,lessThan,pageNumber);

});

function applyfilters(searchValue, greaterThan = '01/01/0001', lessThan = new Date().toISOString(), pageNumber=1){
    sortType = $("#sort").val();
    let sortVar = '';
    let sortWay = '';
    switch(sortType){
        case 'title_asc':
            sortVar = 'title';
            sortWay = 'asc';
            break
        case 'title_desc':
            sortVar = 'title';
            sortWay = 'desc';
            break;
        case 'date_asc':
            sortVar = 'created_at';
            sortWay = 'asc';
            break;
        case 'date_desc':
            sortVar = 'created_at';
            sortWay = 'desc';
            break;
        default:
            break;
    }
    const myData = new FormData();
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let lessThanDate = new Date(lessThan);
    lessThanDate.setHours(23, 59, 59, 999);
    lessThan = lessThanDate.toISOString();

    myData.append('_token', csrfToken);
    myData.append('sortVar',sortVar);
    myData.append('sortWay',sortWay);
    myData.append('searchValue',searchValue);
    myData.append('greaterThan', greaterThan);
    myData.append('lessThan', lessThan);
    let myUrl= $('#sortLink').attr('href');
    $.ajax({
        url: myUrl,
        processData: false,
        contentType: false,
        traditional: true,
        type: "POST",
        data: myData,
        // dataType:"JSON",
        success: function(response) {
            if (response.errors) {
                iziToast.error({
                    message: errorMsg,
                    position: 'topRight'
                });
            }else{
                updatePage(response);
            }
        },
    });
}