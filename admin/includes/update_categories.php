                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title2">Edit Category</label>
                                    <?php
                                    //get the status of key 'edit' from GET request
                                    if(isset($_GET['edit'])){
                                        $cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                                        $select_categories_id = mysqli_query($connection,$query);
                                         while($row = mysqli_fetch_assoc($select_categories_id)){
                                             $cat_title = $row['cat_title'];

                                        }
                                    } else {
                                        $cat_title = "None selected";
                                    }
                                    ?>
                                    <input id="cat-title2" class="form-control" type="text" name="cat_title" value="<?php echo $cat_title; ?>">
                                    
                                    <?php //update query
                                         if(isset($_POST['update-category'])){
                                            $the_cat_title = $_POST['cat_title'];
                                            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
                                            $update_query = mysqli_query($connection,$query);
                                             if(!$update_query){
                                                 die("QUERY FAILED" . mysqli_error($connection));
                                             }
                                         }
                                    
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update-category" value="Update Category">
                                </div>
                            </form>