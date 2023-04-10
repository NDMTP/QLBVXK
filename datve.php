<!DOCTYPE html>
<html lang="en">

<?php
include("header.php");
?>

<body>

    <?php
    $diemdi = $_POST['diemdi'];
    $diemden = $_POST['diemden'];
    $ngaydi = $_POST['ngaydi'];
    if (isset($_POST['ngayve'])) {
        $ngayve = $_POST['ngayve'];
    }
    ?>

    <div class="container border rounded shadow mt-5 mb-5">
        <!-- Cái khung, bo gốc -->
        <div class=" mt-5 ml-5 mb-3 pl-5 " style="font-size: larger;">
            <?php
            if (isset($_POST['ngayve'])) {
                echo '<input type="radio" name="loaidi" id="motchieu" onchange="document.getElementById(\'ngayve\').disabled = true;"> Một chiều';
                echo '<input type="radio" name="loaidi" id="khuhoi" class="ml-5" checked onchange="document.getElementById(\'ngayve\').disabled = false;"> Khứ hồi';
            } else {
                echo '<input type="radio" name="loaidi" id="motchieu" checked onchange="document.getElementById(\'ngayve\').disabled = true;"> Một chiều';
                echo '<input type="radio" name="loaidi" id="khuhoi" class="ml-5" onchange="document.getElementById(\'ngayve\').disabled = false;"> Khứ hồi';
            }
            ?>

        </div>
        <div class="border1 mb-5 ml-5 mr-5 shadow-lg p-5">
            <!-- Nhớ xóa border -->
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="col m-1 p-3
                            text-muted text-center
                            font-weight-bold">
                            <h5 class="card-title
                                text-center
                                font-weight-bold
                                text-muted">Điểm đi</h5>
                            <?php
                            // Kết nối đến cơ sở dữ liệu
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "qlbanvexe";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if (!$conn) {
                                die("Kết nối đến cơ sở dữ liệu không thành công: " . mysqli_connect_error());
                            }

                            // Truy vấn cơ sở dữ liệu để lấy các điểm đến
                            $sql = "SELECT * FROM tinhthanh";
                            $result = mysqli_query($conn, $sql);

                            // Đưa các điểm đến vào ô điểm đến trên trang web
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="diemdi" onchange="getDivQuanDi()">';
                            echo '<option selected text-muted>Chọn địa điểm</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row["MATINH"] == $diemdi) {
                                        echo '<option value="' . $row["MATINH"] . '"selected>' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                    } else {
                                        echo '<option value="' . $row["MATINH"] . '">' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                    }
                                }
                            }
                            echo '</select>';

                            // // Đóng kết nối
                            // mysqli_close($conn);
                            ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col border-left
                                m-1 p-3 text-center
                                font-weight-bold
                                text-muted">
                            <h5 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Điểm đến</h5>
                            <?php

                            $sql = "SELECT * FROM tinhthanh";
                            $result = mysqli_query($conn, $sql);

                            // Đưa các điểm đến vào ô điểm đến trên trang web
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="diemden" onchange="getDivQuanDen()">';
                            echo '<option selected text-muted>Chọn địa điểm</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row["MATINH"] == $diemden) {
                                        echo '<option value="' . $row["MATINH"] . '"selected>' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                    } else {
                                        echo '<option value="' . $row["MATINH"] . '">' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                    }
                                }
                            }
                            echo '</select>';

                            ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col border-left text-center m-1 p-3">
                            <h5 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Ngày đi</h5>
                            <?php
                            // Lấy ngày hiện tại
                            $currentDate = date("Y-m-d");

                            // Lấy ngày đặt
                            $bookDate = isset($_POST['book_date']) ? $_POST['book_date'] : '';

                            // Kiểm tra nếu ngày hiện tại lớn hơn ngày đặt thì không cho đặt
                            if ($bookDate != '' && $currentDate > $bookDate) {
                                echo "Không thể đặt vé cho ngày đã qua.";
                            } else {
                                if ($ngaydi != "") {
                                    echo "<input type='date' id='ngaydi' name='ngaydi' min='$currentDate' value = '" . $ngaydi . "' required>";
                                } else {
                                    echo "<input type='date' id='ngaydi' name='ngaydi' min='$currentDate' required>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col border-left text-center m-1 p-3">
                            <h5 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Ngày về</h5>
                            <?php
                            // Lấy ngày hiện tại
                            $currentDate = date("Y-m-d");

                            // Lấy ngày đặt
                            $bookDate = isset($_POST['book_date']) ? $_POST['book_date'] : '';

                            // Kiểm tra nếu ngày hiện tại lớn hơn ngày đặt thì không cho đặt
                            if ($bookDate != '' && $currentDate > $bookDate) {
                                echo "Không thể đặt vé cho ngày đã qua.";
                            } else {
                                if (isset($_POST['ngayve'])) {
                                    echo "<input type='date' id='ngayve' name='ngayve' min='$currentDate' value = '" . $ngayve . "' required>";
                                } else {
                                    echo "<input type='date' id='ngayve' name='ngayve' min='$currentDate' disabled required>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <button class="snip1339 " style="float: right;" id="find-flight" onclick="getChuyenXe()">Tìm chuyến xe</button>
            </div>
        </div>
        <div class="border1 m-5 shadow-lg p-5">
            <h6 class="card-title text-muted">BỘ LỌC:</h6>
            <div class="row">
                <div class="col container shadow m-2 p-4" style="border-radius: 10px;">
                    <div class="row">
                        <div class="col" id="filterQuanDi">
                            <h6 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Chọn quận huyện đi: </h6>
                            <div id="ajaxquandi"></div>
                            <?php
                            $sql = "SELECT * FROM quanhuyen a, tinhthanh b WHERE a.MATINH = b.MATINH AND a.MATINH = '" . $diemdi . "'";
                            $result = mysqli_query($conn, $sql);
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="quanhuyendi" name="quanhuyendi" onchange="getDivBenDi()">';
                            echo '<option selected text-muted>Chọn</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["MAQUANHUYEN"] . '">' . $row["TENQUANHUYEN"] . '</option>';
                                }
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <div class="col">
                            <h6 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Chọn bến đi: </h6>
                            <div id="ajaxbendi"></div>
                            <?php
                            $sql = "SELECT * FROM benxe a, quanhuyen b, tinhthanh c WHERE a.MAQUANHUYEN = b.MAQUANHUYEN AND b.MATINH = c.MATINH AND b.MATINH = '" . $diemdi . "'";
                            $result = mysqli_query($conn, $sql);
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="bendi" name="bendi">';
                            echo '<option selected text-muted>Chọn</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["MABX"] . '">' . $row["TENBEN"] . '</option>';
                                }
                            }
                            echo '</select>';
                            ?>
                        </div>

                    </div>
                </div>
                <div class="col container shadow m-2 p-4" style="border-radius: 10px;">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Chọn quận huyện đến: </h6>
                            <div id="ajaxquanden"></div>
                            <?php
                            $sql = "SELECT * FROM quanhuyen a, tinhthanh b WHERE a.MATINH = b.MATINH AND a.MATINH = '" . $diemden . "'";
                            $result = mysqli_query($conn, $sql);
                            echo '<form method="post" action="">';
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="quanhuyenden" name="quanhuyenden" onchange="getDivBenDen()">';
                            echo '<option selected text-muted>Chọn</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["MAQUANHUYEN"] . '">' . $row["TENQUANHUYEN"] . '</option>';
                                }
                            }
                            echo '</select>';
                            echo '</form>';
                            ?>
                        </div>

                        <div class="col">
                            <h6 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Chọn bến đến: </h6>
                            <div id="ajaxbenden"></div>
                            <?php
                            $sql = "SELECT * FROM benxe";
                            $result = mysqli_query($conn, $sql);
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="benden" name="benden">';
                            echo '<option selected text-muted>Chọn</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["MABX"] . '">' . $row["TENBEN"] . '</option>';
                                }
                            }
                            echo '</select>';
                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary mt-2" style="float: right;" onclick="getNewChuyenXe()">Lọc chuyến xe</button>
                </div>
            </div>
            <hr>

            <div id="chuyenxe_ajax"></div>
            <?php
            $sql = "SELECT *, bxdi.TENBEN TENBENDI, bxden.TENBEN TENBENDEN FROM chuyenxe c, tuyenxe a, benxe bxdi, benxe bxden, quanhuyen qhdi, quanhuyen qhden , tinhthanh ttdi, tinhthanh ttden, xe x, loaixe lx
                WHERE c.ID_TUYEN = a.ID_TUYEN
                AND a.MABX = bxdi.MABX AND a.BEN_MABX = bxden.MABX 
                AND bxdi.MAQUANHUYEN = qhdi.MAQUANHUYEN AND bxden.MAQUANHUYEN = qhden.MAQUANHUYEN
                AND qhdi.MATINH = ttdi.MATINH AND qhden.MATINH = ttden.MATINH
                AND c.BIENSO = x.BIENSO AND x.ID_LOAI = lx.ID_LOAI
                AND ttdi.MATINH = 'CT65' AND ttden.MATINH = 'CM04'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo '<h6 class="card-title text-muted">KẾT QUẢ:</h6>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="mt-4" id="chuyenxe_item">';
                    echo '';
                    echo '<!-- Chuyến xe -->';
                    echo '<div class="container border shadow p-4" style="border-radius: 10px;">';
                    echo '<div class="row">';
                    echo '<div class="col">';
                    echo '<h3 style="color: #454545">';
                    echo substr($row["TGDUKIENKHOIHANH"], 11, 8) . ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . substr($row["TGDUKIENDEN"], 11, 8);
                    echo '</h3>';
                    echo '</div>';
                    echo '<div class="col">';
                    echo '<h5 style="float: right;">';
                    echo '<i class="fa fa-calendar m-1" aria-hidden="true" style="color:darkgreen"></i>';
                    echo '<i class="fa fa-bolt m-1" aria-hidden="true" style="color:darkgreen"></i>';
                    echo '<i class="fa fa-rss m-1" aria-hidden="true" style="color:darkgreen"></i>';
                    echo '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="col-md-4 border m-2 " style="border-radius: 30px; background-color:#E9E9E9">';
                    echo number_format($row["GIAHIENHANH"] . "000", 0, ',', '.') . " đ" . ' ● ' . $row["TENLOAI"] . ' ● Còn ' . $row["SOGHE"] . ' chỗ';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="col-md-11">';
                    echo '<div class="row">';
                    echo '<h6 class="col" style="font-size: large;"><i class="fa fa-circle mr-3" aria-hidden="true" style="color:darkgreen"></i> ' . $row["TENBENDI"] . '</h6>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="border-left ml-4 p-1">';
                    echo '<div class="m-3 p-2 alert alert-success">';
                    echo 'Thời gian di chuyển trung bình: ' . floor($row["TGDICHUYENTB"]) . " giờ " . round(($row["TGDICHUYENTB"] - floor($row["TGDICHUYENTB"])) * 60) . " phút";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<h6 class="col" style="font-size: large;"><i class="fa fa-map-marker mr-3" aria-hidden="true" style="color:darkgreen"></i> ' . $row["TENBENDEN"] . '</h6>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-md-1">';
                    echo '<br><br><br>';
                    echo '<div class="row">';
                    echo '<div style="text-align: center;">';
                    echo '<input style="width: 20px; height: 20px;" type="radio">';
                    echo '<h5 style="color: darkgreen;">Chọn</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        function getDivBenDi() {
            var maquanhuyen = document.getElementById("quanhuyendi").value;
            var matinhdi = document.getElementById("diemdi").value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("ajaxbendi").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "datve_function.php?function=ajaxbendi&matinh=" + matinhdi + "&maquanhuyen=" + maquanhuyen, true);
            xmlhttp.send();
            document.getElementById("bendi").remove();

        }

        function getDivBenDen() {
            var maquanhuyen = document.getElementById("quanhuyenden").value;
            var matinhden = document.getElementById("diemden").value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("ajaxbenden").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "datve_function.php?function=ajaxbenden&matinh=" + matinhden + "&maquanhuyen=" + maquanhuyen, true);
            xmlhttp.send();
            document.getElementById("benden").remove();
        }

        function makeNull(x) {
            if (x == "Chọn")
                x = "";
            return x;
        }

        function getNewChuyenXe() {
            var maquanhuyendi = makeNull(document.getElementById("quanhuyendi").value);
            var mabendi = makeNull(document.getElementById("bendi").value);
            var maquanhuyenden = makeNull(document.getElementById("quanhuyenden").value);
            var mabenden = makeNull(document.getElementById("benden").value);
            var matinhdi = makeNull(document.getElementById("diemdi").value);
            var matinhden = makeNull(document.getElementById("diemden").value);

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("chuyenxe_ajax").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "datve_function.php?function=ajaxchuyenxe&maquanhuyendi=" + maquanhuyendi + "&maquanhuyenden=" + maquanhuyenden + "&mabendi=" + mabendi + "&mabenden=" + mabenden + "&matinhdi=" + matinhdi + "&matinhden=" + matinhden, true);
            xmlhttp.send();

            document.getElementById("chuyenxe_item").remove();
        }

        function getDivQuanDi() {
            var matinhdi = document.getElementById("diemdi").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("ajaxquandi").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "datve_function.php?function=ajaxquandi&matinh=" + matinhdi, true);
            xmlhttp.send();
            document.getElementById("quanhuyendi").remove();
        }

        function getDivQuanDen() {
            var matinhdi = document.getElementById("diemden").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("ajaxquanden").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "datve_function.php?function=ajaxquanden&matinh=" + matinhdi, true);
            xmlhttp.send();
            document.getElementById("quanhuyenden").remove();
        }
    </script>

</body>
<!-- document.getElementById("show_chuyenxe").style.display = "none";
            document.getElementById("show_vitrighe").style.display = "block"; -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 footer-item">
                <h4>Kết nối với chúng tôi</h4>
                <ul class="social-icons">
                    <h3 style=" color: #EE6D4A; font-size: 40px; font-weight: 700;">1900 2082</h3>
                    <li><a rel="nofollow" href="https://fb.com/templatemo" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
                <p>
                    Địa chỉ:
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Địa chỉ:Trần Quang Khải, P.Cái Khế, Q.Ninh Kiều, TP.Cần Thơ" target="_blank" class="address">102abc, Trần Quang Khải, P.Cái Khế, Q.Ninh Kiều, TP.Cần
                        Thơ</a>
                </p>
                <p>
                    Email:
                    <a href="mailto:abc@gmail.com" class="title">abc@gmail.com</a>
                </p>
            </div>
            <div class="col-md-3 footer-item">
                <h4>Hướng Dẫn</h4>
                <ul class="menu-list">
                    <li><a href="#">Hướng dẫn đặt vé trên Web</a></li>
                    <li><a href="#">Hướng dẫn đặt vé trên App</a></li>
                    <li><a href="#">Hỏi Đáp</a></li>
                    <li><a href="#">Điều khoản sử dụng</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item">
                <h4>Đi đến trang</h4>
                <ul class="menu-list">
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="lichtrinh.php">Lịch trình</a></li>
                    <li><a href="services.php">Liên Hệ</a></li>
                    <li><a href="register.php">Đăng Ký</a></li>
                    <li><a href="login.php">Đăng nhập</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-item">
                <h4>Khác</h4>
                <ul class="menu-list">
                    <li><a href="#">Trở thành nhà cung cấp</a></li>
                    <li><a href="#">Cộng tác với chúng tôi</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="#">Điều khoản sử dụng</a></li>
                    <li><a href="#">Liên Kết Hữu Dụng</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</html>