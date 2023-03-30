<?php

    function connect(){
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "qlbanvexe";

    
        $conn = new mysqli($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Kết nối đến cơ sở dữ liệu không thành công: " . mysqli_connect_error());
        } 
        return $conn; 
    }

    if (isset($_GET["function"]) && $_GET["function"] == "get_distance") {
        // Gọi hàm PHP và trả về kết quả
        $start = $_GET["start"];
        $end = $_GET["end"];
        echo get_distance($start, $end);
    }

    if (isset($_GET["function"]) && $_GET["function"] == "get_chuyenxe") {
        // Gọi hàm PHP và trả về kết quả
        $start = $_GET["start"];
        $end = $_GET["end"];
        echo get_chuyenxe($start, $end);
    }

    if (isset($_GET["function"]) && $_GET["function"] == "get_vitrighe") {
        echo get_ViTriGhe();
    }

function get_distance($diemdi, $diemden)
{   
    $conn = connect();
    $sql = "SELECT *
    FROM TuyenXe
    INNER JOIN BenXe AS BenXeDi ON TuyenXe.MABX = BenXeDi.MABX
    INNER JOIN QuanHuyen AS QuanHuyenDi ON BenXeDi.MaQuanHuyen = QuanHuyenDi.MaQuanHuyen
    INNER JOIN BenXe AS BenXeDen ON TuyenXe.BEN_MABX = BenXeDen.MABX
    INNER JOIN QuanHuyen AS QuanHuyenDen ON BenXeDen.MaQuanHuyen = QuanHuyenDen.MaQuanHuyen
    WHERE QuanHuyenDi.MaTinh = '$diemdi' AND QuanHuyenDen.MaTinh = '$diemden'";

    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>Khoảng cách: ".$row["QUANGDUONG"]."</div>";
            echo "<div>Thời gian: ".$row["TGDICHUYENTB"]."</div>";
        }
    } else {
        echo "Hiện chưa có tuyến !";
    }
    $conn->close();
}


function get_chuyenxe($diemdi_2, $diemden_2){
    echo '<hr class="mt-5">';
    echo '<h3>Kết quả: </h3>';
    $conn = connect();
    $sql = "SELECT * FROM ChuyenXe WHERE ID_TUYEN = (SELECT tuyenxe.ID_TUYEN
    FROM TuyenXe
    INNER JOIN BenXe AS BenXeDi ON TuyenXe.MABX = BenXeDi.MABX
    INNER JOIN QuanHuyen AS QuanHuyenDi ON BenXeDi.MaQuanHuyen = QuanHuyenDi.MaQuanHuyen
    INNER JOIN BenXe AS BenXeDen ON TuyenXe.BEN_MABX = BenXeDen.MABX
    INNER JOIN QuanHuyen AS QuanHuyenDen ON BenXeDen.MaQuanHuyen = QuanHuyenDen.MaQuanHuyen
    WHERE QuanHuyenDi.MaTinh = '$diemdi_2' AND QuanHuyenDen.MaTinh = '$diemden_2')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="border shadow m-5 mx-10" style="border-radius: 20px">';
            echo '<div class="p-5">';
            echo "<div>".$row["TENCHUYENXE"]."</div>";
            echo "<div>Thời gian đi: ".$row["THOIDIEMDITT"]." -> Thời gian đến: ".$row["THOIDIEMDENTT"]."</div>";
            echo "<div>Thời gian dự kiến đi: ".$row["TGDUKIENKHOIHANH"]." -> Thời gian dự kiến đến: ".$row["TGDUKIENDEN"]."</div>";
            echo "<div>Giá:".$row["GIA"]."</div>";
            echo '<button class = "snip1339" style="float: right;" id="find-flight"onclick="getViTriGhe()">Chọn Chuyến</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Hiện chưa có chuyến !";
    }
    $conn->close();
}

function get_ViTriGhe(){
    echo '<div class="border shadow m-5 mx-10" style="border-radius: 20px">';
    echo '<div class="p-5">';
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col">';
    echo '<div class="row">';
    echo '<div class="border-right">';
    echo '<table class="border m-3" style="font-size: 50px;">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '<div>';
    echo '<table class="border m-3" style="font-size: 50px;">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '<td class="border m-3"><i class="fa fa-user-circle" aria-hidden="true"></i></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col">';
    echo '<div class="border mt-5 mb-5 p-3" style="border-radius: 20px">';
    echo '<div>Tên chuyến: </div>';
    echo '<div>Thời gian đi: </div>';
    echo '<div>Thời gian đến: </div>';
    echo '<div>Giá vé: </div>';
    echo '';
    echo '</div>';
    echo '<div class="border p-3 mb-5" style="border-radius: 20px">';
    echo '<div>Số vé:</div>';
    echo '<div>Tổng tiền:</div>';
    echo '</div>';
    echo '<button class="snip1339 " style="float: right;" id="find-flight">Đặt vé</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>