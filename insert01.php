<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_FUNC",DOC_ROOT."first_pj/src/db_query/db_insert01.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_FUNC);
    
    $result_list = select_obj_list();                       //obj_list에서 가장 최근자료 출력
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
    <title>Insert</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/insert.css">
</head>
<body>
    <header>
        <h1><img src="../src/img/logo.png" /></h1>
        <p class="date">TODAY <?php echo date("Y-m-d") ?></p>
        <div class="goal_text">
            <form>
            <?php echo $result_list["obj_contents"]?>
            </form>
        </div>
    </header>
    <div class="container">
        <div class="line"></div>
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
                
            <button class="save_btn btnBlueGreen btnFloat" type="submit">SAVE</button>
            <button class="cancel_btn btnBlueGreen btnFloat"><a href="list.php">CANCEL</a></button>
        </form>
    </div>
</body>
</html>

