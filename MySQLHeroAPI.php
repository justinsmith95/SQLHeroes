<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Hero_Database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


echo $_POST;
//todo: send the post object instead of each item


if ($action != "") {
    switch ($action) {
        case "create":
            createHero($_POST);
            break;
        case "read":
            //readAllHeroes();
            break;
        case "update":
            updateHero($_GET);
            break;
        case "delete":
            deleteHero($_GET);
            break;
        default:

            init();
    }
}

function createHero($_REQUEST)
{

    $name = $_POST["name"];
    $about_me = $_POST["about_me"];
    $biography = $_POST["biography"];

    "INSERT INTO heroes (name, about_me, biography) VALUES ('$name', '$about_me', '$biography')";

}


// function updateHero($id, $name, $about_me, $biography){
//     //
//     //array_splice($_SESSION["heroes"],$index,1,[[$name, $tagline]]);
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "Hero_Database";

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // Check connection
//     if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//     }

//     $sql = "UPDATE heroes SET name='$name', about_me='$about_me', biography='$biography' WHERE id=$id";

//     if ($conn->query($sql) === TRUE) {
//     echo "Record updated successfully";
//     } else {
//     echo "Error updating record: " . $conn->error;
//     }
//     $conn->close();

// }

// function deleteHero($id){
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "Hero_Database";

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // Check connection
//     if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//     }

//     // sql to delete a record
//     $sql = "DELETE FROM heroes WHERE id=$id";

//     if ($conn->query($sql) === TRUE) {
//     echo "Record deleted successfully";
//     } else {
//     echo "Error deleting record: " . $conn->error;
//     }
// }








// function getAllHeroes(){
//     // get the heroes, return the heroes

//     try {
//         $this->connect();
//         $sql = "SELECT * FROM heroes";
//         $result = $this->conn->query($sql);

//         if ($result->num_rows > 0) {
//         // output data of each row
//             while($row = $result->fetch_assoc()) {
//                 // create an object 
//                 // append it to the heroes array
//                 $heroObj = new HeroObject($row["nickname"], $row["tagline"]);
//                 array_push($this->heroes, $heroObj);
//             }
//         } else {
//             $this->heroes = [];
//         }
//         $this->disconnect();
//     }
//     //catch exception
//     catch(Exception $e) {
//         echo 'Message: ' .$e->getMessage();
//     }
//     return $this->heroes;
// }

$conn->close();
