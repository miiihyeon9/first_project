<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_INSERT",DOC_ROOT."first_pj/src/db_query/db_insert01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_DB_INSERT);
    

    $http_method = $_SERVER["REQUEST_METHOD"];              // method 요청

    if ( $http_method === "POST" )                          // POST일때 
    {
        $arr_post = $_POST;
        $result_cnt = insert_list_info( $arr_post );        // DB에 list정보 추가
        
        header( "Location:list.php" );                      // list페이지로  redirect
        exit();                                             // 종료
    }

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awake</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/insert01.css">
</head>
<body>
    <?php include_once(URL_HEADER) ?>
    <div class="container">
        <form method="post" action="insert01.php">
            <div class="form_box1">
                <label for="list_title">제목</label>
                <input type="text" name="list_title" id="list_title" required maxlength="50">

                <label for="list_contents">내용</label>
                <input type="text" name="list_contents" id="list_contents" required maxlength="50">

            </div>
            <div class="form_box2">
                
                    <label class="box2_tit" for="ex_set">세트</label>
                    <input type="text" name="ex_set" maxlength="2" id="ex_set" >
                    <span class="set_box">SET</span>
                
                    <label class="box2_tit" for="ex_num">횟수</label>
                    <input type="text" name="ex_num" maxlength="3" id="ex_num" >
                    <span class="num_box" >회</span>
                
                    <span  class="time_lab box2_tit">시간</span>
                    <input class="time" type="text" name="ex_hour" maxlength="1" id="ex_hour" >
                    <label for="ex_hour">시간</label>
                    <input class="time" type="text" name="ex_min" maxlength="2" id="ex_min" >
                    <label  for="ex_min">분</label>
            </div>
            <div class="btn_group">
                <button type="submit">SAVE</button>
                <a class="link_btn" href="list.php">CANCEL</a>
            </div>
        </form>
    </div>
</body>
</html>