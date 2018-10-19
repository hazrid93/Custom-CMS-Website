<?php




    if(isset($_GET['edit_post'])){
        
        $post_id_edit = $_GET['edit_post'];
       
        $query = "SELECT * FROM posts WHERE `post_id` = {$post_id_edit}";
       
        $select_post_by_id = mysqli_query($connection,$query);

        
        if(!$select_post_by_id){
            die('QUERY FAILED' . mysqli_error($connection));
        }


        /*

For the first one: your program will go through the loop once for every row in the result set returned by the query. You can know in advance how many results there are by using mysql_num_rows().

For the second one: this time you are only using one row of the result set and you are doing something for each of the columns. That's what the foreach language construct does: it goes through the body of the loop for each entry in the array $row. The number of times the program will go through the loop is knowable in advance: it will go through once for every column in the result set (which presumably you know, but if you need to determine it you can use count($row))*/
        
        while($row = mysqli_fetch_assoc($select_post_by_id)){
            
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tag = $row['post_tag'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];


        }
        
        if(isset($_POST['update_post'])){
            

                
            $post_author = $_POST['post_author'];
            $post_title = $_POST['post_title'];
       //     $post_category_id = $_POST['post_category_id'];
            $post_category= $_POST['post_category'];
            $post_status = $_POST['post_status'];
            //need superglobal files with name of item sent from form 'name=image' and actual file name.
            $post_image = $_FILES['post_image']['name'];

            //when user select file it will save to a temporary location
            //the ['name'] and ['tmp_name'] are fixed key naming
            //temp path is specified in  upload_tmp_dir in your php.ini file. 
            $post_image_tmp = $_FILES['post_image']['tmp_name'];
        
            $post_tag = $_POST['post_tag'];
            $post_content = $_POST['post_content'];
            
            //needed function for images.
            // when submit is pressed, run this function to move image from tmp to specified folder
            move_uploaded_file($post_image_tmp, "../images/$post_image");
            
            //check no new image selected
            if(empty($post_image)){
                 $query = "SELECT post_image FROM posts WHERE post_id = {$post_id_edit}";
                 $image_by_id = mysqli_query($connection,$query);
                
                if(!$image_by_id){
                    die('QUERY FAILED' . mysqli_error($connection));
                }
            
                while($row = mysqli_fetch_assoc($image_by_id)){
                    $post_image = $row['post_image'];
                }
            }
            
            
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
             $query .= "post_author = '{$post_author}', ";
             $query .= "post_category_id = {$post_category}, ";
             $query .= "post_status = '{$post_status}', ";
             $query .= "post_tag = '{$post_tag}', ";
             $query .= "post_content = '{$post_content}', ";
            $query .= "post_image = '{$post_image}', ";
            
            // now() is inserted just like that into the query, its one of sql function 
            // https://www.w3schools.com/sql/func_mysql_now.asp
             $query .= "post_date = now() ";
             $query .= "WHERE post_id = {$post_id_edit} ";
            

            $update_post_by_id = mysqli_query($connection,$query);
            
            //echo $query;
        
            if(!$update_post_by_id){
                die('QUERY FAILED' . mysqli_error($connection));
            }
            
            
        }


    }
?>

<!-- enctype for form with multiple data type, especially with image -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
        <label for="title">Categories</label>
        <select style="display:block" name="post_category" id="">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection,$query);
            
                if(!$select_categories){
                    die('QUERY FAILED' . mysqli_error($connection));
                }
            
                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title']; 
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
                echo "</select>";
            ?>

    </div>
        
        
    <div class="form-group">
        <label for="title">Post Category Id</label>
        <input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id" disabled>
    </div>
    
    <div class="form-group">
        <label for="title">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    
    <div class="form-group">
        <label for="title">Post Image</label>
        <br>
        <img style="height:300px;width:200px" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="post_image">
    </div>
    
    
    
    
    
    
    
    
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input value="<?php echo $post_tag; ?>" type="text" class="form-control" name="post_tag">
    </div>
    
    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>