<!DOCTYPE html>
<html lang="EN">

<?php
include("header.php");
?>


<!-- Cái khung, bo gốc -->
<div class="container border shadow mt-5 mb-5" style="border-radius:20px">
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
                                    echo '<option value="' . $row["TENTINH"] . '" data-id="'.$row["MATINH"] .'">' . $row["TENTINH"] . ' (' . $row["MATINH"] . ')</option>';
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
                <a href="datve.php">
                    <button class="snip1339" style="float: right;" id="find-flight" onclick="sendData()">Tìm chuyến xe</button>
                </a>
            </div>
        </div>
    </div>


<!-- Bảng giá -->
<div class="container">
    <h4 class="title3 font-weight-bold">TUYẾN PHỔ BIẾN</h4>
    <!-- Dòng đầu  -->
    <div class="row">
        <!-- Ô đầu  -->
        <div class="container btn col-md-6 pr-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/SaiGon.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text22 font-weight-bold text-center ">Sài Gòn ⇒ Đà Lạt</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>300.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            8h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            310km
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ô 2 -->
        <div class="container btn col-md-6 pl-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/NhaTrang.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text21 font-weight-bold text-center ">Sài Gòn ⇒ Nha Trang</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details">
                            <span>450.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            9h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            275km
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dòng 2 -->
    <div class="row">
        <!-- ô 3 -->
        <div class="container btn col-md-6 pr-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/DaNang.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text21 font-weight-bold text-center ">Sài Gòn ⇒ Đà Nẵng</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>395.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            20h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            980km
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ô 4 -->
        <div class="container btn col-md-6 pl-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/CanTho.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text22 font-weight-bold text-center ">Sài Gòn ⇒ Cần Thơ</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>165.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            4h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            190km
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dòng 3 -->
    <div class="row">
        <!-- ô 5 -->
        <div class="container btn col-md-6 pr-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/HaNoi.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text22 font-weight-bold text-center ">Đà Nẵng ⇒ Hà Nội</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>360.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            18h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            745km
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ô 6 -->
        <div class="container btn col-md-6 pl-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/RachGia.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text21 font-weight-bold text-center ">Sài Gòn ⇒ Rạch Giá</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>190.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            5h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            235km
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dòng 4 -->
    <div class="row">
        <!-- ô 7 -->
        <div class="container btn col-md-6 pr-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/ChauDoc.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text21 font-weight-bold text-center ">Sài Gòn ⇒ Châu Đốc</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>175.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            6h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            240km
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ô 8 -->
        <div class="container btn col-md-6 pl-5">
            <div class="row border2 border">
                <div>
                    <img class="img" src="assets/images/CaMau.jpg" style="max-width: 200px;" alt="">
                </div>
                <div>
                    <h5 class="text22 font-weight-bold text-center ">Sài Gòn ⇒ Cà Mau</h5>
                    <div class="text23">
                        <div data-v-15bcc412="" class="details ">
                            <span>230.000đ &emsp;&emsp;&emsp;</span>
                            <p class="fa fa-clock-o icon "></p>
                            8h &emsp;&emsp;&emsp;
                            <p class="fa fa-map-marker icon"></p>
                            357km
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div>
    <h1 class="tieude font-weight-bold">ABC - CHẤT LƯỢNG LÀ DANH DỰ</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="sumary-item" data-v-322ee1ea="" data-v-292e059d=""><svg xmlns="http://www.w3.org/2000/svg"
                    width="80" height="80" viewBox="0 0 80 80" class="icon" data-v-322ee1ea="">
                    <g fill="none" fill-rule="evenodd">
                        <circle cx="40" cy="40" r="39.25" stroke="#F15A24" stroke-width="1.5"></circle>
                        <circle cx="40" cy="40" r="32" fill="#F15A24" fill-rule="nonzero" opacity=".2"></circle>
                        <g fill="#F15A24" fill-rule="nonzero">
                            <path
                                d="M28 43.143h-8.377c-.98.029-1.932-.322-2.66-.98-.505-.46-.903-1.025-1.166-1.656-.263-.909-.366-1.856-.304-2.8 0-.187 0-.444-.14-.584-.14-.14 0 0 0 0s.14-.373.164-.56v-1.796-4.924c.01-3.24 1.167-6.374 3.266-8.843 1.079-1.26 2.385-2.304 3.85-3.08.183-.125.424-.125.607 0 1.601 1.089 3.532 1.584 5.46 1.4 1.416-.07 2.786-.522 3.967-1.307.292-.21.687-.21.98 0 2.803 1.516 4.953 4.006 6.043 7 .635 1.636.952 3.379.933 5.134v8.843c.065 1.11-.332 2.198-1.096 3.006-.764.809-1.828 1.266-2.94 1.264L28 43.143zM28 17.523c-4.66-.164-8.31-4.065-8.167-8.726C19.715 4.154 23.358.282 28 .117c2.247.067 4.375 1.024 5.915 2.66 1.54 1.638 2.367 3.82 2.298 6.066.063 2.24-.767 4.414-2.308 6.042-1.54 1.628-3.665 2.577-5.905 2.638zM13.44 39.387H4.667c-1.148.038-2.202-.628-2.66-1.68-.214-.435-.318-.916-.304-1.4v-6.814c-.023-3.637 1.947-6.995 5.134-8.75.195-.14.458-.14.653 0 2.12 1.41 4.88 1.41 7 0 .222-.163.525-.163.747 0 .933.607.91.304.303 1.284-1.181 1.8-1.946 3.84-2.24 5.973-.175 2.025-.222 4.06-.14 6.09v4.783c0 .187 0 .467.28.514zM4.947 13.487c-.076-1.67.525-3.3 1.667-4.521s2.728-1.93 4.4-1.966c3.439.127 6.135 3 6.043 6.44.037 1.659-.586 3.264-1.732 4.463-1.147 1.2-2.723 1.894-4.382 1.93-1.638-.042-3.191-.736-4.317-1.927-1.125-1.191-1.73-2.781-1.68-4.42zM42.49 39.387h8.843c1.152.035 2.212-.629 2.684-1.68.202-.44.306-.917.303-1.4v-6.814c.023-3.637-1.947-6.995-5.133-8.75-.196-.14-.458-.14-.654 0-2.12 1.41-4.88 1.41-7 0-.222-.163-.524-.163-.746 0-.91.607-.91.304-.28 1.284 1.13 1.814 1.854 3.852 2.123 5.973.175 2.025.222 4.06.14 6.09v4.783c.023.187.023.467-.28.514zM51.007 13.487c0-2.168-1.157-4.17-3.034-5.254-1.877-1.084-4.19-1.084-6.066 0-1.877 1.083-3.034 3.086-3.034 5.254 0 3.35 2.716 6.066 6.067 6.066 3.35 0 6.067-2.716 6.067-6.066z"
                                transform="translate(12 18)"></path>
                        </g>
                    </g>
                </svg>
                <div class="texts">
                    <p class="title">20M</p>
                    <p class="subtitle">Hơn 20 triệu lượt khách</p>
                    <p class="desc">Phương Trang phục vụ hơn 20 triệu lượt khách/bình quân 1 năm trên toàn quốc</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        </div>
    </div>

</div>



<div class="partners">
    <h2 class="title font-weight-bold">ĐIỂM ĐẾN PHỔ BIẾN</h2>
    <h4 class="title2">Gợi ý những điểm du lịch được ưa thích trong năm</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-partners owl-carousel">

                    <div class="partner-item hinh">
                        <img src="assets/images/CanTho.jpg" title="" alt="1">
                    </div>

                    <div class="partner-item hinh">
                        <img src="assets/images/CaMau.jpg" title="2" alt="2">
                    </div>

                    <div class="partner-item hinh">
                        <img src="assets/images/DaNang.jpg" title="3" alt="3">
                    </div>

                    <div class="partner-item hinh">
                        <img src="assets/images/NhaTrang.jpg" title="4" alt="4">
                    </div>

                    <div class="partner-item hinh">
                        <img src="assets/images/SaiGon.jpg" title="5" alt="5">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3 footer-item">
                <h4>Kết nối với chúng tôi</h4>
                <ul class="social-icons">
                    <h3 style=" color: #EE6D4A; font-size: 40px; font-weight: 700;">1900 2082</h3>
                    <li><a rel="nofollow" href="https://fb.com/templatemo" target="_blank"><i
                                class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
                <p>
                    Địa chỉ:
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Địa chỉ:Trần Quang Khải, P.Cái Khế, Q.Ninh Kiều, TP.Cần Thơ"
                        target="_blank" class="address">102abc, Trần Quang Khải, P.Cái Khế, Q.Ninh Kiều, TP.Cần
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

<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Copyright &copy; 2023 nhóm 2 Phát Triển Hệ Thống Web

                    - Thiết Kế: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">Nhóm
                        2</a><br>
                    Phát hành bởi: <a rel="nofollow noopener" href="https://themewagon.com" target="_blank">Nhóm
                        2</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/accordions.js"></script>

<script language="text/Javascript">
cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
function clearField(t) { //declaring the array outside of the
    if (!cleared[t.id]) { // function makes it static and global
        cleared[t.id] = 1; // you could use true and false, but that's more typing
        t.value = ''; // with more chance of typos
        t.style.color = '#fff';
    }
}

</script>


</body>

</html>