document.addEventListener('DOMContentLoaded', function () {
    // Get all like buttons
    var likeButtons = document.querySelectorAll('.like-button');

    // Add event listener to each button
    likeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Get post ID from button's data attribute
            var postId = this.dataset.postId;

            // Send AJAX request to like/unlike the post
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/controllers/Set/SetPost.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('postId=' + postId);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Parse the JSON response
                    var response = JSON.parse(xhr.responseText);

                    // Update the likes count
                    var likesCountSpan = button.parentElement.querySelector('.likes-count');
                    likesCountSpan.textContent = response.likes;

                    // Toggle the 'liked' class on the button
                    button.classList.toggle('liked', response.userLiked);
                }
            };
        });
    });
});