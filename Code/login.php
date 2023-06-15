<?php
$message = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    include '../components/connect.php';

    $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? LIMIT 1");
    $select_tutor->execute([$email]);
    $row = $select_tutor->fetch(PDO::FETCH_ASSOC);

    if ($select_tutor->rowCount() > 0) {
        if (password_verify($pass, $row['password'])) {
            setcookie('tutor_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
            header('location:dashboard.php');
            exit();
        } else {
            $message[] = 'Incorrect email or password!';
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

?>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message form">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  
    <link rel="stylesheet" href="../css/style2.css">
   <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<section class="about">

<div class="row">

   <div class="image">
      <img src="../images/login.png" alt="">
   </div>
    <section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="login">
      <h3>Login</h3>
      <p>Your Email <span>*</span></p>
      <input type="email" name="email" placeholder="Enter your email" maxlength="20" required class="box">
      <p>Your Password <span>*</span></p>
      <input type="password" name="pass" placeholder="Enter your password" maxlength="20" required class="box">
      <p class="link">Don't have an account? <a href="register.php">Register New</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>
</div>
</section>
</body>

</html>
