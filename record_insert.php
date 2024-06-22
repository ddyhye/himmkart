<?php
$score = $_GET['score'];
$name = $_GET['name'];
$phone_number = $_GET['phone_number'];

$conn = pg_connect('host=localhost port=5432 dbname=himm_record user=dodo password=net123') or die('Could not connect: ' . pg_last_error());

$sql = "INSERT INTO record (score, name, phone_number) VALUES ('$score', '$name', '$phone_number')";

$result = pg_query($conn, $sql);

if ($result) {
  echo "Data Insert Successfully!!";
} else {
  echo "Error: " . pg_last_error();
}

pg_close($conn);
?>
