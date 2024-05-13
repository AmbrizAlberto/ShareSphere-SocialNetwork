// src/js/votes.js
document.addEventListener('DOMContentLoaded', function() {
    const voteButtons = document.querySelectorAll('.vote-button');

    voteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const voteType = this.dataset.voteType;  // 'UPVOTE' o 'DOWNVOTE'

            fetch('/controllers/Set/SetVote.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `post_id=${postId}&vote_type=${voteType}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Voto actualizado');
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Fetch Error:', error));
        });
    });
});
