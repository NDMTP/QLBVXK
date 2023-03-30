<!DOCTYPE html>
<html lang="en">

<?php
include("header.php");
?>

<body>
    <div class="container border shadow mt-5 mb-5">
        <!-- Cái khung, bo gốc -->
        <div class="border1 m-5 shadow-lg p-5">
            <!-- Nhớ xóa border -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
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
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="diemdi">';
                            echo '<option selected text-muted>Chọn địa điểm</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["TENTINH"] . '" data-id="' . $row["MATINH"] . '">' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                }
                            }
                            echo '</select>';

                            // Đóng kết nối
                            mysqli_close($conn);
                            ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col border-left
                                m-1 p-3 text-center
                                font-weight-bold
                                text-muted">
                            <h5 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Điểm đến</h5>
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
                            echo '<select class="form-select1 text-muted text-center" style="border: none" id="diemden">';
                            echo '<option selected text-muted>Chọn địa điểm</option>';
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["TENTINH"] . '" data-id="' . $row["MATINH"] . '">' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
                                }
                            }
                            echo '</select>';

                            // Đóng kết nối
                            mysqli_close($conn);
                            ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col border-left text-center m-1 p-3">
                            <h5 class="card-title
                                    text-center
                                    font-weight-bold
                                    text-muted">Ngày đi</h5>
                            <?php
                            include('date.php');
                            ?>
                        </div>
                    </div>

                </div>
                <button class="snip1339 " style="float: right;" id="find-flight" onclick="getChuyenXe()">Tìm chuyến xe</button>
            </div>

        </div>

        <div>
            <p>THÔNG TIN CHUNG</p>
            <div id="diemdi-diemden"></div>
            <div id="distance-time"></div>
        </div>

        <div id="show_chuyenxe"></div>
        <div id="show_vitrighe"></div>
    </div>


    <script>
        // Lấy đối tượng
        var select_di = document.getElementById("diemdi");
        var select_den = document.getElementById("diemden");

        // Thêm sự kiện "change" cho select_den
        var count = 0;
        select_di.addEventListener("change", checkSelected);
        select_den.addEventListener("change", checkSelected);

        //Kiểm tra (Nếu đủ 2 thì in ra)
        function checkSelected() {
            if (select_di.value != "" && select_den.value != "") {
                count++;
                if (count == 2) {
                    count--;
                    printResult();
                }
            }

        }

        // Hàm in kết quả
        function printResult() {

            // var valueA_code = select_di.options[select_di.selectedIndex];
            // var valueA = valueA_code.dataset.id;
            var valueA = select_di.value;
            var valueB = select_den.value;
            var result = valueA + "->" + valueB;
            document.getElementById("diemdi-diemden").innerHTML = result;

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("distance-time").innerHTML = this.responseText;
                }
            };

            var option_di = select_di.options[select_di.selectedIndex];
            var start = option_di.dataset.id;
            var option_den = select_den.options[select_den.selectedIndex];
            var end = option_den.dataset.id;

            // gửi yêu cầu tới server
            xmlhttp.open("GET", "datve_function.php?function=get_distance&start=" + start + "&end=" + end, true);
            xmlhttp.send();
        }

        function printResult() {
            var valueA = select_di.value;
            var valueB = select_den.value;
            var result = valueA + "->" + valueB;
            document.getElementById("diemdi-diemden").innerHTML = result;

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("distance-time").innerHTML = this.responseText;
                }
            };

            var option_di = select_di.options[select_di.selectedIndex];
            var start = option_di.dataset.id;
            var option_den = select_den.options[select_den.selectedIndex];
            var end = option_den.dataset.id;

            // gửi yêu cầu tới server
            xmlhttp.open("GET", "datve_function.php?function=get_distance&start=" + start + "&end=" + end, true);
            xmlhttp.send();
        }

        //Hàm tìm chuyến xe
        function getChuyenXe() {
            document.getElementById("show_chuyenxe").style.display = "block";
            document.getElementById("show_vitrighe").style.display = "none";
            var valueA = select_di.value;
            var valueB = select_den.value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("show_chuyenxe").innerHTML = this.responseText;
                }
            };

            var option_di = select_di.options[select_di.selectedIndex];
            var start = option_di.dataset.id;
            var option_den = select_den.options[select_den.selectedIndex];
            var end = option_den.dataset.id;

            // gửi yêu cầu tới server
            xmlhttp.open("GET", "datve_function.php?function=get_chuyenxe&start=" + start + "&end=" + end, true);
            xmlhttp.send();
        }

        function getViTriGhe() {
            document.getElementById("show_chuyenxe").style.display = "none";
            document.getElementById("show_vitrighe").style.display = "block";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // xử lý phản hồi từ server
                    document.getElementById("show_vitrighe").innerHTML = this.responseText;
                }
            };
            // gửi yêu cầu tới server
            xmlhttp.open("GET", "datve_function.php?function=get_vitrighe", true);
            xmlhttp.send();
        }
        

    </script>


</body>

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