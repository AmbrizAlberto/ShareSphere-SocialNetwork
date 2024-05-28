document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-notification-btn').forEach(button => {
        button.addEventListener('click', function() {
            var notificationId = this.getAttribute('data-id');

            fetch('../../controllers/Delete/delete_notification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'notificationId=' + notificationId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.closest('.notificacion').remove();
                } else {
                    alert('Error al eliminar la notificación');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    });