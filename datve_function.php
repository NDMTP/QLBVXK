<?php

function connect()
{
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

//LỌC QUẬN ĐI
if (isset($_GET["function"]) && $_GET["function"] == "ajaxquandi") {
    // Gọi hàm PHP và trả về kết quả
    $matinhdi = $_GET["matinh"];
    echo quandi_filter($matinhdi);
}

function quandi_filter($matinhdi)
{
    $conn = connect();
    $sql = "SELECT * FROM quanhuyen a, tinhthanh b WHERE a.MATINH = b.MATINH AND b.MATINH = '" . $matinhdi . "'";
    $result = mysqli_query($conn, $sql);
    echo '<select class="form-select1 text-muted text-center" style="border: none" id="quanhuyendi" name="quanhuyendi" onchange="getDivBenDi()">';
    echo '<option selected text-muted>Chọn</option>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row["MAQUANHUYEN"] . '">' . $row["TENQUANHUYEN"] . '</option>';
        }
    }
    echo '</select>';
}

//LỌC QUẬN ĐẾN
if (isset($_GET["function"]) && $_GET["function"] == "ajaxquanden") {
    // Gọi hàm PHP và trả về kết quả
    $matinhden = $_GET["matinh"];
    echo quanden_filter($matinhden);
}

function quanden_filter($matinhden)
{
    $conn = connect();
    $sql = "SELECT * FROM quanhuyen a, tinhthanh b WHERE a.MATINH = b.MATINH AND b.MATINH = '" . $matinhden . "'";
    $result = mysqli_query($conn, $sql);
    echo '<select class="form-select1 text-muted text-center" style="border: none" id="quanhuyenden" name="quanhuyenden" onchange="getDivBenDen()">';
    echo '<option selected text-muted>Chọn</option>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row["MAQUANHUYEN"] . '">' . $row["TENQUANHUYEN"] . '</option>';
        }
    }
    echo '</select>';
}

//LỌC BẾN ĐI

if (isset($_GET["function"]) && $_GET["function"] == "ajaxbendi") {
    // Gọi hàm PHP và trả về kết quả
    $matinhdi = $_GET["matinh"];
    $maquanhuyen = $_GET["maquanhuyen"];
    echo bendi_filter($matinhdi, $maquanhuyen);
}

function bendi_filter($matinhdi, $maquanhuyen)
{
    $conn = connect();
    $sql = "SELECT * FROM benxe a, quanhuyen b, tinhthanh c WHERE a.MAQUANHUYEN = b.MAQUANHUYEN AND b.MATINH = c.MATINH AND b.MATINH = '" . $matinhdi . "' AND a.MAQUANHUYEN like '%" . $maquanhuyen . "%'";
    $result = mysqli_query($conn, $sql);
    echo '<select class="form-select1 text-muted text-center" style="border: none" id="bendi" name="bendi">';
    echo '<option selected text-muted>Chọn</option>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row["MABX"] . '">' . $row["TENBEN"] . '</option>';
        }
    }
    echo '</select>';
}


//LỌC BẾN ĐẾN

if (isset($_GET["function"]) && $_GET["function"] == "ajaxbenden") {
    // Gọi hàm PHP và trả về kết quả
    $matinhden = $_GET["matinh"];
    $maquanhuyen = $_GET["maquanhuyen"];
    echo benden_filter($matinhden, $maquanhuyen);
}

function benden_filter($matinhden, $maquanhuyen)
{
    $conn = connect();
    $sql = "SELECT * FROM benxe a, quanhuyen b, tinhthanh c WHERE a.MAQUANHUYEN = b.MAQUANHUYEN AND b.MATINH = c.MATINH AND b.MATINH = '" . $matinhden . "' AND a.MAQUANHUYEN like '%" . $maquanhuyen . "%'";
    $result = mysqli_query($conn, $sql);
    echo '<select class="form-select1 text-muted text-center" style="border: none" id="benden" name="benden">';
    echo '<option selected text-muted>Chọn</option>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row["MABX"] . '">' . $row["TENBEN"] . '</option>';
        }
    }
    echo '</select>';
}

//LỌC CHUYẾN XE
if (isset($_GET["function"]) && $_GET["function"] == "ajaxchuyenxe") {
    $maquanhuyendi = $_GET["maquanhuyendi"];
    $maquanhuyenden = $_GET["maquanhuyenden"];
    $mabendi = $_GET["mabendi"];
    $mabenden = $_GET["mabenden"];
    $matinhdi = $_GET["matinhdi"];
    $matinhden = $_GET["matinhden"];
    echo chuyenxe_Filter($maquanhuyendi, $maquanhuyenden, $mabendi, $mabenden, $matinhdi, $matinhden);
}

function chuyenxe_Filter($maquanhuyendi, $maquanhuyenden, $mabendi, $mabenden, $matinhdi, $matinhden)
{
    $conn = connect();
    $sql = "SELECT *, bxdi.TENBEN TENBENDI, bxden.TENBEN TENBENDEN FROM chuyenxe c, tuyenxe a, benxe bxdi, benxe bxden, quanhuyen qhdi, quanhuyen qhden , tinhthanh ttdi, tinhthanh ttden, xe x, loaixe lx
        WHERE c.ID_TUYEN = a.ID_TUYEN
        AND a.MABX = bxdi.MABX AND a.BEN_MABX = bxden.MABX
        AND bxdi.MAQUANHUYEN = qhdi.MAQUANHUYEN AND bxden.MAQUANHUYEN = qhden.MAQUANHUYEN
        AND qhdi.MATINH = ttdi.MATINH AND qhden.MATINH = ttden.MATINH
        AND c.BIENSO = x.BIENSO AND x.ID_LOAI = lx.ID_LOAI
        AND ttdi.MATINH = '" . $matinhdi . "' AND ttden.MATINH = '" . $matinhden . "'
        AND qhdi.MAQUANHUYEN like '%" . $maquanhuyendi . "%' AND qhden.MAQUANHUYEN like '%" . $maquanhuyenden . "%'
        AND bxdi.MABX like '%" . $mabendi . "%' AND bxden.MABX like '%" . $mabenden . "%'";
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
}
