
$('.like').on('click', function () {
    var  like_s = $(this).attr('data-like');
    var  post_id = $(this).attr('data-postid');
         post_id = post_id.slice(0,-2);
     //alert(post_id);

    $.ajax({
       type: 'POST',
       url: url,
       data: {like_s: like_s, post_id: post_id, _token: token},
       success: function (data) {

           if (data.is_like == 1) {

               $('*[data-postid="' + post_id + '_l"]').removeClass('btn-default').addClass('btn-success');
               $('*[data-postid="' + post_id + '_d"]').removeClass('btn-danger').addClass('btn-default');
                // to increase one to the likes
               var current_like =   $('*[data-postid="' + post_id + '_l"]').find('.like_count').text();
               var newLike = parseInt(current_like) + 1;
               $('*[data-postid="' + post_id + '_l"]').find('.like_count').text(newLike);

               if (data.change_like == 1) {
                   var current_dislike =   $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text();
                   var newDislike = parseInt(current_dislike) - 1;
                   $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text(newDislike);
               }
           }

           if (data.is_like == 0) {
               $('*[data-postid="' + post_id + '_l"]').removeClass('btn-success').addClass('btn-default');
               // to decrease one to the likes

               var current_like =   $('*[data-postid="' + post_id + '_l"]').find('.like_count').text();
               var newLike = parseInt(current_like) - 1;
               $('*[data-postid="' + post_id + '_l"]').find('.like_count').text(newLike);
           }
       }
    });
});


$('.dislike').on('click', function () {
    var  like_s = $(this).attr('data-like');
    var  post_id = $(this).attr('data-postid');
    post_id = post_id.slice(0,-2);
    //alert(post_id);

    $.ajax({
        type: 'POST',
        url: url_dis,
        data: {like_s: like_s, post_id: post_id, _token: token},
        success: function (data) {

            if (data.is_dislike == 1) {

                $('*[data-postid="' + post_id + '_d"]').removeClass('btn-default').addClass('btn-danger');
                $('*[data-postid="' + post_id + '_l"]').removeClass('btn-success').addClass('btn-default');

                // to decrease one to the likes
                var current_dislike =   $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text();
                var newDislike = parseInt(current_dislike) + 1;
                $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text(newDislike);

                if (data.change_dislike == 1) {
                    var current_like =   $('*[data-postid="' + post_id + '_l"]').find('.like_count').text();
                    var newLike = parseInt(current_like) - 1;
                    $('*[data-postid="' + post_id + '_l"]').find('.like_count').text(newLike);
                }
            }

            if (data.is_dislike == 0) {
                $('*[data-postid="' + post_id + '_d"]').removeClass('btn-danger').addClass('btn-default');

                // to decrease one to the likes
                var current_dislike =   $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text();
                var newDislike = parseInt(current_dislike) - 1;
                $('*[data-postid="' + post_id + '_d"]').find('.dislike_count').text(newDislike);
            }
        }
    });
});