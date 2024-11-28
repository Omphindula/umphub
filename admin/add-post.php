<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
    header('location:index.php');
}
else{

// For adding post  
if(isset($_POST['submit'])){
    $posttitle = $_POST['posttitle'];
    $catid = $_POST['category'];
    $subcatid = $_POST['subcategory'];
    $postdetails = addslashes($_POST['postdescription']);
    $postedby = $_SESSION['login'];
    $arr = explode(" ", $posttitle);
    $url = implode("-", $arr);
    $imgfile = $_FILES["postimage"]["name"];

    // Capture the scheduled time from the form
    $scheduledtime = $_POST['scheduledtime']; // Format: YYYY-MM-DDTHH:MM

    // Convert the datetime format to a MySQL compatible format (YYYY-MM-DD HH:MM:SS)
    $scheduledtime = date('Y-m-d H:i:s', strtotime($scheduledtime));

    // Image validation
    $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
    if(!in_array($extension, $allowed_extensions)){
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        // Rename the image file
        $imgnewfile = md5($imgfile) . $extension;
        
        // Move the uploaded image into the directory
        move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

        // Set status as inactive initially
        $status = 0;
        $query = mysqli_query($con, "INSERT INTO tblposts(PostTitle, CategoryId, SubCategoryId, PostDetails, PostUrl, Is_Active, PostImage, postedBy, ScheduledTime) 
            VALUES('$posttitle', '$catid', '$subcatid', '$postdetails', '$url', '$status', '$imgnewfile', '$postedby', '$scheduledtime')");
        
        if($query) {
            $msg = "Post successfully added and scheduled.";
        } else {
            $error = "Something went wrong. Please try again.";    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>UMPHub | Add Post</title>

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>
</head>

<body class="fixed-left">

    <div id="wrapper">
        <?php include('includes/topheader.php');?>
        <?php include('includes/leftsidebar.php');?>

        <div class="content-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Add Post </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li><a href="#">Post</a></li>
                                    <li><a href="#">Add Post </a></li>
                                    <li class="active">Add Post</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Success Message -->
                            <?php if($msg){ ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                            </div>
                            <?php } ?>
                            <!-- Error Message -->
                            <?php if($error){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <form name="addpost" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-b-20">
                                        <label for="posttitle">Post Title</label>
                                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="Enter title" required>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="category">Category</label>
                                        <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                            <option value="">Select Category </option>
                                            <?php
                                            // Fetch active categories
                                            $ret=mysqli_query($con,"SELECT id, CategoryName FROM tblcategory WHERE Is_Active=1");
                                            while($result=mysqli_fetch_array($ret)) {    
                                            ?>
                                            <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="subcategory">Sub Category</label>
                                        <select class="form-control" name="subcategory" id="subcategory" required></select> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                <textarea class="summernote" name="postdescription" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                <input type="file" class="form-control" id="postimage" name="postimage" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label for="scheduledtime">Scheduled Time</label>
                                        <input type="datetime-local" class="form-control" id="scheduledtime" name="scheduledtime" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save and Post</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                </form>
                            </div>
                        </div> <!-- end p-20 -->
                    </div> <!-- end col -->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->

        <?php include('includes/footer.php');?>
    </div> <!-- wrapper -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
    <script src="../plugins/summernote/summernote.min.js"></script>

    <script>
        jQuery(document).ready(function(){
            $('.summernote').summernote({
                height: 240,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
        });
    </script>

</body>
</html>

<?php } ?>
