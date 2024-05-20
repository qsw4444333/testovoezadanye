<?php 
    require_once "config.php";


    class Note{
        public $conn;
        
        const TABLE = "note";
    

        function __construct($conn)
        {
            $this->conn = $conn;
            try{
                mysqli_query($this->conn, "CREATE TABLE IF NOT EXISTS `".self::TABLE."` (`id` INT AUTO_INCREMENT, `title` VARCHAR(30), `content` VARCHAR(4000), `created_at` TIMESTAMP, PRIMARY KEY(`id`));");
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
        }


        public function get($id){
            $query = mysqli_query($this->conn, "SELECT * FROM ". self::TABLE ." WHERE id = '$id';");
            $note = mysqli_fetch_array($query);
            unset($note[0]);
            unset($note[1]);
            unset($note[2]);
            unset($note[3]);
            return json_encode($note);
        }


        public function update($id, $title, $content){
            try{
                $query = mysqli_query($this->conn, "UPDATE ". self::TABLE ." SET title = '$title', content = '$content' WHERE id = '$id';");
                return true;
            }
            catch (Exception $e){
                return $e->getMessage();
            }
        }


        public function create($title, $content){
            $created_at = date('Y-m-d H:i:s');
            $query = mysqli_query($this->conn, "INSERT INTO ". self::TABLE ." (title, content, created_at) VALUES('$title', '$content', '$created_at');");
            $note = mysqli_query($this->conn, "SELECT * FROM ". self::TABLE ." WHERE id = (SELECT MAX(id) FROM ". self::TABLE .");");
            $note = mysqli_fetch_array($note);
            unset($note[0]);
            unset($note[1]);
            unset($note[2]);
            unset($note[3]);
            return json_encode($note);
        }   

        public function get_all(){
            $query = mysqli_query($this->conn, "SELECT * FROM ". self::TABLE .";");
            return $query;
        }


        public function delete($id){
            try{
                $query = mysqli_query($this->conn, "DELETE FROM ". self::TABLE ." WHERE id = '$id';");
                return true;
            }
            catch (Exception $e){
                return $e->getMessage();
            }
        }


    }

?>