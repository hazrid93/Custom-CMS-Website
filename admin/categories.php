<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <?php include "includes/admin_navigation.php" ?>

        
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                        

                        <div class="col-xs-6">
                            
                            <?php //add into categories db
                                if(isset($_POST['submit'])){
                                    $cat_title = $_POST['cat_title'];
                                    if($cat_title == "" || empty($cat_title)){
                                        echo "Insert value here";
                                    } else {

                                        $query = "INSERT INTO categories(cat_title)";
                                        $query .= "VALUE('{$cat_title}')";
                                        $create_category_query = mysqli_query($connection,$query);
                                        
                                        if(!$create_category_query){
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    }
                                }

                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                        </div>

                        
                        <div class="col-xs-6">
                            
                        <?php 
                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection,$query);
                        ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>";
                                             echo "<td>{$cat_id}</td>";   
                                             echo "<td>{$cat_title}</td>";  
                                            //send a get request to this page, in key=value or (delete=$cat_id)
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    <?php
                                        // fetch the get request key,value from get superglobal
                                        if(isset($_GET['delete'])){
                                            //get value from key 'delete'
                                            $the_cat_id = $_GET['delete'];
                                             $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                             $delete_query = mysqli_query($connection,$query);
                                            //redirect back to categories.php
                                            header("Location: categories.php");
                                        }
                                    
                                    
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>