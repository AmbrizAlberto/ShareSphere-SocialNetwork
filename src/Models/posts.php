<?php
// posts.php
namespace models;
use PDO;

class posts extends connection{

    private $id;
    private $title;
    private $content;
    private $image;
    private $created_at;
    private $updated_at;
    private $creator_id;
    private $subgroup_id;


    public function __construct(){
        parent::__construct();
    }

    public function InsertPost(string $title, string $content, string $image=null, string $creator_id, string $subgroup_id){
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->creator_id = $creator_id;
        $this->subgroup_id = $subgroup_id;
    
        $sql = "INSERT INTO post (title, content, image, createdAt, updatedAt, creatorId , SubgroupId) VALUES (?, ?, ?, NOW(), NULL, ?, ?)";
        $insert = $this->conn->prepare($sql);
        $arrData = array($this->title, $this->content, $this->image, $this->creator_id, $this->subgroup_id);
        $resInsert = $insert->execute($arrData);
        $idInsert = $this->conn->lastInsertId();
        return $idInsert;
    }
    public function GetPosts(){
        $sql="SELECT * FROM post ORDER BY id DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetPostById($id){
        $sql="SELECT * FROM post WHERE id = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetPostsByIdUser($id){
        $sql="SELECT * FROM post WHERE creatorId = $id ORDER BY id DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function GetPostsByIdSubgroup($id){
        $sql="SELECT * FROM post WHERE SubgroupId = $id ORDER BY id DESC";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function InsertImg($name_images, $name){
        if(isset($_FILES['image'])){

            $file =$_FILES['image'];
            $file_name=$file['name'];
            $mimetype=$file['type'];
            $name = str_replace(" ", "", $name);
            $today = date("Y-m-d_H-i-s");
            $extension = ".".explode("/", $mimetype)[1];
            $ext_formatos=array("image/jpeg", "image/jpg","image/png");

            if(!in_array($mimetype,$ext_formatos)){
                header("location:/src/views/main.php");
                die("Formato incorrecto");
            }
            $directorio="images_posts/";

            if(in_array($directorio.$file_name, $name_images)){
                header("location:/src/views/main.php");
                die("Esta imagen a sido usada anteriormente, por lo que debe escoger otra");
            }

            if(!is_dir("../../public/".$directorio)){
                mkdir("../../public/".$directorio,0777);
            }
            if(in_array($directorio.$file_name, $name_images)){
            }else{
                move_uploaded_file($file['tmp_name'],"../../public/".$directorio.$name.$today.$extension);
            }
            return $name.$today.$extension;

        }else{
            header("location:/src/views/main.php");
        }       
    }

    public function GetPathImg(){
        $sql="SELECT image FROM post WHERE image is not null";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_COLUMN, 0);
        return $request;
    }
    public function GetUserById( string $id){
        $sql="SELECT * FROM user WHERE id = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }
    public function DeletePost(string $id){
        $sql="DELETE  FROM post WHERE id=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $delete->execute($arrwhere);    
    }

    public function GetPostsIndex(){
        $sql="SELECT COUNT(*)FROM post";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }
    public function GetUserImgById($id){
        $sql="SELECT image FROM user WHERE id = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function GetTheme($id){
        $sql="SELECT theme FROM user WHERE id = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_COLUMN, 0);
        return $request;
    }

    public function UpdateTheme(string $id, int $theme){
        $sql="UPDATE user SET theme = ? WHERE id = ?";
        $update = $this->conn->prepare($sql);
        $arrData = array($theme, $id);
        $update->execute($arrData);
    }

    public function UpdateUser(string $id, string $newUsername, string $newDescripcion, string $Image=null, string $imagePortada=null){
        if($Image == null){
            if($imagePortada == null){
                $sql="UPDATE user SET username = ?, descripcion = ? WHERE id = ?";
                $update = $this->conn->prepare($sql);
                $arrData = array($newUsername, $newDescripcion, $id);
            }else{
                $sql="UPDATE user SET username = ?, descripcion = ?, coverImg = ? WHERE id = ?";
                $portada = str_replace(" ", "", $imagePortada);
                $today = date("Y-m-d_H-i-s");
                move_uploaded_file($_FILES['imagePortada']['tmp_name'],"../.././public/fondo_users/".$today.$portada);
                $update = $this->conn->prepare($sql);
                $arrData = array($newUsername, $newDescripcion, $today.$portada, $id);
            }
        }else{
            if($imagePortada == null){
                $sql="UPDATE user SET username = ?, descripcion = ?, image = ? WHERE id = ?";
                $img = str_replace(" ", "", $Image);
                $today = date("Y-m-d_H-i-s");
                move_uploaded_file($_FILES['newImage']['tmp_name'],"../.././public/images_users/".$today.$img);
                $update = $this->conn->prepare($sql);
                $arrData = array($newUsername, $newDescripcion, $today.$img, $id);
            }else{
                $sql="UPDATE user SET username = ?, descripcion = ?, image = ?, coverImg = ? WHERE id = ?";
                $img = str_replace(" ", "", $Image);
                $portada = str_replace(" ", "", $imagePortada);
                $today = date("Y-m-d_H-i-s");
                move_uploaded_file($_FILES['newImage']['tmp_name'],"../.././public/images_users/".$today.$img);
                move_uploaded_file($_FILES['imagePortada']['tmp_name'],"../.././public/fondo_users/".$today.$portada);
                $update = $this->conn->prepare($sql);
                $arrData = array($newUsername, $newDescripcion, $today.$img, $today.$portada, $id);
            }
        }
        $update->execute($arrData);
    }

    public function EditPost(string $id, string $title, string $content, string $idSubgroup, string $Image=null){
        if($Image == null){
            $sql="UPDATE post SET title = ?, content = ?, updatedAt = NOW(), SubgroupId = ?  WHERE id = ?";
            $update = $this->conn->prepare($sql);
            $arrData = array($title, $content, $idSubgroup, $id);
        }else{
            $sql="UPDATE  post SET title = ?, content = ?, image = ?, updatedAt = NOW(), SubgroupId = ? WHERE id = ?";
            $img = str_replace(" ", "", $Image);
            $today = date("Y-m-d_H-i-s");
            move_uploaded_file($_FILES['newImage']['tmp_name'],"../.././public/images_posts/".$today.$img);
            $update = $this->conn->prepare($sql);
            $arrData = array($title, $content, $today.$img, $idSubgroup, $id);
        }
        $update->execute($arrData);
    }

    public function GetUsers(){
        $sql="SELECT id, username, email, image FROM user ORDER BY id DESC";
        $execute = $this->conn->query($sql);
        return $request = $execute->fetchall(PDO::FETCH_ASSOC);
    }

    public function GetPostsForJson(){
        $sql = "SELECT post.id, post.creatorId, post.title, post.image, user.username AS creator_name, user.image AS img
        FROM post
        JOIN user ON post.creatorId = user.id
        ORDER BY post.id DESC;";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchall(PDO::FETCH_ASSOC);
        return $request;
    }

    public function DeletePostsByAdmin($id){
        $sql="DELETE  FROM post WHERE creatorId=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $delete->execute($arrwhere);    
    }

    public function DeleteUser($id){
        $sql="DELETE  FROM user WHERE id=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $delete->execute($arrwhere);    
    }

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