<?php
include 'admin/dbconnection.php';

?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>TRƯỜNG ĐẠI HỌC SAO ĐỎ</title>
    <meta charset="utf-8">
    
    <meta name="viewport"
          content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui"/>

    <link rel="stylesheet" href="vendor/reset.min.css">
    <link rel="stylesheet" href="style.css">
    <!--    bootstrap-->
    <!--     Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--    font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!--    jquery-->
    <script src="jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!--    carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
          integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
            integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body class="multiple-scenes ">
<div id="loading" class="fullwrapper preloading">
    <div id="preload" class="preload-container"
         style="display: table-cell; vertical-align: middle; text-align: center; color: white; font-size: 30px; padding: 50px;">
        <img style="height: 300px;margin-top: 5%" src="img/logoSaodo.png" alt="">
        <div class="spinner-2"></div>
    </div>
</div>

<div id="pano"></div>
<div class="layout" style="position: absolute;">
    <div class="sidenav">
        <div class="menu">
            <button style="z-index: 2;margin-top: 9vh;position: absolute;width:40px; height: 70px;border-bottom-right-radius:70px;border-top-right-radius:70px;background-color: gray;border: 1.5px solid white"
                    class="" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" id="sidebarCollapse"><i
                        class="fa-solid fa-angles-right rotate" id="iconSideNav"
                        style="color: white;font-size: 18px"></i>
            </button>

            <div style="background-color: transparent;z-index: 1;height: 80%;margin-top: 5vh;border-radius: 30px;border: 1.5px solid white"
                 class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                 id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header"
                     style="height: 130px;display: flex;background-color: gray;border-top-left-radius: 27px;border-top-right-radius: 27px">
                    <img src="./img/logoSaodo.png" alt="" style="height: 100%;margin-left: 30px;">
                    <div class="" style="text-align: center;margin-right: 30px;">
                        <p style="font-size: 40px;font-weight: bold;color: #c21111;line-height: 20px;letter-spacing: 10px">
                            SAODO <br><span
                                    style="font-size: 15px;font-weight: bold;letter-spacing: 4px">UNIVERSITY</span></p>
                    </div>
                </div>
                <div class="offcanvas-body" id="sceneList"
                     style="border-bottom-right-radius: 30px;border-bottom-left-radius:30px;background-color: rgba(255,255,255,0.7);;overflow: hidden;">
                    <div class="ul scrollbar scenes" id="style-4" role="group" aria-label="Basic radio"
                         style="overflow-y: scroll;height: 100%;">
                        <?php
                        $ret = mysqli_query($con, "select * from khuvuc");
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>

                            <div class="mainMenu" style="background-color: #b60000;width: 100%;height: 35px;text-align: left;">
                                <p class="text_mainMenu"><?php echo $row['tenkhuvuc'] ?></p>
                            </div>

                            <?php
                            $ret_vitri = mysqli_query($con, "select * from vitri where vitri.id_khuvuc='" . $row['id'] . "'");
                            while ($row_vitri = mysqli_fetch_array($ret_vitri)) {
                                ?>

                                <a href="javascript:void(0)" class="scene" data-id="<?php echo $row_vitri['id_data'] ?>"
                                   id="<?php echo $row_vitri['id_data'] ?>">
                                    <li class="text"> <?php echo $row_vitri['tenvitri']; ?> </li>
                                </a>

                                <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="map">
            <div style="width: 35vw;height: 50vh" class="offcanvas offcanvas-end"
                 data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling1"
                 aria-labelledby="offcanvasScrollingLabel">
                <iframe class="iframeMap"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3129.889067409314!2d106.39482492310081!3d21.10912338346499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31357909df4b3bff%3A0xd8784721e55d91ca!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBTYW8gxJDhu48!5e0!3m2!1svi!2s!4v1667893798451!5m2!1svi!2s"
                        style="border:3px solid red;height: 50vh;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                <button style="position: absolute;top: 5px;left: 5px;background-color: gray;opacity: 1;" type="button"
                        class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
        </div>

        <div class="listImage" id="sceneList1">
            <div style="z-index: 0;background-color: rgba(86,85,85,0.7);height: 170px;" class="offcanvas offcanvas-bottom"
                 data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling2"
                 aria-labelledby="offcanvasScrollingLabel">
                <div class="owl-carousel">

                    <?php
                    $ret_vitri = mysqli_query($con, "select * from vitri");
                    while ($row_vitri = mysqli_fetch_array($ret_vitri)) {
                    ?>

                    <div class="item" onclick="document.getElementById('<?php echo $row_vitri['id_data'] ?>').click()">
                        <img src="listImage_small/<?php echo $row_vitri['hinhanh'] ?>" alt="image" loading="lazy"/>
                        <div class="text">
                            <?php echo $row_vitri['tenvitri'] ?>
                        </div>
                    </div>

                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="menu-bottom" style="width: 100vw;height: 43px;background-color: rgba(86,85,85,0.7);;position: fixed;bottom: 0;">
    <div class="content" style="margin-top: 2px;display: flex;justify-content: center">
        <button style="height: 37px; width: 40px;margin-left: 20px;border: 1px solid white;color: white" data-bs-placement="top"
                class="btn  tooltipa"
                type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling1"
                aria-controls="offcanvasScrolling1">
            <i class="fa-solid fa-location-dot"></i>
            <span class="tooltiptext">Vị trí</span>
        </button>
        <button style="height: 37px; width: 40px;margin-left: 20px; border:1px solid white ;color: white" data-bs-placement="top"
                class="btn  tooltipa" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling2"
                aria-controls="offcanvasScrolling1">
            <i class="fa-sharp fa-solid fa-images"></i>
            <span class="tooltiptext">Danh sách ảnh</span>
        </button>

        <a type="button" href="javascript:void(0)" id="autorotateToggle">
            <button style="height: 37px; width: 40px;margin-left: 20px;border:1px solid white;color: white"
                    data-bs-placement="top"
                    class="btn  tooltipa icon off" type="button">
                <i class="fa-solid fa-play"></i>
                <span class="tooltiptext">Quay</span>
            </button>

            <button style="height: 37px; width: 40px;margin-left: 20px; border:1px solid white;color: white"
                    data-bs-placement="top"
                    class="btn  tooltipa icon on" type="button">
                <i class="fa-solid fa-pause "></i>
                <span class="tooltiptext">Dừng quay</span>
            </button>
        </a>

        <a type="button" href="javascript:void(0)"  id="fullscreenToggle">
            <button style="height: 37px; width: 40px;margin-left: 20px;border:1px solid white;color: white"
                    data-bs-placement="top"
                    class="btn  tooltipa icon off" type="button">
                <i class="fa-solid fa-expand"></i>
                <span class="tooltiptext">Toàn màn hình</span>
            </button>

            <button style="height: 37px; width: 40px;margin-left: 20px; border:1px solid white;color: white"
                    data-bs-placement="top"
                    class="btn  tooltipa icon on" type="button">
                <i class="fa-solid fa-compress"></i>
                <span class="tooltiptext">Thu màn hình</span>
            </button>
        </a>
    </div>
</div>
</div>

<div id="titleBar">
    <h1 style="margin-top: 30px;" class="sceneName"></h1>
</div>


<a href="javascript:void(0)" id="sceneListToggle">
    <img class="icon off" src="img/expand.png" alt="">
    <img class="icon on" src="img/collapse.png" alt="">
</a>

<a href="javascript:void(0)" id="viewUp" class="viewControlButton viewControlButton-1">
    <img class="icon" src="img/up.png" alt="">
</a>
<a href="javascript:void(0)" id="viewDown" class="viewControlButton viewControlButton-2">
    <img class="icon" src="img/down.png" alt="">
</a>
<a href="javascript:void(0)" id="viewLeft" class="viewControlButton viewControlButton-3">
    <img class="icon" src="img/left.png" alt="">
</a>
<a href="javascript:void(0)" id="viewRight" class="viewControlButton viewControlButton-4">
    <img class="icon" src="img/right.png" alt="">
</a>
<a href="javascript:void(0)" id="viewIn" class="viewControlButton viewControlButton-5">
    <img class="icon" src="img/plus.png" alt="">
</a>
<a href="javascript:void(0)" id="viewOut" class="viewControlButton viewControlButton-6">
    <img class="icon" src="img/minus.png" alt="">
</a>

<script src="vendor/screenfull.min.js"></script>
<script src="vendor/bowser.min.js"></script>
<script src="vendor/marzipano.js"></script>

<script src="data.js"></script>
<script src="index.js"></script>

<!--olw carousel-->
<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 11,
            margin: 10,

            responsive: {
                0: {
                    items: 2
                },
                400: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                },
                1200: {
                    items: 6
                },
                1400: {
                    items: 7
                },
                1600: {
                    items: 8
                },
                1800: {
                    items: 9
                },
                2000: {
                    items: 10
                },
            }
        })
    })
</script>
<!--tooltip-->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<script>
    $("#sidebarCollapse").click(function () {
        $("#iconSideNav").toggleClass("rotate-180");
    })
</script>
<!--loading-->

<script type="text/javascript">
    $(window).load(function () {
        $('body').removeClass('preloading');
        $('#preload').delay(2000).fadeOut('fast');
    });
</script>

</body>
</html>