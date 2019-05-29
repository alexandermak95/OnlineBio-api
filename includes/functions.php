<?php
/* Köper en biljett */
function ticket($conn) {
  //Lägger till biljett i ticket tabellen
  $userId = mysqli_real_escape_string($conn, $_POST['userid']);
  $filmId1 = mysqli_real_escape_string($conn, $_POST['choice']);
  $antal1 = mysqli_real_escape_string($conn, $_POST['antal']);
  $query = "INSERT INTO ticket (ticketKundId,ticketFilmId,antalTickets)
  VALUES((SELECT kundId FROM kund WHERE kundId=$userId), (SELECT filmId FROM film WHERE filmId=$filmId1), $antal1 )";
  $result = mysqli_query($conn,$query) or die("Query failed: $query");

  // Uppdaterar film tabellen
  $current = "SELECT platser FROM film WHERE filmId=$filmId1";
  $curr = mysqli_query($conn, $current) or die("Query failed: $query");
  $row = mysqli_fetch_array($curr);
  // Kollar att önskad antal biljetter inte är större än antal platser
  if($antal1 > $row[0]) {
    die("<h2 class='warning'> Det finns inte såpass många biljetter kvar!</h2>");
  }else {
    $query2 = "UPDATE film SET platser= $row[0]-$antal WHERE filmId=$filmId1";
    $result2 = mysqli_query($conn,$query2);
  }
  return $userId;
}

/* Hämtar kundens köpta biljetter */
function getSpec($conn, $id) {
  $query = "SELECT * FROM film
  INNER JOIN ticket ON ticket.ticketKundId =$id and ticket.ticketFilmId= film.filmId";
  $result = mysqli_query($conn,$query) or die('Query failed:'. $query);
  $row = mysqli_fetch_all($result);
  return $row;
}

/*
 * Hämtar alla filmer
*/
function getMovies($conn){
    $query = "SELECT * FROM film";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Hämtar en kund
 */
function getKund($conn,$id){
    $query = "SELECT * FROM kund
			WHERE kundId=".$id;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Skapar en användare (kund)
*/
function addKund($conn){
    $name = escapeInsert($conn,$_POST['name']);
    $email = escapeInsert($conn,$_POST['email']);
    $password = escapeInsert($conn,$_POST['pwd']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO kund(kundNamn,email,password) VALUES('$name','$email','$passwordHash')";
    $result = mysqli_query($conn,$query) or die("Query failed: $query");
    $insId = mysqli_insert_id($conn);

    return $insId;
}

/* Uppdaterar en kund */
function updateKund($conn){
    $name = escapeInsert($conn,$_POST['newName']);
    $email = escapeInsert($conn,$_POST['newEmail']);
    $editid = $_POST['editid'];
    $query = "UPDATE kund SET kundNamn='$name', email='$email' WHERE kundId=". $editid;
    $result = mysqli_query($conn,$query) or die("Query failed: $query");
    return 'Dina uppgifter har ändrats!';
}

/* Tar bort en användare */
function deleteKund($conn,$id){
    $query = "DELETE FROM kund WHERE kundId=". $id;
    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}


function escapeInsert($conn,$insert) {
    $insert = htmlspecialchars($insert);
    $insert = mysqli_real_escape_string($conn,$insert);
    return $insert;
}
