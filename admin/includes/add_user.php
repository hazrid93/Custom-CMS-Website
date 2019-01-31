<?php

    if(isset($_POST['create_user'])){
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        
        //when user select file it will save to a temporary location
        //the ['name'] and ['tmp_name'] are fixed key naming
        //temp path is specified in  upload_tmp_dir in your php.ini file. 
     //   $post_image_tmp = $_FILES['image']['tmp_name'];
        
        
       // $post_tag = $_POST['post_tags'];
      //  $post_content = $_POST['post_content'];
        
        //send using date function with format date-month-year
       // $post_date = date('d-m-y');
        
    //    $post_comment_count = 4;
        
        //needed function for images.
        // when submit is pressed, run this function to move image from tmp to specified folder
      //  move_uploaded_file($post_image_tmp, "../images/$post_image");
        
        //escape special character to avoid sql injection
        // https://stackoverflow.com/questions/5741187/sql-injection-that-gets-around-mysql-real-escape-string
        // escape variables for security and to avoid any sql issue
       // $esc_post_content = mysqli_real_escape_string($connection, $post_content);
        
        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        
        //use single quote for values that are string
        //use function now() to format the date at $post_date to insert into db
        $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
        
        $create_user = mysqli_query($connection,$query);

        if(!$create_user){
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
?>

<!-- enctype for form with multiple data type, especially with image -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    
    
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="title">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    
        <div class="form-group">
        <label for="title">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>