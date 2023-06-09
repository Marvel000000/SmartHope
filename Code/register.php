<!DOCTYPE html>
<html>
<head>
    <title>Form Example</title>
    <style>
        body {
            background-color: #333333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            height: 90vh;
            color :#FFFFFF;
        }

        .image-container {
            flex: 1;
            text-align: right;
            padding-right: 20px;
            height: 605px;
        }

        .image-container img {
            width: 750px;
            height: 107.62%;
        }

        .form-container {
            flex: 1;
            background-color: #333333;
            padding: 20px;
            border-radius: 5px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color : #FFFFFF;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #FFFFFF;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            background-color : #808080;
            border-color: #000000;
        }

        .form-container button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #65008d;
            color: #000000;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #808080;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="https://scientific-publishing.webshop.elsevier.com/wp-content/uploads/2022/08/what-background-study-how-to-write-1200x801.jpg" alt="Image">
        </div>
        <div class="form-container">
            <h2>Register</h2>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" required style="font-size: 20px; color: #FFFFFF; width: 525px">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" required style="font-size: 20px; color: #FFFFFF; width: 525px">
                <label for="email">Email:</label>
                <input type="email" name="email" required style="font-size: 20px; color: #FFFFFF; width: 525px">
                <label for="pass">Password:</label>
                <input type="password" name="pass" required style="font-size: 20px; color: #FFFFFF; width: 525px">
                <label for="cpass">Confirm Password:</label>
                <input type="password" name="cpass" required style="font-size: 20px; color: #FFFFFF; width: 525px">
                <label for="image">Image:</label>
                <input type="file" name="image" required>
                <label for="Evidence">Evidence:</label>
                <input type="file" name="image" required>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
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
