<?php
require 'connect.php';
$id = $_POST['id'];
$var = 0;
if (isset($_POST['like'])) {
  $sql = "select * from posts where id=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "statement failed";
  } else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $select = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($select)) {
      if ($row['id'] == $id) {
        $var += 1;
        $likes = $row['likes'];
      }
    }
    if ($var == 1) {
      $sql = "update posts set likes=? where id=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "statement failed";
      } else {
        $likes++;
        mysqli_stmt_bind_param($stmt, "ss", $likes, $id);
        mysqli_stmt_execute($stmt);
        header("location:home.php");
      }
    }
  }
} else if (isset($_POST['comment'])) {
}
