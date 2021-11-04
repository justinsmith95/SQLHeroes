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


// echo $_POST;
//todo: send the post object instead of each item

function createHero()
{


    if (!isset($_REQUEST["name"])) {
        echo "ERROR 422: undefined variable, expected 'name'";
        return;
    }
    if (!isset($_REQUEST["about_me"])) {
        echo "ERROR 422: undefined variable, expected 'about_me'";
        return;
    }
    if (!isset($_REQUEST["biography"])) {
        echo "ERROR 422: undefined variable, expected 'biography'";
        return;
    }
    $name = $_REQUEST["name"];
    $about_me = $_REQUEST["about_me"];
    $biography = $_REQUEST["biography"];
    $sql =  "INSERT INTO heroes (name, about_me, biography) VALUES ('$name', '$about_me', '$biography')";
    global $conn;
    if ($conn->query($sql) === true) {
        echo 'success';
    } else {
        echo $conn->error;
    }
}


function updateHero()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Hero_Database";
    // change to if name,about,bio exists, add to string variable, set sql = string
    if (!isset($_REQUEST["name"])) {
        echo "ERROR 422: undefined variable, expected 'name'";
        return;
    }
    if (!isset($_REQUEST["about_me"])) {
        echo "ERROR 422: undefined variable, expected 'about_me'";
        return;
    }
    if (!isset($_REQUEST["biography"])) {
        echo "ERROR 422: undefined variable, expected 'biography'";
        return;
    }
    $name = $_REQUEST["name"];
    $about_me = $_REQUEST["about_me"];
    $biography = $_REQUEST["biography"];
    $id = $_REQUEST["id"];

    $sql = "UPDATE heroes SET name='$name', about_me='$about_me', biography='$biography' WHERE id=$id";
    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

function deleteHero()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Hero_Database";

    if (!isset($_REQUEST["id"])) {
        echo "ERROR 422: undefined variable, expected 'id'";
        return;
    }
    // sql to delete a record
    $id = $_REQUEST["id"];
    $sql = "DELETE FROM heroes WHERE id=$id";
    global $conn;
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
// function readHeroesEnemies()
// {
//     $sql = "SELECT
//     heroes.name,
//     GROUP_CONCAT(heroes.name SEPARATOR ', ') as enemies
//     FROM heroes
//     INNER JOIN enemies ON relationships.hero1_id=heroes.id, relationships.hero2_id=heroes.id WHERE relationships.type_id='2'
//     INNER JOIN relationship_types ON relationship_types.id=relationships.type_id
//     GROUP BY heroes.id";
//     global $conn;
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // output data of each row
//         while ($row = $result->fetch_assoc()) {
//            print_r($row);
//         }
//     } else {
//         echo "0 results";
//     }
//     //catch exception
// }

function getAllHeroes()
{
    // get the heroes, return the heroes

    $sql = "SELECT 
    heroes.name, 
    heroes.about_me, 
    heroes.biography,  
    GROUP_CONCAT( ability_type.ability SEPARATOR ', ') as abilities 
    FROM heroes 
    INNER JOIN abilities ON abilities.hero_id=heroes.id
    INNER JOIN ability_type ON ability_type.id=abilities.ability_id
    GROUP BY heroes.id";
    global $conn;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
           print_r($row);
        }
    } else {
        echo "0 results";
    }
    //catch exception
}
    //switch case
    if (isset($_GET['route'])) {

        switch ($_GET['route']) {
            case "create":
                createHero();
                break;
            case "readAllHeroes":
                getAllHeroes();
                break;
            case "update":
                updateHero();
                break;
            case "delete":
                deleteHero();
                break;
            // case "readHeroesEnemies":
            //     readHeroesEnemies();
            //     break;
            default:
                echo 'ERROR 404, page not found.';
                break;
        }
    } else {
        echo 'Welcome to the Homepage';
    }

$conn->close();
