<?php
include ("../bloks/bd.php");
if ($_GET['hash'] && $_GET['email']) {
  $worked = user_confirm();
} 
$supersecret_hash_padding = $const_r[str];
function user_confirm() {
  global $supersecret_hash_padding;
  $new_hash = md5($_GET['email'].$supersecret_hash_padding);
  if ($new_hash && ($new_hash == $_GET['hash'])) {
    $query = "SELECT user_name
              FROM user
              WHERE confirm_hash = '$new_hash'";
    $result = mysqli_query($db,$query);
    if (!$result || mysqli_num_rows($result) < 1) {
      $feedback = 'ERROR - Hash not found';
      return $feedback;
    } else {
      // Confirm the email and set account to active
      $email = $_GET['email'];
      $hash = $_GET['hash'];
      $query = "UPDATE user SET email='$email', is_confirmed='1' WHERE confirm_hash='$hash'";
      $result = mysqli_query($db,$query);
      return 1;
    }
  } else {
    $feedback = 'ERROR - Values do not match';
    return $feedback;
  }
}

$path = $http.'/modules/cab/login/login_form.php?conf='.$worked;
header("Location: $path");
?>