<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_COOKIE['tutor_id'])){
   $user_id = $_COOKIE['tutor_id'];
}else{
   $user_id = '';
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:contents.php');
}

if(isset($_POST['delete_video'])){

   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_video_thumb = $conn->prepare("SELECT thumb FROM `content` WHERE id = ? LIMIT 1");
   $delete_video_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_video = $conn->prepare("SELECT video FROM `content` WHERE id = ? LIMIT 1");
   $delete_video->execute([$delete_id]);
   $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_video['video']);

   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
   $delete_likes->execute([$delete_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
   $delete_comments->execute([$delete_id]);

   $delete_content = $conn->prepare("DELETE FROM `content` WHERE id = ?");
   $delete_content->execute([$delete_id]);
   header('location:contents.php');
    
}

if(isset($_POST['add_comment'])){

   if($user_id != ''){

      $id = unique_id();
      $comment_box = $_POST['comment_box'];
      $comment_box = filter_var($comment_box, FILTER_SANITIZE_STRING);
      $content_id = $_POST['content_id'];
      $content_id = filter_var($content_id, FILTER_SANITIZE_STRING);

      $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ? LIMIT 1");
      $select_content->execute([$content_id]);
      $fetch_content = $select_content->fetch(PDO::FETCH_ASSOC);

      $tutor_id = $fetch_content['tutor_id'];

      if($select_content->rowCount() > 0){

         $select_comment = $conn->prepare("SELECT * FROM `comments` WHERE content_id = ? AND user_id = ? AND tutor_id = ? AND comment = ?");
         $select_comment->execute([$content_id, $user_id, $tutor_id, $comment_box]);

         if($select_comment->rowCount() > 0){
            $message[] = 'Comment already added!';
         }else{
            $insert_comment = $conn->prepare("INSERT INTO `comments`(id, content_id, user_id, tutor_id, comment) VALUES(?,?,?,?,?)");
            $insert_comment->execute([$id, $content_id, $user_id, $tutor_id, $comment_box]);
            $message[] = 'New comment added!';
         }

      }else{
         $message[] = 'Something went wrong!';
      }

   }else{
      $message[] = 'Please login first!';
   }

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

if(isset($_POST['update_now'])){

   $update_id = $_POST['update_id'];
   $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
   $update_box = $_POST['update_box'];
   $update_box = filter_var($update_box, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ? AND comment = ?");
   $verify_comment->execute([$update_id, $update_box]);

   if($verify_comment->rowCount() > 0){
      $message[] = 'Comment already added!';
   }else{
      $update_comment = $conn->prepare("UPDATE `comments` SET comment = ? WHERE id = ?");
      $update_comment->execute([$update_box, $update_id]);
      $message[] = 'Comment edited successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view content</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<?php
   if(isset($_POST['edit_comment'])){
      $edit_id = $_POST['comment_id'];
      $edit_id = filter_var($edit_id, FILTER_SANITIZE_STRING);
      $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ? LIMIT 1");
      $verify_comment->execute([$edit_id]);
      if($verify_comment->rowCount() > 0){
         $fetch_edit_comment = $verify_comment->fetch(PDO::FETCH_ASSOC);
?>
<section class="edit-comment">
   <h1 class="heading">Edit comment</h1>
   <form action="" method="post">
      <input type="hidden" name="update_id" value="<?= $fetch_edit_comment['id']; ?>">
      <textarea name="update_box" class="box" maxlength="1000" required placeholder="Please enter your comment" cols="30" rows="10"><?= $fetch_edit_comment['comment']; ?></textarea>
      <div class="flex">
         <a href="watch_video.php?get_id=<?= $get_id; ?>" class="inline-option-btn">cancel edit</a>
         <input type="submit" value="update now" name="update_now" class="inline-btn">
      </div>
   </form>
</section>
<?php
   }else{
      $message[] = 'Comment was not found!';
   }
}
?>

<section class="view-content">

   <?php
      $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ? AND tutor_id = ?");
      $select_content->execute([$get_id, $tutor_id]);
      if($select_content->rowCount() > 0){
         while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
            $video_id = $fetch_content['id'];

            $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ? AND content_id = ?");
            $count_likes->execute([$tutor_id, $video_id]);
            $total_likes = $count_likes->rowCount();

            $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ? AND content_id = ?");
            $count_comments->execute([$tutor_id, $video_id]);
            $total_comments = $count_comments->rowCount();
   ?>
   <div class="container">
      <video src="../uploaded_files/<?= $fetch_content['video']; ?>" autoplay controls poster="../uploaded_files/<?= $fetch_content['thumb']; ?>" class="video"></video>
      <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_content['date']; ?></span></div>
      <h3 class="title"><?= $fetch_content['title']; ?></h3>
      <div class="flex">
         <div><i class="fas fa-comment"></i><span><?= $total_comments; ?></span></div>
      </div>
      <div class="description"><?= $fetch_content['description']; ?></div>
      <form action="" method="post">
         <div class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <a href="update_content.php?get_id=<?= $video_id; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this video?');" name="delete_video">
         </div>
      </form>
   </div>
   <?php
    }
   }else{
      echo '<p class="empty">no contents added yet! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">Add videos</a></p>';
   }
      
   ?>

</section>

<!-- comments section starts  -->

<section class="comments">

   <h1 class="heading">Add A Comment</h1>

   <form action="" method="post" class="add-comment">
      <input type="hidden" name="content_id" value="<?= $get_id; ?>">
      <textarea name="comment_box" required placeholder="Write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
      <input type="submit" value="add comment" name="add_comment" class="inline-btn">
   </form>

   <h1 class="heading">User Comments</h1>

   
   <div class="show-comments">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE content_id = ?");
         $select_comments->execute([$get_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){   
               $select_commentor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
               $select_commentor->execute([$fetch_comment['user_id']]);
               $fetch_commentor = $select_commentor->fetch(PDO::FETCH_ASSOC);

               if ($fetch_commentor && is_array($fetch_commentor))
      ?>
      <div class="box" style="<?php if($fetch_comment['user_id'] == $user_id){echo 'order:-1;';} ?>">
         <div class="user">
            <img src="../uploaded_files/<?= $fetch_commentor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_commentor['name']; ?></h3>
               <span><?= $fetch_comment['date']; ?></span>
            </div>
         </div>
         <p class="text"><?= $fetch_comment['comment']; ?></p>
         <?php
            if($fetch_comment['user_id'] == $user_id){ 
         ?>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
            <button type="submit" name="edit_comment" class="inline-option-btn">Edit Comment</button>
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Delete this comment?');">Delete Comment</button>
         </form>
         <?php
         }
         ?>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">No comments added yet!</p>';
      }
      ?>
      </div>
   
</section>

<!-- comments section ends -->
   
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>