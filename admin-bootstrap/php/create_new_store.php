<?php
include "../../admin-conn/db-conn.php";
include "../../admin-conn/check-session.php";
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Create New Store</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
$sql_categories_selection = "SELECT * FROM `categories`";
$categories = mysqli_query($conn,$sql_categories_selection);
//ob_start();

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
            <li class="nav-item">
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
            <li class="nav-item active">
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
                <a class="nav-link" href="index.php">
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
                    <h2>Create New Store</h2>
                </nav>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <?php
                    if($_SERVER['REQUEST_METHOD']=='POST') {
                        if(isset($_POST['store_submit'])) {
                                    
                            if(isset($_FILES['new_store_image'])) {
                                $pic_error = $_FILES['new_store_image']['error'];
                                
                                if($pic_error !== 0) {?>
                                <div class="container-fluid">
                                    <div class="card mb-4 ml-2 border-left-danger shadow">
                                        <div class="card-body">
                                            Please select an image
                                        </div>
                                    </div>
                                </div>
                                <?php   
                                }
                            }
                               
                            if(empty($_POST['new_store_name'])) {
                    ?>
                    <!-- Danger Message -->
                    <div class="container-fluid">
                        <div class="card mb-4 ml-2 border-left-danger shadow">
                            <div class="card-body">
                                Please enter the store name
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            if(empty($_POST['new_store_phone'])) {
                    ?>
                    <div class="container-fluid">
                        <div class="card mb-4 ml-2 border-left-danger shadow">
                            <div class="card-body">
                                Please enter the store phone
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            if(empty($_POST['new_store_address'])) {
                    ?>
                    <div class="container-fluid">
                        <div class="card mb-4 ml-2 border-left-danger shadow">
                            <div class="card-body">
                                Please enter the store address
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                            if(empty($_POST['category_selection'])) {
                    ?>
                    <div class="container-fluid">
                        <div class="card mb-4 ml-2 border-left-danger shadow">
                            <div class="card-body">
                                Please select one category
                            </div>
                        </div>
                    </div>
                    <?php
                            }  
                        }
                    }
                    ?>
                    <!-- End of Danger Message -->

                    <form action="" enctype="multipart/form-data" 
                    class="d-none d-sm-block form-block mr-auto ml-md-3 my-2 my-md-0 mw-100" method="post">
                        <div class="label font-weight-bold mb-2">
                            Name
                            <input type="text" name="new_store_name" class="form-control bg-light border-1 mb-4 mt-2" 
                            placeholder="Store Name" aria-describedby="basic-addon2">
                        </div>
                        <div class="label font-weight-bold mb-2">
                            Phone
                            <input type="text" name="new_store_phone" class="form-control bg-light border-1 mb-4 mt-2" 
                            placeholder="Store Phone" aria-describedby="basic-addon2">
                        </div>
                        <div class="label font-weight-bold mb-4">
                            Address
                            <input type="text" name="new_store_address" class="form-control bg-light border-1 mb-4 mt-2" 
                            placeholder="Store Address" aria-describedby="basic-addon2">
                        </div>
                        <div class="label d-sm-block  font-weight-bold mb-4">
                            Category
                            <br>
                            <select class="form-control bg-light border-1 mb-4 mt-2" name="category_selection">
                                <option disabled selected>Select Category</option>
                                <?php
                                while($row = mysqli_fetch_assoc($categories)) {
                                ?>
                                <option><?php echo $row['name']?></option>
                                <?php
                                }?>
                            </select>
                        </div>
                        <div class="label font-weight-bold mb-4">
                            Picture
                            <input type="file" accept="image/*" name="new_store_image" class="form-control bg-light border-1 mb-4 mt-2" 
                            placeholder="Store Address" aria-describedby="basic-addon2">
                        </div>
                        <button type="submit" name="store_submit" class="btn btn-primary shadow-sm">
                            Add Store
                        </button>
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
if(isset($_POST['store_submit'])) {
    if(
        !empty($_POST['new_store_name']) && !empty($_POST['new_store_phone']) && 
        !empty($_POST['new_store_address']) && !empty($_POST['category_selection'])
        ) {
            
            if(isset($_FILES['new_store_image'])) {
                $pic_name = $_FILES['new_store_image']['name'];
                $pic_tmp_name = $_FILES['new_store_image']['tmp_name'];
                $pic_size = $_FILES['new_store_image']['size'];
                
                if($pic_error === 0) {
                    //pic extension
                    $pic_ex = strtolower(pathinfo($pic_name,PATHINFO_EXTENSION));
                    //new name so it will be unique
                    $new_img_name = uniqid('IMG-',true).'.'.$pic_ex;
                    //upload path
                    $upload_path = "../uploads/".$new_img_name;
                    move_uploaded_file($pic_tmp_name,$upload_path);
            
                    $store_name = $_POST['new_store_name'];
                    $store_phone = $_POST['new_store_phone'];
                    $store_address = $_POST['new_store_address'];
                    $selected_category = $_POST['category_selection'];

                    $s = mysqli_query($conn,"SELECT * FROM `categories`");
                    while($cat = mysqli_fetch_assoc($s)) {
                        if($cat['name']==$selected_category) {
                            $selected_category = $cat['id'];
                            break;
                        }
                    }
                    
                    //Add to Db
                    $sql_add_store = "INSERT INTO `stores`(`name`, `phone`, `address`, `category`, `img`) 
                    VALUES ('$store_name','$store_phone','$store_address','$selected_category','$new_img_name')";
                    $r = mysqli_query($conn,$sql_add_store);
                    if($r) {
                        //ob_end_clean();
                        //header('Location: show_stores.php');?>
                        <script>
                            new swal({
                                title: "Success!",
                                text: "Your store has been added successfully.",
                                icon: "success",
                                button: "OK",
                                confirmButtonColor: '#4e73df'
                            });
                        </script>
                    <?php
                    }
                }
            }
        }
}

?>

</body>

</html>

