

function load_page(page_id){
    $.ajax({
        type: "GET",
        url: "php_bin/moviesCardContent.php",
        data: "loadid="+page_id,
        success: function(result) {
            $(".wrap").html(result);
        }
    });
}