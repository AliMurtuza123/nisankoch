$(document).ready(function(){

    // Load more data
    $('.load-more').click(function(){
        var rowm = Number($('#row').val());
        rowm = rowm + 1;

        
            $("#row").val(rowm);

            $.ajax({
                url: 'getdata.php',
                type: 'post',
                data: {row:rowm},
                beforeSend:function(){
                    $(".load-more").text("Loading...");
                },
                success: function(response){
					 
                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".cmnt:last").after(response).show().fadeIn("slow");

                       $(".load-more").text("Load More");
                    }, 2000);


                }
            });
        

    });

});