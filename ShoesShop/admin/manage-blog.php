<?php
session_start();
error_reporting(0);
include 'include/dbconnection.php';
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if (isset($_GET['del'])) {
    $id = $_GET['id'];
    echo $id;
	mysqli_query($con, "DELETE FROM blog WHERE id=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: manage-blog.php');
}
       
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin|Manage Blogs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/welcome.css">
     <link rel="shortcut icon" type="image/png" href="../image-page/logo2.PNG">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php include "include/header.php" ?>

    <div class="container">
        <div class="row">
            <?php include 'include/sidebar.php';?>
            <div class="col-md-9">
                <div class="module-head">
                    <h3>Manage Blogs</h3>
                </div>
                <div class="module-body table">
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0"
                        class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $query=mysqli_query($con,"SELECT * FROM `blog` ORDER BY id DESC");
                            $cnt=1;
                            while($row=mysqli_fetch_array($query))
                            {
                            ?>
                            <tr>
                                <td>
                                    <?php echo htmlentities($cnt);?>
                                </td>
                                <td>
                                    <?php echo htmlentities($row['title']);?>
                                </td>
                                <td>
                                    <?php echo htmlentities($row['description']);?>
                                </td>
                                <td>
                                    <img src="../image-blog/<?php 
						                if ($row["image"]<>"") {
							                echo $row["image"];
						                } else {
							                echo "no_image.png";
						                }
					                ;?>" width="100px" height="auto">
                                </td>
                                <td>
                                    <?php echo htmlentities($row['note']);?>
                                </td>
                                <td>
                                    <a href="edit-blog.php?quanly=edit&id=<?php echo $row['id']?>"><i
                                            class="fa fa-edit" aria-hidden="true"></i> </a>
                                    <a href="manage-blog.php?&del=delete&id=<?php echo $row['id']?>"
                                        onClick="return confirm('Are you sure you want to delete?')"><i
                                            class="fa fa-remove" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php $cnt=$cnt+1; } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php } ?>