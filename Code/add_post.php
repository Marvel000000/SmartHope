<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $playlist = $_POST['playlist'];
   $playlist = filter_var($playlist, FILTER_SANITIZE_STRING);

   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   if($thumb_size > 2000000){
      $message[] = 'Image size is too large!';
   }else{
      $add_blog = $conn->prepare("INSERT INTO `blog` (id, tutor_id, playlist_id, title, description, content, thumb, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $add_blog->execute([$id, $tutor_id, $playlist, $title, $description, $content, $rename_thumb, $status]);
      move_uploaded_file($thumb_tmp_name, $thumb_folder);
      $message[] = 'New blog post added!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Posts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="../images/add_blog.webp" alt="">
      </div>

<section class="video-form">

   <h1 class="heading">Add New Post</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <p>Post Status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="" selected disabled>-- Select Status</option>
         <option value="active">Active</option>
         <option value="deactive">Deactive</option>
      </select>
      <p>Post Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Add post title" class="box">
      <p>Post Description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="Write description" maxlength="5000" cols="30" rows="10"></textarea>
      <p>Post Content <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000000" placeholder="Write your content..." cols="30" rows="10"></textarea>
      <p>Playlist<span>*</span></p>
      <select name="playlist" class="box" required>
         <option value="" disabled selected>-- Select Playlist</option>
         <?php
         $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
         $select_playlists->execute([$tutor_id]);
         if($select_playlists->rowCount() > 0){
            while($fetch_playlist = $select_playlists->fetch(PDO::FETCH_ASSOC)){
         ?>
         <option value="<?= $fetch_playlist['id']; ?>"><?= $fetch_playlist['title']; ?></option>
         <?php
            }
         ?>
         <?php
         }else{
            echo '<option value="" disabled>No playlist created yet!</option>';
         }
         ?>
      </select>
      <p>Post Thumbnail</p>
      <input type="file" name="thumb" accept="image/*" required class="box">
      <input type="submit" value="publish post" name="submit" class="btn">
   </form>

</section>
      </div>
</section>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>