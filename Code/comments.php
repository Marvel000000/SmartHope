<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_POST['delete_comment'])){

   $delete_id = $_POST['comment_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
   $verify_comment->execute([$delete_id]);

   if($verify_comment->rowCount() > 0){
      $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
      $delete_comment->execute([$delete_id]);
      $message[] = 'Comment deleted successfully!';
   }else{
      $message[] = 'Comment already deleted!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style2.css">
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/header2.php'; ?>
   

<section class="comments">

   <h1 class="heading">User Comments</h1>

   
   <div class="show-comments">
   <?php
      $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
      $select_comments->execute([$tutor_id]);
      if($select_comments->rowCount() > 0){
         while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
            $content_type = ''; // Variable to determine the content type (video or blog)
            $content_title = ''; // Variable to store the content title
            
            // Check if the comment is associated with a video
            $select_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? AND tutor_id = ?");
            $select_video->execute([$fetch_comment['content_id'], $tutor_id]);
            if($select_video->rowCount() > 0){
               $fetch_video = $select_video->fetch(PDO::FETCH_ASSOC);
               $content_type = 'video';
               $content_title = $fetch_video['title'];
            } else {
               // If the comment is not associated with a video, check if it's associated with a blog post
               $select_blog = $conn->prepare("SELECT * FROM `blog` WHERE id = ? AND tutor_id = ?");
               $select_blog->execute([$fetch_comment['content_id'], $tutor_id]);
               if($select_blog->rowCount() > 0){
                  $fetch_blog = $select_blog->fetch(PDO::FETCH_ASSOC);
                  $content_type = 'blog';
                  $content_title = $fetch_blog['title'];
               }
            }
            
            // Display the comment and content information
            if($content_type !== ''){
   ?>
   <div class="box" style="<?php if($fetch_comment['tutor_id'] == $tutor_id){echo 'order:-1;';} ?>">
      <div class="content"><span><?= $fetch_comment['date']; ?></span><p> - <?= $content_title; ?> - </p><a href="<?php echo ($content_type === 'video') ? 'watch_video.php?get_id=' . $fetch_video['id'] : 'view_blog.php?get_id=' . $fetch_blog['id']; ?>">View Content</a></div>
      <p class="text"><?= $fetch_comment['comment']; ?></p>
      <form action="" method="post">
         <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
         <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Delete this comment?');">Delete Comment</button>
      </form>
   </div>
   <?php
            } else {
               echo '<p class="empty">No matching content found for comment ID: ' . $fetch_comment['id'] . '</p>';
            }
         }
      } else {
         echo '<p class="empty">No comments added yet!</p>';
      }
   ?>
</div>
   
</section>

<script src="../js/script2.js"></script>

</body>
</html>