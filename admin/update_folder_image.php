<?php
session_start();
include 'dbconnection.php';
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return;
    }

    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        if (is_dir("$dir/$file")) {
            deleteDirectory("$dir/$file");
        } else {
            unlink("$dir/$file");
        }
    }

    rmdir($dir);
}
//Checking session is valid or not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['uname'])) {
        if (isset($_POST['Submit'])) {
            $dname = $_GET['uname'];
            $file=$_FILES['file'];
            $directory = '../tiles/'.$dname;
            deleteDirectory($directory);
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploadedFile = $_FILES['file']['tmp_name'];

                // Kiểm tra định dạng tệp tin
                $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if ($fileExtension === 'rar') {
                    // Giải nén tệp tin RAR
                    $rarArchive = new RarArchive();
                    $rarArchive->open($uploadedFile);
                    $entries = $rarArchive->getEntries();
                    foreach ($entries as $entry) {
                        $entry->extract($directory);
                    }
                    $rarArchive->close();
                } elseif ($fileExtension === 'zip') {
                    // Giải nén tệp tin ZIP
                    $zipArchive = new ZipArchive();
                    $zipArchive->open($uploadedFile);
                    $zipArchive->extractTo($directory);
                    $zipArchive->close();
                }
                unlink($uploadedFile);
                $_SESSION['msg'] = "Profile Updated successfully";
            } else {
                echo 'Có lỗi xảy ra trong quá trình tải lên tệp tin.';
            }
        }
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
        <?php $ret = mysqli_query($con, "select * from vitri where id_data='" . $_GET['uname'] . "'");

        while ($row = mysqli_fetch_array($ret))

        {
        ?>
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> Thư mục của <span style="color: #66afe9"><?php echo $row['tenvitri']; ?></span> </h3>

                <div class="row">


                    <div class="col-md-12">
                        <div class="content-panel">
                            <p align="center"
                               style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                } ?></p>
                            <form class="form-horizontal style-form" name="form1" method="post" action=""
                                  onSubmit="return valid();" enctype="multipart/form-data">
                                <p style="color:#F00"><?php if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        $_SESSION['msg'] = "";
                                    } ?></p>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Tên thư mục</label>
                                    <div class="col-sm-10">
                                        <input type="text"  style="text-transform: uppercase;" class="form-control" name="tenthumuc"
                                               value="<?php echo $row['id_data']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">File ảnh đã xử lý</label>
                                    <div class="col-sm-10">
                                        <input type="file"  style="text-transform: uppercase;" class="form-control" name="file">
                                    </div>
                                </div>
                                <div style="margin-left:100px;">
                                    <input type="submit" name="Submit" value="Update" class="btn btn-theme"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <?php } ?>

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