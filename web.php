<?php 
    require_once "note.php";
    require_once "config.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $note = new Note($conn);
        echo $note->create($_POST["title"], $_POST["content"]);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "PUT"){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            
            parse_str(file_get_contents("php://input"), $putData); 

            $note = new Note($conn);
            echo $note->update($id, $putData["title"], $putData["content"]);
        }
        else{
            echo "id is not correct";
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            
            $notes = new Note($conn);
            $note = $notes->get($id);
            echo $note;
        }
        else{
            echo "id is not correct";
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
        if (isset($_GET["id"])){
            $id = $_GET["id"];
            
            $note = new Note($conn);
            echo $note->delete($id);
        }
        else{
            echo "id is not correct";
        }
    }

?>