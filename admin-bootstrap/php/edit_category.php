<!DOCTYPE html>
<?php
include "../../admin-conn/db-conn.php";
include "../../admin-conn/check-session.php";

$id = $_GET['id'];
$sql_get_category = "SELECT * FROM `categories` WHERE `id` = $id";
$category = mysqli_fetch_assoc(mysqli_query($conn,$sql_get_category));

//ob_start();
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Update Category</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
$categories_selection_sql = "SELECT * FROM categories";
$categories_result = mysqli_query($conn,$categories_selection_sql);
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Categories Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="create_new_category.php">Create New Category</a>
                        <a class="collapse-item" href="show_categories.php">Show Categories</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Stores Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Stores</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="create_new_store.php">Create New Store</a>
                        <a class="collapse-item" href="show_stores.php">Show Stores</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Ratings -->
            <li class="nav-item">
                <a class="nav-link" href="ratings.php">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Ratings</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Search -->
                    <h2>Update Category</h2>
                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <?php
                        if(isset($_POST['categoty_submit'])) {
                            if(empty($_POST['new_category'])) {
                    ?>
                    <!-- Danger Message -->
                    <div class="card mb-4 ml-2 border-left-danger shadow">
                        <div class="card-body">
                            Please enter the category name
                        </div>
                    </div>
                </div>
                <!-- End of Danger Message -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        } else {
                            $name = $_POST['new_category'];
                            $isAlreadyExisted = false;
                            while($cat = mysqli_fetch_assoc($categories_result)) {
                                if($cat['name'] == $name) {
                                    $isAlreadyExisted = true;?> 
                                    
                                    <div class="container-fluid">
                                        <!-- Danger Message -->
                                        <div class="card mb-4 ml-2 border-left-danger shadow">
                                            <div class="card-body">
                                                Category entered is already existed
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    break;
                                }
                            } 
                        }
                    }
                    ?>
                    <form class="d-none d-sm-block form-block mr-auto ml-md-3 my-2 my-md-0 mw-100" 
                    method="post" action="">
                        <div class="label font-weight-bold mb-2">
                            Category Name
                            <input id="cat_name" type="text" name="new_category" class="form-control bg-light border-1 mb-4 mt-2" 
                            placeholder="Update Category" value="<?=$category['name']?>" aria-describedby="basic-addon2">
                        </div>
                        <input type="submit" name="categoty_submit" class="btn btn-primary shadow-sm" value="Update Category">
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Sweet Alert -->
    <script src="../js/sweetalert2.all.min.js"></script>

    <?php
    if(isset($_POST['categoty_submit']) && !$isAlreadyExisted && !empty($_POST['new_category'])){
        $name = $_POST['new_category'];
        $sql = "UPDATE `categories` SET `name` = '$name' WHERE `id`=$id";
        $r = mysqli_query($conn,$sql);
        if($r){
            //ob_end_clean();
            //header('Location: show_categories.php');?>
        <script>
            new swal({
                title: "Success!",
                text: "Your category has been updated successfully.",
                icon: "success",
                button: "OK",
                confirmButtonColor: '#4e73df'
            });
            document.getElementById("cat_name").value = "";
        </script>
        
        <?php
        }    
    }
    
    ?>
</body>
</html>

