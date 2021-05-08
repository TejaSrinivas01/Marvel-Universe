function refreshContent(){
    var searchString = document.getElementsByClassName('search')[0].value;
    var selecter = document.getElementById('sort-by');
    var sortBy = selecter.options[selecter.selectedIndex].value;
    $.ajax({
        type: "GET",
        url: "php_bin/characterCardContent.php",
        data: "search="+searchString+"&sort="+sortBy,
        success: function(result) {
        $(".wrap").html(result);
    }
});
}