<?php
session_start();
include'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else{

// for updating user info
    // Xử lý việc cập nhật thông tin người dùng
    if (isset($_POST['Submit'])) {
        // Lấy dữ liệu từ các trường form
        $id_data = $_POST["id_data"];
        $id_khuvuc = $_POST["id_khuvuc"];
        $tenvitri = $_POST["tenvitri"];
        $hinhanh = $_FILES['hinhanh']['name']; // Tên tập tin hình ảnh
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"]; // Đường dẫn tạm thời của tập tin

        $uid = intval($_GET['uid']);

        $oldDirectoryName='';
        //lấy giữ liệu
        $ret_vitri=mysqli_query($con,"select * from vitri where id='".$_GET['uid']."'");
        while($row_vitri=mysqli_fetch_array($ret_vitri))
        {
            $oldDirectoryName = '../tiles/'.$row_vitri['id_data'];
        }

        $newDirectoryName = '../tiles/'.$id_data;
        rename($oldDirectoryName, $newDirectoryName);


        // Kiểm tra xem người dùng đã chọn một tập tin hình ảnh mới hay chưa
        if (!empty($hinhanh)) {
            // Thực hiện lưu hình ảnh vào thư mục mong muốn
            move_uploaded_file($hinhanh_tmp, "../listImage_small/" . $hinhanh);
            // Chuẩn bị truy vấn SQL để cập nhật dữ liệu trong bảng
            $query = mysqli_query($con, "UPDATE vitri SET id_data='$id_data', id_khuvuc='$id_khuvuc', tenvitri='$tenvitri', hinhanh='$hinhanh' WHERE id='$uid'");
        }else
        {
            $query = mysqli_query($con, "UPDATE vitri SET id_data='$id_data', id_khuvuc='$id_khuvuc', tenvitri='$tenvitri' WHERE id='$uid'");
        }



        if ($query) {
            $_SESSION['msg'] = "Cập nhật thành công";
        } else {
            $_SESSION['msg'] = "Lỗi: " . mysqli_error($con);
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
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
    </head>

    <body>

    <section id="container" >
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
            <div id="sidebar"  class="nav-collapse ">
                <ul class="sidebar-menu" id="nav-accordion">

                    <p class="centered"><a href="#"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                    <h5 class="centered"><?php echo $_SESSION['login'];?></h5>

                    <li class="mt">
                        <a href="change-password.php">
                            <i class="fa fa-file"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="khuvuc.php" >
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
        <?php $ret_vitri=mysqli_query($con,"select * from vitri where id='".$_GET['uid']."'");
        while($row_vitri=mysqli_fetch_array($ret_vitri))

        {?>
        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-angle-right"></i> <?php echo $row_vitri['tenvitri'];?></h3>

                <div class="row">



                    <div class="col-md-12">
                        <div class="content-panel">
                            <p align="center" style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                } ?></p>
                            <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();" enctype="multipart/form-data">
                                <p style="color:#F00"><?php if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        $_SESSION['msg'] = "";
                                    } ?></p>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Id DATA</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="id_data" value="<?php echo $row_vitri['id_data'];?>" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Khu vực</label>
                                    <div class="col-sm-10">

                                        <select name="id_khuvuc" id="" >
                                        <?php
                                        $ret_khuvuc=mysqli_query($con,"select * from khuvuc");
                                        while($row_khuvuc=mysqli_fetch_array($ret_khuvuc)){
                                        ?>
                                            <option value="<?php echo $row_khuvuc['id'] ?>" <?php if ($row_khuvuc['id']==$row_vitri['id_khuvuc']){echo "selected";} ?>><?php echo $row_khuvuc['tenkhuvuc']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Tên vị trí </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tenvitri" value="<?php echo $row_vitri['tenvitri'];?>"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Hình ảnh</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="hinhanh" value="<?php echo $row_vitri['hinhanh'];?>"  >
                                    </div>
                                </div>

                                <div style="margin-left:100px;">
                                    <input type="submit" name="Submit" value="Update" class="btn btn-theme"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--VỊ trí-->
            <section id="main-content">
                <section class="wrapper">
                    <h3><i class="fa fa-angle-right"></i>Hotsposts</h3>
                    <div class="row">


                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> Tất cả hotspost tại <span style="color: #66afe9"><?php echo $row_vitri['tenvitri']; ?></span>  </h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Id DATA</th>
                                        <th>Id khu vực</th>
                                        <th>Tên vị trí</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $ret_vitri = mysqli_query($con, "select * from vitri where vitri.id_khuvuc='" . $_GET['uid'] . "'");
                                    $cnt=1;
                                    while ($row_vitri = mysqli_fetch_array($ret_vitri)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row_vitri['id_data']; ?></td>
                                            <td><?php echo $row_vitri['id_khuvuc']; ?></td>
                                            <td><?php echo $row_vitri['tenvitri']; ?></td>

                                            <td>

                                                <a href="update_vitri.php?uid=<?php echo $row_vitri['id']; ?>">
                                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <a href="update_khuvuc.php?uid=<?php echo $row_khuvuc['id']; ?>&id=<?php echo $row_vitri['id'] ?>">
                                                    <button class="btn btn-danger btn-xs"
                                                            onClick="return confirm('Bạn có thực sự muốn xóa');"><i
                                                                class="fa fa-trash-o "></i></button>
                                                </a>

                                            </td>

                                        </tr>
                                        <?php $cnt=$cnt+1; } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

            <?php } ?>
        </section></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
    <script>
        $(function(){
            $('select.styled').customSelect();
        });

    </script>

    </body>
    </html>
<?php } ?>
