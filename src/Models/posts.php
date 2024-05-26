<?php
// posts.php
namespace models;

use PDO;
use Exception;

class posts extends connection {

    public function __construct(){
        parent::__construct();
    }

    public function GetUserById($id){
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function InsertPost(string $title, string $content, string $image = null, string $creator_id, string $subgroup_id){
        // Validación de longitud
        $maxTitleLength = 255; // Ajusta según tu definición de base de datos
        $maxContentLength = 10000; // Ajusta según tu definición de base de datos

        if (strlen($title) > $maxTitleLength) {
            throw new Exception("Error: El título es demasiado largo");
        }

        if (strlen($content) > $maxContentLength) {
            throw new Exception("Error: El contenido es demasiado largo");
        }

        $sql = "INSERT INTO post (title, content, image, createdAt, updatedAt, creatorId, SubgroupId) 
                VALUES (?, ?, ?, NOW(), NULL, ?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = [$title, $content, $image, $creator_id, $subgroup_id];
        $insert->execute($arrData);
        return $this->conn->lastInsertId();
    }

    public function GetPosts(){
        $sql = "SELECT * FROM post ORDER BY id DESC";
        $execute = $this->conn->query($sql);
        return $execute->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetPostById($id){
        $sql = "SELECT * FROM post WHERE id = ?";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        return $execute->fetch(PDO::FETCH_ASSOC);
    }

    public function GetPostsByIdUser($id){
        $sql = "SELECT * FROM post WHERE creatorId = ? ORDER BY id DESC";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        return $execute->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetPostsByIdSubgroup($id){
        $sql = "SELECT * FROM post WHERE SubgroupId = ? ORDER BY id DESC";
        $execute = $this->conn->prepare($sql);
        $execute->execute([$id]);
        return $execute->fetchAll(PDO::FETCH_ASSOC);
    }

    public function InsertImg($name_images, $name){
        if(isset($_FILES['image'])){
            $file = $_FILES['image'];
            $file_name = $file['name'];
            $mimetype = $file['type'];
            $name = str_replace(" ", "", $name);
            $today = date("Y-m-d_H-i-s");
            $extension = "." . explode("/", $mimetype)[1];
            $ext_formatos = ["image/jpeg", "image/jpg", "image/png"];

            if(!in_array($mimetype, $ext_formatos)){
                header("location:/src/views/main.php");
                die("Formato incorrecto");
            }
            $directorio = "images_posts/";

            if(in_array($directorio.$file_name, $name_images)){
                header("location:/src/views/main.php");
                die("Esta imagen ha sido usada anteriormente, por favor, escoja otra");
            }

            if(!is_dir("../../public/".$directorio)){
                mkdir("../../public/".$directorio, 0777, true);
            }
            
            $filePath = "../../public/".$directorio.$name.$today.$extension;
            move_uploaded_file($file['tmp_name'], $filePath);
            return $name.$today.$extension;
        } else {
            header("location:/src/views/main.php");
        }
    }

    public function GetPathImg(){
        $sql = "SELECT image FROM post WHERE image IS NOT NULL";
        $execute = $this->conn->query($sql);
        return $execute->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    // Otros métodos sin cambios, asegúrate de revisar cada método para asegurar su seguridad y funcionalidad

    public function DeletePost(string $id){
        $sql = "DELETE FROM post WHERE id = ?";
        $delete = $this->conn->prepare($sql);
        $delete->execute([$id]);
    }

    // Métodos adicionales...

    public function AddLike($postId, $userId){
        $sql = "INSERT INTO post_likes (post_id, user_id) VALUES (?, ?)";
        $insert = $this->conn->prepare($sql);
        $insert->execute([$postId, $userId]);
    }

    public function RemoveLike($postId, $userId){
        $sql = "DELETE FROM post_likes WHERE post_id = ? AND user_id = ?";
        $delete = $this->conn->prepare($sql);
        $delete->execute([$postId, $userId]);
    }    

    public function UserLikedPost($postId, $userId){
        $sql = "SELECT COUNT(*) FROM post_likes WHERE post_id = ? AND user_id = ?";
        $query = $this->conn->prepare($sql);
        $query->execute([$postId, $userId]);
        return $query->fetchColumn() > 0;
    }
    
    public function GetLikesCount($postId){
        $sql = "SELECT COUNT(*) FROM post_likes WHERE post_id = ?";
        $query = $this->conn->prepare($sql);
        $query->execute([$postId]);
        return $query->fetchColumn();
    }

    public function hasLiked($postId, $userId){
        $sql = "SELECT COUNT(*) FROM post_likes WHERE post_id = ? AND user_id = ?";
        $query = $this->conn->prepare($sql);
        $query->execute([$postId, $userId]);
        return $query->fetchColumn() > 0;
    }

    public function InsertNotification($userId, $content) {
        $sql = "INSERT INTO notifications (user_id, content, date_created) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId, $content]);
        return $this->conn->lastInsertId();
    }

    public function GetNotificationCount($userId) {
        $sql = "SELECT COUNT(*) FROM notifications WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    public function GetNotifications($userId) {
        $sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY date_created DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function RemoveNotification($postId, $userId) {
        $query = "DELETE FROM notifications WHERE user_id = :user_id AND content LIKE :content";
        $statement = $this->conn->prepare($query);
        $likeContent = 'El usuario ' . $userId . ' ha dado like a tu publicación ' . $postId . '%';
        $statement->execute([
            'user_id' => $userId,
            'content' => $likeContent
        ]);
    }
    

    public function DeleteNotificationById($notificationId) {
        $query = "DELETE FROM notifications WHERE id = :notification_id";
        $statement = $this->conn->prepare($query); // Asegúrate de usar $this->conn
        return $statement->execute(['notification_id' => $notificationId]);
    }    
    
    public function GetCommentsCount($postId) {
        // Aquí debes escribir la lógica para obtener el número de comentarios
        // Por ejemplo, podrías usar una consulta SQL para contar los comentarios asociados con la publicación $postId
        // Luego, devuelves el número de comentarios
        
        // Ejemplo:
        $sql = "SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$postId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['comment_count'];
    }
    public function GetComments($postId) {
        $sql = "SELECT * FROM comments WHERE post_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function AgregarComentario($postId, $userId, $comment) {
        // Insertar el nuevo comentario en la base de datos
        $sql = "INSERT INTO comments (post_id, user_id, content, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$postId, $userId, $comment]);
    
        // Obtener el ID del comentario recién insertado
        $commentId = $this->conn->lastInsertId();
    
        // Obtener el número total de comentarios después de agregar el nuevo comentario
        $commentCount = $this->GetCommentsCount($postId);
    
        // Devolver el ID del comentario y el número total de comentarios
        return [
            'commentId' => $commentId,
            'commentCount' => $commentCount
        ];
    }
    
    
}
?>