<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_COMMON_QUERY",DOC_ROOT."first_pj/src/db_query/db_common_query.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_DB_COMMON_QUERY);
    

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
    <link rel="stylesheet" href="css/common.css">
</head>
<body>
    <div id="wrap">
        <?php include_once(URL_HEADER) ?>
        <div class="container container_m_i_d">
            <form method="post" action="insert01.php">
                <div class="form_box1">
                    <label for="list_title">제목</label>
                    <input type="text" name="list_title" id="list_title" required maxlength="50">
                    <label for="list_contents">내용</label>
                    <input type="text" name="list_contents" id="list_contents" required maxlength="50">
                </div>
                <div class="form_box2 form_box2_i">
                    <label class="box2_tit" for="ex_set">세트</label>
                    <input type="number" name="ex_set" maxlength="2" id="ex_set" min="0" max="50">
                    <span class="set_box">SET</span>
                
                    <label class="box2_tit" for="ex_num">횟수</label>
                    <input type="number" name="ex_num" maxlength="4" id="ex_num" min="0" max="1000">
                    <span class="num_box" >회</span>
                
                    <span  class="box2_tit">시간</span>
                    <input  type="number" name="ex_hour" maxlength="1" id="ex_hour" min="0" max="9">
                    <label for="ex_hour">시간</label>
                    <input type="number" name="ex_min" maxlength="2" id="ex_min" min="0" max="59">
                    <label  for="ex_min">분</label>
                </div>
                <div class="btn_group btn_tl80">
                    <button class="btn" type="submit">SAVE</button>
                    <a class="btn" href="list.php">CANCEL</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>