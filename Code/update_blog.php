<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:dashboard.php');
}

if(isset($_POST['update'])){

   $blog_id = $_POST['blog_id'];
   $blog_id = filter_var($blog_id, FILTER_SANITIZE_STRING);
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

   $update_blog = $conn->prepare("UPDATE `blog` SET title = ?, description = ?, content = ?, status = ? WHERE id = ?");
   $update_blog->execute([$title, $description, $content, $status, $blog_id]);

   if(!empty($playlist)){
      $update_playlist = $conn->prepare("UPDATE `blog` SET playlist_id = ? WHERE id = ?");
      $update_playlist->execute([$playlist, $blog_id]);
   }

   $old_thumb = $_POST['old_thumb'];
   $old_thumb = filter_var($old_thumb, FILTER_SANITIZE_STRING);
   $thumb = $_FILES['thumb']['name'];
   $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
   $thumb_ext = pathinfo($thumb, PATHINFO_EXTENSION);
   $rename_thumb = unique_id().'.'.$thumb_ext;
   $thumb_size = $_FILES['thumb']['size'];
   $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
   $thumb_folder = '../uploaded_files/'.$rename_thumb;

   if (!empty($thumb)) {
      if ($thumb_size > 2000000) {
          $message[] = 'image size is too large!';
      } else {
          $update_thumb = $conn->prepare("UPDATE blog SET thumb = ? WHERE id = ?");
          $update_thumb->execute([$rename_thumb, $blog_id]);
          move_uploaded_file($thumb_tmp_name, $thumb_folder);
          if ($old_thumb != '' && $old_thumb != $rename_thumb) {
              unlink('../uploaded_files/' . $old_thumb);
          }
      }
  }

   $message[] = 'content updated!';

}

if(isset($_POST['delete_blog'])){

   $delete_id = $_POST['blog_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_video_thumb = $conn->prepare("SELECT thumb FROM `blog` WHERE id = ? LIMIT 1");
   $delete_video_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
   $delete_likes->execute([$delete_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
   $delete_comments->execute([$delete_id]);

   $delete_content = $conn->prepare("DELETE FROM `blog` WHERE id = ?");
   $delete_content->execute([$delete_id]);
   header('location:contents.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update video</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style2.css">
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/header2.php'; ?>
<section class="about">

   <div class="row">

      <div class="image">
         <img src="../images/add_blog.webp" alt="">
      </div>
   
<section class="video-form">

   <h1 class="heading">Update Content</h1>

   <?php
      $select_blog = $conn->prepare("SELECT * FROM `blog` WHERE id = ? AND tutor_id = ?");
      $select_blog->execute([$get_id, $tutor_id]);
      if($select_blog->rowCount() > 0){
         while($fecth_blog = $select_blog->fetch(PDO::FETCH_ASSOC)){ 
            $blog_id = $fecth_blog['id'];
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="blog_id" value="<?= $fecth_blog['id']; ?>">
      <input type="hidden" name="old_thumb" value="<?= $fecth_blog['thumb']; ?>">
      <p>Update Status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fecth_blog['status']; ?>" selected><?= $fecth_blog['status']; ?></option>
         <option value="active">Active</option>
         <option value="deactive">Deactive</option>
      </select>
      <p>Update Title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Enter video title" class="box" value="<?= $fecth_blog['title']; ?>">
      <p>Update Description <span>*</span></p>
      <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10"><?= $fecth_blog['description']; ?></textarea>
      <p>Update Content <span>*</span></p>
      <textarea name="content" class="box" required placeholder="Write content" maxlength="100000" cols="30" rows="10"><?= $fecth_blog['content']; ?></textarea>
      <p>Update Playlist</p>
      <select name="playlist" class="box">
         <option value="<?= $fecth_blog['playlist_id']; ?>" selected>--Select playlist</option>
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
            echo '<option value="" disabled>no course created yet!</option>';
         }
         ?>
      </select>
      <img src="../uploaded_files/<?= $fecth_blog['thumb']; ?>" alt="">
      <p>Update Thumbnail</p>
      <input type="file" name="thumb" accept="image/*" class="box">
      <input type="submit" value="update content" name="update" class="btn">
   
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">Video not found! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">Add Videos</a></p>';
      }
   ?>

</section>
   </div>
</section>


<script src="../js/script2.js"></script>

</body>
</html>
