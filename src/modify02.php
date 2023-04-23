<?php
    define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/"); //root 설정
    define("URL_DB", DOC_ROOT."first_pj/src/common/db_common.php"); // db연결
    define("URL_DB_COMMON_QUERY",DOC_ROOT."first_pj/src/db_query/db_common_query.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once( URL_DB );
    include_once( URL_DB_COMMON_QUERY );

    // test
    // $result_obj = modify02_print01();
    // var_dump($result_obj["obj_contents"]);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/common.css">
    <title>목표설정</title>
</head>
<body>
    <div id="wrap">
        <?php include_once( URL_HEADER ) ?>
        <div class="set_obj_box">
            <form method="post" action="modify02.php" class="mt150">
                <!-- HEADER.PHP 안에 URL_OBJ include 존재하기때문에 사용 가능 -->
                <?php include_once( URL_OBJ ); ?>
                <div class="btn_group btn_tl300 ">
                    <button class="btn" type="submit">SAVE</button>
                    <a class="btn" href="list.php">CANCEL</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    // Request Method 획득
    $http_method = $_SERVER["REQUEST_METHOD"];

    // POST 방식일 경우
    if( $http_method === "POST")
    {
        $arr_post = $_POST;
        modify02_excute01($arr_post);
        // 수정 후 list 페이지로
        header( "Location: list.php" );
        exit();
    }


?>