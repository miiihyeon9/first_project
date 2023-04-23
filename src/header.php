<?php
define("URL_OBJ",DOC_ROOT."first_pj/src/set_obj.php"); // 목표 설정 연결
?>

<header>
    <h1><a href="list.php"><img src="../src/img/logo.png" /></a></h1>
    <p class="date">TODAY <?php echo date("Y-m-d") ?>
        <a href="modify02.php"><i class="bi bi-pencil-square" style="color:#fff"></i></a>
    </p>
    <?php
        // basename : 경로 제외한 파일이름만 선택하는 함수
        $flg_modify02 = basename($_SERVER["PHP_SELF"]) === "modify02.php" ?  true : false;
        $result_obj = modify02_print01(); // 목표 출력하는 함수
        if( !$flg_modify02 ) { 
            include_once( URL_OBJ );
        }
        ?>
</header>

