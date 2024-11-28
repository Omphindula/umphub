<div class="col-md-4">

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header" style="float:right; box-sizing:content-box;">
            <a class="d-block" data-bs-toggle="collapse" href="#categoriesWidget" role="button" aria-expanded="false" aria-controls="categoriesWidget" style="text-decoration: none; color: inherit;">
                Categories
            </a>
        </h5>
        <div id="categoriesWidget" class="collapse">
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
    </div>

    <!-- Collapsible Calendar Widget with Link -->
    <div class="card my-4">
        <h5 class="card-header" style="cursor: pointer;">
            <a class="d-block" data-bs-toggle="collapse" href="#calendarWidget" role="button" aria-expanded="false" aria-controls="calendarWidget" style="text-decoration: none; color: inherit;">
                Calendar
            </a>
        </h5>
        <div id="calendarWidget" class="collapse">
            <div class="card-body">
                <!-- Redirect link to detailed events page -->
                <a href="calendar.php" class="btn btn-primary w-100 mb-3">Go to Calendar</a>
            </div>
        </div>
    </div>

    <!-- Recent feeds Widget -->
    <div class="card my-4">
        <h5 class="card-header">
            <a class="d-block" data-bs-toggle="collapse" href="#recentFeeds" role="button" aria-expanded="false" aria-controls="recentFeeds" style="text-decoration: none; color: inherit;">
                Recent feeds
            </a>
        </h5>
        <div id="recentFeeds" class="collapse">
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
    </div>

    <!-- Popular feeds Widget -->
    <div class="card my-4">
        <h5 class="card-header">
            <a class="d-block" data-bs-toggle="collapse" href="#popularFeeds" role="button" aria-expanded="false" aria-controls="popularFeeds" style="text-decoration: none; color: inherit;">
                Popular feeds
            </a>
        </h5>
        <div id="popularFeeds" class="collapse">
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
        float: right;
    }

    .card {
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Style for the "Go to Calendar" button */
    .btn-primary {
        background-color: #007bff;
        border: none;
        text-align: center;
        padding: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Adding a cursor to indicate the header is clickable */
    .card-header {
        cursor: pointer;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
