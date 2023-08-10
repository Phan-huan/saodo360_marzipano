<?php
session_start();
include 'dbconnection.php';
//Checking session is valid or not
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {

// for updating user info
    // Xử lý việc cập nhật thông tin người dùng
    if (isset($_POST['data'])) {
        $content = $_POST['data'];
        $file = '../data.js';

        // Ghi đè nội dung mới vào tập tin JavaScript
        file_put_contents($file, $content);
        $_SESSION['msg'] = "Sửa thành công";

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/theme/dracula.min.css">
        <link rel="stylesheet" href="../prism.css">
        <style>
            .CodeMirror {
                /* Set height, width, borders, and global font properties here */
                font-family: monospace;
                height: 70vh;

                color: black;
                direction: ltr;
            }
        </style>

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
                <h3><i class="fa fa-angle-right"></i>DATA</h3>

                <div class="row">


                    <div class="col-md-12">
                        <div class="content-panel">
                            <p align="center"
                               style="color:#F00;"><?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                } ?></p>
                            <form class="form-horizontal style-form" name="form1" method="post" action=""
                                  onSubmit="return valid();" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"
                                           style="padding-left:40px;">data.js </label>
                                    <div class="col-sm-10">

                                        <textarea type="text" name="data" id="codeTextarea" >
                                            <?php echo file_get_contents('../data.js'); ?>
                                        </textarea>


                                    </div>
                                </div>
                                <div style="margin-left:100px;">
                                    <input type="submit" name="Submit" value="Update" class="btn btn-theme"></div>
                                <div>
                                    <label class="col-sm-2 col-sm-2 control-label"
                                           style="padding-left:40px;">Hướng dẫn</label>

                                    <pre>
                                    <code class="language-javascript" >
    // sau khi tải file zip từ website công cụ của marzipano
    //=>giải nén
    //=>mở file data.js
    //copy đoạn mã tương tự như sau gán vào vị trí được hướng dẫn bên dưới (chú ý: chỉ lấy đến mảng lever thứ 4)
    //chú ý : nếu ở đầu hoặc ở cuối đoạn mã chưa có dấu ',' thì hãy thêm vào để tránh lỗi
        {
            "id": "id_data",//thay giá trị bằng id_data của bạn
            "name": "tên vị trí",//thay giá trị bằng tên vị trí của bạn
            "levels": [
                {
                    "tileSize": 256,
                    "size": 256,
                    "fallbackOnly": true
                },
                {
                    "tileSize": 512,
                    "size": 512
                },
                {
                    "tileSize": 512,
                    "size": 1024
                },
                {
                    "tileSize": 512,
                    "size": 2048
                }
            ],
            "faceSize": 2000,
            "initialViewParameters": {
                "pitch": 0,
                "yaw": 0,
                "fov": 1.5707963267948966
            },
            "linkHotspots": [
               {
                "yaw": 1.8701758928603356,
                "pitch": 0,
                "rotation": 0,
                "target": "id_data_link" //thay giá trị bằng id_data của vị trí bạn muốn dẫn tới
                },
            ],
            "infoHotspots": []
        },
//Dán tại vị trí sau ( gần dưới cùng đoạn mã )
                                    </code><img src="../img/huongdan_data.png" alt="">
                                </pre>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.0/mode/javascript/javascript.min.js"></script>
    <script src="../prism.js"></script>
    <script>
        var codeTextarea = document.getElementById("codeTextarea");
        var codeEditor = CodeMirror.fromTextArea(codeTextarea, {
            lineNumbers: true,
            mode: "javascript",
            theme: "dracula",
            height: "700"
        });
    </script>
    </body>
    </html>
<?php } ?>
