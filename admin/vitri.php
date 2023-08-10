<?php
session_start();
include'dbconnection.php';
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
if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else{

// for deleting user
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    // Lấy tên file ảnh hiện tại từ cơ sở dữ liệu
    $query_select = mysqli_query($con, "SELECT hinhanh FROM vitri WHERE id='$id'");
    $row = mysqli_fetch_assoc($query_select);
    $hinhanh = $row['hinhanh'];

    $directoryPath='';
    $id_data='';
    $ret_vitri=mysqli_query($con,"select * from vitri where id='$id'");
    while($row_vitri=mysqli_fetch_array($ret_vitri))
    {
        $id_data=$row_vitri['id_data'];
    }
    $directoryPath = '../tiles/'.$id_data;
    // Xóa hàng dữ liệu từ bảng
    $query_delete = mysqli_query($con, "DELETE FROM vitri WHERE id='$id'");

    if ($query_delete) {
        // Xóa tệp tin hình ảnh từ thư mục uploads
        $file_path = "../listImage_small/".$hinhanh;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        deleteDirectory($directoryPath);
        $_SESSION['msg'] = "Xóa thành công";
    }

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
                        <span>Khu Vực</span>
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
            <h3><i class="fa fa-angle-right"></i> Vị trí</h3>
            <div class="row">



                <div class="col-md-12">
                    <div class="content-panel">
                        <p align="center"
                           style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                $_SESSION['msg'] = "";
                            } ?></p>
                        <table class="table table-striped table-advance table-hover">
                            <div style="display: flex"><h4><i class="fa fa-angle-right"></i> Tất cả vị trí </h4>
                                <a style="margin-left: 50px;" href="add_vitri.php">
                                    <button style="width: 30px;height: 30px;font-size: 18px" class="btn btn-success btn-xs">+
                                    </button>
                                </a></div>
                            <hr>
                            <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th class="hidden-phone">Id_DATA</th>
                                <th>Id khu vực</th>
                                <th>Tên vị trí</th>
                                <th>Hình ảnh</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $ret=mysqli_query($con,"select * from vitri");
                            $cnt=1;
                            while($row=mysqli_fetch_array($ret))
                            {?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $row['id_data'];?></td>
                                    <td><?php echo $row['id_khuvuc'];?></td>
                                    <td><?php echo $row['tenvitri'];?></td>
                                    <td><img style="width: 300px;" src="../listImage_small/<?php echo $row['hinhanh'];?>" alt=""></td>
                                    <td>
                                        <a href="update_vitri.php?uid=<?php echo $row['id'];?>">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                        <a href="vitri.php?id=<?php echo $row['id'];?>">
                                            <button class="btn btn-danger btn-xs" onClick="return confirm('Bạn có thực sự muốn xóa');"><i class="fa fa-trash-o "></i></button></a>
                                    </td>

                                </tr>
                                <?php $cnt=$cnt+1;  }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section
    ></section>
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