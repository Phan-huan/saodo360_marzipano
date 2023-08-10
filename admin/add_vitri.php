<?php
session_start();
include 'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    $_SESSION['msg'] = "  ";
// for updating user info
    if (isset($_POST['Submit'])) {
        if (
            isset($_POST["id_data"]) &&
            isset($_POST["id_khuvuc"]) &&
            isset($_POST["tenvitri"]) &&
            isset($_FILES["hinhanh"]) &&
            isset($_FILES["file"])
        ) {

            // Lấy dữ liệu từ các trường form
            $id_data = $_POST["id_data"];
            $id_khuvuc = $_POST["id_khuvuc"];
            $tenvitri = $_POST["tenvitri"];
            $hinhanh = $_FILES['hinhanh']['name']; // Tên tập tin hình ảnh
            $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"]; // Đường dẫn tạm thời của tập tin

            // Tải lên và giải nén thư mục ảnh đã xử lý
            $file = $_FILES['file'];
            $extractDir = '../tiles/';
            $newFolderName = $id_data;
            // Tạo thư mục mới
            $newFolderPath = $extractDir . $newFolderName;
            if (!file_exists($newFolderPath)) {
                if (mkdir($newFolderPath, 0777, true)) {
                    $_SESSION['msg']= 'Thư mục mới đã được tạo thành công.';
                    // Kiểm tra lỗi trong quá trình tải lên
                    if ($file['error'] === UPLOAD_ERR_OK) {
                        $fileName = basename($file['name']);
                        $extractPath = $newFolderPath . '/';
                        // Di chuyển file tải lên vào thư mục lưu trữ
                        if (move_uploaded_file($file['tmp_name'], $newFolderPath . '/' . $fileName)) {
                            // Kiểm tra phần mở rộng của file để quyết định sử dụng thư viện nén nào
                            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                            if ($fileExtension === 'rar') {
                                // Giải nén file RAR
                                $rarArchive = RarArchive::open($newFolderPath . '/' . $fileName);
                                if ($rarArchive !== false) {
                                    $rarArchive->extract($extractPath);
                                    $rarArchive->close();


                                    // Chuẩn bị truy vấn SQL để thêm dữ liệu vào bảng
                                    $query = mysqli_query($con, "INSERT INTO vitri(id_data, id_khuvuc, tenvitri, hinhanh) 
                VALUES ('$id_data', '$id_khuvuc', '$tenvitri', '$hinhanh')");
// Thực hiện lưu hình ảnh vào thư mục mong muốn
                                    move_uploaded_file($hinhanh_tmp, "../listImage_small/" . $hinhanh);
                                    $_SESSION['msg'] = "Thêm thành công";
                                    //xóa file zip
                                    unlink('../tiles/'.$id_data.'/'.$fileName);


                                } else {
                                    $_SESSION['msg']= 'Không thể mở file RAR.';
                                }
                            } elseif ($fileExtension === 'zip') {
                                // Giải nén file ZIP
                                $zipArchive = new ZipArchive();
                                if ($zipArchive->open($newFolderPath . '/' . $fileName) === true) {
                                    $zipArchive->extractTo($extractPath);
                                    $zipArchive->close();


                                    // Chuẩn bị truy vấn SQL để thêm dữ liệu vào bảng
                                    $query = mysqli_query($con, "INSERT INTO vitri(id_data, id_khuvuc, tenvitri, hinhanh) 
                VALUES ('$id_data', '$id_khuvuc', '$tenvitri', '$hinhanh')");
// Thực hiện lưu hình ảnh vào thư mục mong muốn
                                    move_uploaded_file($hinhanh_tmp, "../listImage_small/" . $hinhanh);
                                    $_SESSION['msg'] = "Thêm thành công";

                                    //xóa file zip
                                    unlink('../tiles/'.$id_data.'/'.$fileName);


                                } else {
                                    $_SESSION['msg']= 'Không thể mở file ZIP.';
                                }
                            } else {
                                $_SESSION['msg']= 'Định dạng file không được hỗ trợ.';
                            }
                        } else {
                            $_SESSION['msg']= 'Không thể di chuyển file tải lên.';
                        }
                    } else {
                        $_SESSION['msg']= 'Có lỗi xảy ra trong quá trình tải lên file.';
                    }

                } else {
                    $_SESSION['msg']= 'Không thể tạo thư mục mới.';
                }
            } else {
                $_SESSION['msg']= 'Thư mục đã tồn tại.';
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


                    <div class="col-md-12">
                        <div class="content-panel">
                            <p align="center"
                               style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                } ?></p>
                            <form class="form-horizontal style-form" name="form1" method="post" action=""
                                  enctype="multipart/form-data"
                                  onSubmit="return valid();">
                                <p style="color:#F00"></p>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Id
                                        data</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="id_data">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Khu
                                        vực</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="id_khuvuc" id="">
                                            <?php
                                            $ret_khuvuc = mysqli_query($con, "select * from khuvuc");
                                            while ($row_khuvuc = mysqli_fetch_array($ret_khuvuc)) {
                                                ?>
                                                <option value="<?php echo $row_khuvuc['id'] ?>"><?php echo $row_khuvuc['tenkhuvuc'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Tên vị
                                        trí</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tenvitri">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Hình
                                        ảnh</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="hinhanh" id="hinhanh">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">File ảnh
                                        đã được xử lý</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file" id="file">
                                    </div>
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
