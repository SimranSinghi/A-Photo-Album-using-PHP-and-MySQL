<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

try {
  $dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=album","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//   print_r($dbh);
  $dbh->beginTransaction();
  $dbh->commit();

  $stmt = $dbh->prepare('select * from users');
  $stmt->execute();
//   print "<pre>";
//   while ($row = $stmt->fetch()) {
//     print_r($row);
//   }
//   print "</pre>";
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>