<?php
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

            if(!is_dir("../public/".$directorio)){
                mkdir("../public/".$directorio,0777);
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
        $sql="SELECT username FROM user WHERE id = $id";
        $execute = $this->conn->query($sql);
        $request = $execute->fetch(PDO::FETCH_ASSOC);
        return $request;
    }
    public function DeletePost(string $id){
        $sql="DELETE  FROM post WHERE id=?";
        $arrwhere =array($id);
        $delete= $this->conn->prepare($sql);
        $del = $delete->execute($arrwhere);
        return $del;
    }
}
?>