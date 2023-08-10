<?php
session_start();
include 'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

// for updating user info
    if (isset($_POST['Submit'])) {
        $tenkhuvuc = $_POST['tenkhuvuc'];
        $tenkhuvuc = mb_strtoupper($tenkhuvuc, 'UTF-8');
        $query = mysqli_query($con, "INSERT INTO khuvuc(tenkhuvuc) VALUE('" . $tenkhuvuc . "')");
        $_SESSION['msg'] = "Thêm thành công";
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Admin | Update Profile</title>
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

                    <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a>
                    </p>
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


                <div class="row">

                    <h3><i class="fa fa-angle-right"></i> Thêm khu vực</h3>
                    <div class="col-md-12">
                        <div class="content-panel">
                            <p align="center"
                               style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                } ?></p>
                            <form class="form-horizontal style-form" name="form1" method="post" action=""
                                  onSubmit="return valid();">
                                <p style="color:#F00"></p>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Tên khu
                                        vực</label>
                                    <div class="col-sm-10">
                                        <input type="text" style="text-transform: uppercase;" class="form-control"
                                               name="tenkhuvuc">
                                    </div>
                                </div>
                                <div style="margin-left:100px;">
                                    <input type="submit" name="Submit" value="add" class="btn btn-theme"></div>
                            </form>
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
