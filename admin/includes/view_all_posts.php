
                       <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                          
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    
                                $query = "SELECT * FROM posts";
                                $select_posts = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_posts)){
                                    $post_id = $row['post_id'];
                                    $post_author = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tag = $row['post_tag'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_date = $row['post_date'];
                                    
                                    echo "<tr>";
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td>$post_title</td>";
                                    
                                    // get the categoryId corresponsing title.
                                    $query = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
                                    
                                    $category_by_id = mysqli_query($connection,$query);

                                    if(!$category_by_id){
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                    
                                    //mysqli_fetch_row or mysqli_fetch_assoc need to be in a while loop
                                    while($row = mysqli_fetch_assoc($category_by_id)){
                                        $cat_title = $row['cat_title'];
                                    }

                                    echo "<td>$cat_title</td>";
                                    echo "<td>$post_status</td>";
                                    echo "<td><img class='img-thumbnail' style='min-width:70px;min-height:120px;max-width:100px;max-height:160px;' src='../images/$post_image' alt='image'></td>";
                                    echo "<td>$post_tag</td>";
                                    echo "<td>$post_comment_count</td>";
                                    echo "<td>$post_date</td>";
                                    echo "<td><a href='post.php?source=edit_post&edit_post={$post_id}'>EDIT</a></td>";
                                    echo "<td><a href='post.php?delete_post={$post_id}'>DELETE</a></td>";
                                    echo "</tr>";
                                }
    
    
                            ?>
                            </tbody>

                        </table>
                           
                           <?php
                                if(isset($_GET['delete_post'])){
                                        $post_id_delete = $_GET['delete_post'];
                                        echo $post_id_delete;
                                        $query = "DELETE FROM `posts` WHERE `posts`.`post_id` = {$post_id_delete}";

                                        $delete_post = mysqli_query($connection,$query);

                                        if(!$delete_post){
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    
                                        //redirect back to categories.php
                                        header("Location: post.php");
                                }
                            ?>
                           
                        
                        </div>
                        
                        
                        
     
       
        
        
        