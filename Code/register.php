<!DOCTYPE html>
<html>
<head>
    <title>Form Example</title>
   
    <link rel="stylesheet" href="../css/style2.css">
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>Register</h3>
      <div class="flex">
         <div class="col">
            <p>Your Name <span>*</span></p>
            <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
            <p>Your Profession <span>*</span></p>
            <select name="profession" class="box" required>
               <option value="" disabled selected>-- Select your profession</option>
               <option value="developer">Developer</option>
               <option value="desginer">Desginer</option>
               <option value="musician">Musician</option>
               <option value="biologist">Biologist</option>
               <option value="teacher">Teacher</option>
               <option value="engineer">Engineer</option>
               <option value="lawyer">Lawyer</option>
               <option value="accountant">Accountant</option>
               <option value="doctor">Doctor</option>
               <option value="journalist">Journalist</option>
               <option value="photographer">Photographer</option>
               <option value="Student">Student</option>
            </select>
            <p>Your email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter your email" maxlength="20" required class="box">
         </div>
         <div class="col">
            <p>Your Password <span>*</span></p>
            <input type="password" name="pass" placeholder="Enter your password" maxlength="20" required class="box">
            <p>Confirm Password <span>*</span></p>
            <input type="password" name="cpass" placeholder="Confirm your password" maxlength="20" required class="box">
            <p>Select Pic <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
            <p>Input your certificate <span>*</span></p>
            <input type="file" name="image"  class="box">
         </div>
      </div>
      <p class="link">Already have an account? <a href="login.php">Login Now</a></p>
      <input type="submit" name="submit" value="register now" class="btn">
   </form>

</section>
    <?php

    include '../components/connect.php';

    if (isset($_POST['submit'])) {
       $id = unique_id();
       $name = $_POST['name'];
       $name = filter_var($name, FILTER_SANITIZE_STRING);
       $profession = $_POST['profession'];
       $profession = filter_var($profession, FILTER_SANITIZE_STRING);
       $email = $_POST['email'];
       $email = filter_var($email, FILTER_SANITIZE_STRING);
       $pass = $_POST['pass'];
       $pass = filter_var($pass, FILTER_SANITIZE_STRING);
       $cpass = $_POST['cpass'];
       $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

       $image = $_FILES['image']['name'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
       $ext = pathinfo($image, PATHINFO_EXTENSION);
       $rename = unique_id().'.'.$ext;
       $image_size = $_FILES['image']['size'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $image_folder = '../uploaded_files/'.$rename;

       $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ?");
       $select_tutor->execute([$email]);

       if ($select_tutor->rowCount() > 0) {
          $message[] = 'Email already taken!';
       } else {
          if ($pass != $cpass) {
             $message[] = 'Confirm password not matched!';
          } else {
             // Hash the password using bcrypt algorithm
             $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

             $insert_tutor = $conn->prepare("INSERT INTO `tutors`(id, name, profession, email, password, image) VALUES(?,?,?,?,?,?)");
             $insert_tutor->execute([$id, $name, $profession, $email, $hashed_pass, $rename]);
             move_uploaded_file($image_tmp_name, $image_folder);
             $message[] = 'New tutor registered! Please login now.';
          }
       }
    }
    ?>

</body>
</html>
