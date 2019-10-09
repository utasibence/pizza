<?php

include_once 'dbh.inc.php';

session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['passwd'];

  if (empty($email) || empty($password)) {
    header("Location: ../index.php?login=empty");
    exit();
  } else {
    $stmt = $conn->prepare("SELECT email, passwd, name FROM admins WHERE email=?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($email, $passwd, $name);
		if ($stmt->num_rows == 1) {
    		while ($stmt->fetch()) {
        		if (password_verify($password, $passwd)) {
        			$_SESSION['email'] = $email;
        			$_SESSION['name'] = $name;
              header("Location: ../dashboard.php?login=success");
        			exit();
        		} else {
              header("Location: ../index.php?login=invalid_password");
        			exit();
        		}
    		}
		} else {
      header("Location: ../index.php?login=invalid_email");
			exit();
		}
  }
} else {
  header("Location: ../index.php?login=error");
  exit();
}
