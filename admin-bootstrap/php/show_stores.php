<!DOCTYPE html>
<?php
include "../../admin-conn/db-conn.php";
include "../../admin-conn/check-session.php";

$sql = "SELECT * FROM `stores`";
$stores = mysqli_query($conn,$sql);

/*
if($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['delete'])) {
        //extract($_POST);
        $id = $_POST['id'];
        $sql_delete = "DELETE FROM `stores` WHERE `id` = $id;";
        $result = mysqli_query($conn,$sql_delete);
        if($result) {
            header('Location: show_stores.php');
        } else{
            echo "Failed : " . mysqli_error($conn);
        }
    }
}
*/

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Show Stores</title>

    
    <!-- Bootstrap CSS -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

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
                    <h2>Show Stores</h2>
                </nav>
                <!-- End of Topbar -->

                <div class="card-body table-responsive">
                    <table class="table table-hover text-center mb-3">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while($row = mysqli_fetch_assoc($stores)) {
                            ?>
                            <tr>
                                <th class="align-middle" scope="row"><?php echo $row['id']?></th>
                                <td class="align-middle">
                                    <img src="../uploads/<?php echo $row['img']?>" width="100px" height="60px">
                                </td>
                                <td class="align-middle"><?php echo $row['name']?></td>
                                <td class="align-middle"><?php echo $row['phone']?></td>
                                <td class="align-middle"><?php echo $row['address']?></td>
                                <?php
                                $sql_get_category_name = "SELECT * FROM `categories` WHERE `id` = " . $row['category'] . " LIMIT 1";
                                $category = mysqli_fetch_assoc(mysqli_query($conn,$sql_get_category_name));
                                $cname = $category['name'];
                                ?>
                                <td class="align-middle"><?=$cname?></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <div >
                                            <form class="mx-1" method="get" action="edit_store.php">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input class="btn btn-primary shadow-sm" type="submit" value="Edit">
                                            </form>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger shadow-sm" name="delete" type="button">
                                                <a class="conf_del" 
                                                style="color: white; text-decoration:none" 
                                                href="delete_stores.php?id=<?php echo $row['id']?>">
                                                Delete
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

                <?php
                if(isset($_GET['message'])) {
                ?>
                <div class="flash-data" data-flashdata="<?= $_GET['message']?>"></div>
                <?php }?>

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
 
</body>

</html>

<script>
    $(document).ready(function() {
        $('.conf_del').click(function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this store!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4e73df',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                document.location.href = href;
              }
            })   
        })
    })

    const flashdata = $('.flash-data').data('flashdata');
    if(flashdata) {
        Swal.fire({
                title: "Success!",
                text: "Your store has been deleted successfully.",
                icon: "success",
                button: "OK",
                confirmButtonColor: '#4e73df'
        });
    }    
</script>