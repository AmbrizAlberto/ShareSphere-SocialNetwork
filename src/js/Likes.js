$(document).ready(function() {
    $('.like-button').click(function(event) {
        event.stopPropagation(); // Detiene la propagación del evento de clic

        var postId = $(this).data('post-id');
        var likeButton = $(this);
        var likeCountSpan = $('#like-count-' + postId);

        $.ajax({
            type: 'POST',
            url: '../../controllers/Set/like_handler.php',
            data: { postId: postId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var likeCount = response.likeCount;
                    likeCountSpan.text(likeCount);
                    if (response.liked) {
                        likeButton.addClass('liked');
                    } else {
                        likeButton.removeClass('liked');
                    }
                } else {
                    alert(response.message);
                }
            }
        });
    });
});
