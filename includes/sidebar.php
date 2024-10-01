<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card mb-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form name="search" action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" style="background-color:#141738; color: white;" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php 
                $query = mysqli_query($con, "SELECT id, CategoryName FROM tblcategory");
                while ($row = mysqli_fetch_array($query)) { 
                ?>
                    <li>
                        <a href="category.php?catid=<?php echo htmlentities($row['id'])?>" class="menu-link">
                            <?php echo htmlentities($row['CategoryName']);?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Recent feeds Widget -->
    <div class="card my-4">
        <h5 class="card-header">Recent feeds</h5>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php
                $query = mysqli_query($con, "SELECT tblposts.id as pid, tblposts.PostTitle as posttitle FROM tblposts LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId LIMIT 8");
                while ($row = mysqli_fetch_array($query)) { 
                ?>
                    <li>
                        <a href="feeds-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="menu-link">
                            <?php echo htmlentities($row['posttitle']);?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Popular feeds Widget -->
    <div class="card my-4">
        <h5 class="card-header">Popular feeds</h5>
        <div class="card-body">
            <ul class="list-unstyled">
                <?php
                $query1 = mysqli_query($con, "SELECT tblposts.id as pid, tblposts.PostTitle as posttitle FROM tblposts LEFT JOIN tblcategory ON tblcategory.id=tblposts.CategoryId LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId=tblposts.SubCategoryId ORDER BY viewCounter DESC LIMIT 5");
                while ($result = mysqli_fetch_array($query1)) { 
                ?>
                    <li>
                        <a href="feeds-details.php?nid=<?php echo htmlentities($result['pid'])?>" class="menu-link">
                            <?php echo htmlentities($result['posttitle']);?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div>

<style>
    .menu-link {
        display: block;
        padding: 10px 15px;
        color: #007bff;
        text-decoration: none;
        border-radius: 4px;
    }
    
    .menu-link:hover {
        background-color: #f1f1f1;
        color: #0056b3;
    }

    .card-header {
        background-color: #141738;
        color: white;
    }

    .card {
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
