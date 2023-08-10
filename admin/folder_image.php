<?php
session_start();
include 'dbconnection.php';

function deleteDirectory($directoryPath) {
    if (!is_dir($directoryPath)) {
        return;
    }

    $files = scandir($directoryPath);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $directoryPath . '/' . $file;
        if (is_dir($filePath)) {
            deleteDirectory($filePath); // Gọi đệ quy để xóa thư mục con
        } else {
            unlink($filePath); // Xóa tệp trong thư mục
        }
    }

    rmdir($directoryPath); // Xóa thư mục chính
}

// checking session is valid for not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else{
if (isset($_GET['dname'])) {
    $dname = $_GET['dname'];
    $directoryPath = '../tiles/'.$dname;
    deleteDirectory($directoryPath);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Manage Users</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>

<body>

<section id="container">
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <a href="#" class="logo"><b>Admin Dashboard</b></a>
        <div class="nav notify-row" id="top_menu">


            </ul>
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><?php echo $_SESSION['login']; ?></h5>

                <li class="mt">
                    <a href="change-password.php">
                        <i class="fa fa-file"></i>
                        <span>Đổi mật khẩu</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="khuvuc.php">
                        <i class="fa fa-users"></i>
                        <span>Khu vực</span>
                    </a>

                </li>

                <li class="sub-menu">
                    <a href="vitri.php">
                        <i class="fa fa-users"></i>
                        <span>Vị trí</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="hotspot.php">
                        <i class="fa fa-users"></i>
                        <span>Điểm nóng</span>
                    </a>

                </li>

                <li class="sub-menu">
                    <a href="folder_image.php">
                        <i class="fa fa-users"></i>
                        <span>Thư mục ảnh</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="update_data.php">
                        <i class="fa fa-users"></i>
                        <span>DATA</span>
                    </a>
                </li>


            </ul>
        </div>
    </aside>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i>Thư mục</h3>
            <div class="row">


                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <div style="display: flex"><h4><i class="fa fa-angle-right"></i> Tất cả thư mục</h4>
                                </div>

                            <hr>
                            <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tên thư mục ảnh</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $parentDirectory = '../tiles/';

                            // Lấy tất cả các phần tử trong thư mục
                            $elements = scandir($parentDirectory);

                            // Lọc ra chỉ các thư mục con
                            $subDirectories = [];
                            foreach ($elements as $element) {
                                $path = $parentDirectory . '/' . $element;
                                if (is_dir($path) && $element != '.' && $element != '..') {
                                    $subDirectories[] = $element;
                                }
                            }
                            $cnt=1;
                            // In tên các thư mục con
                            foreach ($subDirectories as $subDirectory) {
                                ?>

                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $subDirectory; ?></td>

                                    <td>

                                        <a href="update_folder_image.php?uname=<?php echo $subDirectory; ?>">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <a href="folder_image.php?dname=<?php echo $subDirectory; ?>">
                                            <button class="btn btn-danger btn-xs"
                                                    onClick="return confirm('Bạn có thực sự muốn xóa');"><i
                                                    class="fa fa-trash-o "></i></button>
                                        </a>
                                    </td>
                                </tr>
                                <?php $cnt=$cnt+1;} ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/common-scripts.js"></script>
<script>
    $(function () {
        $('select.styled').customSelect();
    });

</script>

</body>
</html>
<?php } ?>