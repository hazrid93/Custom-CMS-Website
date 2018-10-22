
                       <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>In Response To</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                          
                                </tr>
                            </thead>
                            <tbody>
                            <?php
    
                                $query = "SELECT * FROM comments";
                                $select_comments = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($select_comments)){
                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_email = $row['comment_email'];
                                    $comment_content = $row['comment_content'];
                                    $comment_status = $row['comment_status'];
                                    $comment_date = $row['comment_date'];
 
                                    
                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_content</td>";
                                    
                                    // get the categoryId corresponsing title.
//                                    $query = "SELECT cat_title FROM comments WHERE cat_id = {$post_category_id}";
//                                    
//                                    $category_by_id = mysqli_query($connection,$query);
//
//                                    if(!$category_by_id){
//                                        die('QUERY FAILED' . mysqli_error($connection));
//                                    }
//                                    
//                                    //mysqli_fetch_row or mysqli_fetch_assoc need to be in a while loop
//                                    while($row = mysqli_fetch_assoc($category_by_id)){
//                                        $cat_title = $row['cat_title'];
//                                    }

                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_status</td>";
                                    echo "<td>$comment_date</td>";
                                    
                                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id"; 
                                    $select_post_by_query_id = mysqli_query($connection,$query);
                                    if(!$select_post_by_query_id){
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                    while($row = mysqli_fetch_assoc($select_post_by_query_id)){
                                        $post_title = $row['post_title'];
                                        $post_id = $row['post_id'];
                                        
                                        //use .. to go outside twice
                                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                    }
                                    
                                    echo "<td>To User</td>";
                                    echo "<td><a href='post.php?source=edit_post&edit_post={$comment_id}'>Approve</a></td>";
                                    echo "<td><a href='post.php?delete_post={$comment_id}'>Unapprove</a></td>";
                                    echo "<td><a href='post.php?delete_post={$comment_id}'>DELETE</a></td>";
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
                        
                        
                        
     
       
        
        
        