<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    
    if(isset($_SESSION['order_placed']))
    {
        echo $_SESSION['order_placed'];
        unset($_SESSION['order_placed']);
    }

    if(isset($_SESSION['order_not_placed']))
    {
        echo $_SESSION['order_not_placed'];
        unset($_SESSION['order_not_placed']);
    }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            
                // Create SQL query to display categories From database
                $diplay_cat_query="SELECT * FROM tbl_category WHERE active='yes'AND featured='yes' LIMIT 3 ";

                // Execute the query
                $res=mysqli_query($conn,$diplay_cat_query);

                // Count rows to check whether the category is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    // Category is vailable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the values like id, title, image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                                            
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>">
                            <div class="box-3 float-container">
                                <?php
                                    // Check whether the image is available or not
                                    if($image_name=="")
                                    {
                                        // Display Message
                                        echo '<div class="error">Image is not available</div>';
                                    }
                                    else
                                    {
                                        // Image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Category Image" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h2 class="float-text text-white"><?php echo $title;  ?></h2>
                            </div>
                            </a>

                        <?php

                    }
                }
                else
                {
                    // Categories not available
                    echo '<div class="error">Category not added.</div>';
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
            
                // get the details of food theat ate active

                // sql query
                $select_food_query="SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 6 ";

                // Execute the query
                $res2=mysqli_query($conn,$select_food_query);

                // Count the rows
                $count_food=mysqli_num_rows($res2);

                // Check whether food available or not
                if($count_food>0)
                {
                    // Food available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        // get all the value
                        $food_id=$row2['id'];
                        $food_title=$row2['title'];
                        $food_price=$row2['price'];
                        $food_description=$row2['description'];
                        $food_image_name=$row2['image_name'];

                        ?>
                            
                                            
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php
                                    // Check whether the image is available or not
                                    if($food_image_name=="")
                                    {
                                        // Display Message
                                        echo '<div class="error">Image is not available</div>';
                                    }
                                    else
                                    {
                                        // Image available
                                        ?>
                                            <img src="<?php echo SITEURL ?>images/food/<?php echo $food_image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $food_title;?></h4>
                                    <p class="food-price">$<?php echo $food_price ?></p>
                                    <p class="food-detail">
                                        <?php echo $food_description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    // Food not available
                    echo '<div class="error">Food not available</div>';
                }
            ?>

            <div class="clearfix"></div>           

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>