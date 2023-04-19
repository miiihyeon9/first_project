<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_MODIFY01",DOC_ROOT."first_pj/src/db_query/db_modify01.php"); //function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once(URL_DB);
    include_once(URL_DB_MODIFY01);
    
    // request method를 가져옴
    $http_method = $_SERVER["REQUEST_METHOD"];          //method 요청
    
    // GET 체크

    if( $http_method === "GET" )                        // GET일 때 
    {
        $list_no = 1;
        if( array_key_exists("list_no",$_GET) )         // $_GET의 키에 list_no가 존재할 때 
        {
            $list_no = $_GET["list_no"];
        }
            $result_info = select_list_info_no( $list_no );     // $_GET["list_no"]에 해당하는 정보를 가져옴
    }
    else                                             // POST일 때 
    {
            
            $arr_post = $_POST;
            $arr_get = $_GET;                       // 체크가 된 상태에서 체크를 해제하고 수정하면 com_flg가 null값이 되는데
            if(is_null($arr_post['com_flg']))       // com_flg는 데이터베이스 제약조건이 NOT NULL이기 때문에 null이되면 update 실패하고 rollback됨 
                                                    // null인 경우 com_flg에 미완료상태인 0을 넣어준다. 
            {
                $arr_post['com_flg'] = "0";
            }
            $arr_info = 
                    array(
                        "list_title" => $arr_post["list_title"]
                        ,"list_contents" => $arr_post["list_contents"]
                        ,"ex_set" => $arr_post["ex_set"]
                        ,"ex_num" => $arr_post["ex_num"]
                        ,"ex_hour" => $arr_post["ex_hour"]
                        ,"ex_min" => $arr_post["ex_min"]
                        ,"com_flg" => $arr_post["com_flg"]
                        ,"list_no" => $arr_post["list_no"]
                    );            
            $result_update = update_list( $arr_info );      // UPDATE
            // var_dump($arr_post);
            header( "Location: list.php");                 // list.php로 redirect
            exit();                                         // 종료

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
        <link rel="stylesheet" href="css/modify01.css">
    </head>
    <body>
        <?php include_once(URL_HEADER) ?>
        <div class="container" >
            <form method="post" action="modify01.php">
                <input type="hidden" name="list_no" value="<?php echo $result_info['list_no'] ?>" >
                <div class="form_box1">
                    <label for="list_title">제목</label>
                    <input type="text" name="list_title" id="list_title" required maxlength="50" value="<?php echo $result_info['list_title'] ?>" >
                    
                    <label for="list_contents">내용</label>
                    <input type="text" name="list_contents" id="list_contents" required maxlength="50" value="<?php echo $result_info['list_contents'] ?>" >
                </div>
                <div class="form_box2">
                    <label class="box2_tit" for="ex_set">세트</label>
                    <input type="text" name="ex_set" maxlength="2" id="ex_set" value="<?php echo $result_info['ex_set'] ?>" >
                    <span class="set_box">SET</span>
                    
                    <label class="box2_tit" for="ex_num">횟수</label>
                    <input type="text" name="ex_num" maxlength="3" id="ex_num" value="<?php echo $result_info['ex_num'] ?>" >
                    <span class="num_box" >회</span>
                    
                    <span  class="time_lab box2_tit">시간</span>
                    <input class="time" type="text" name="ex_hour" maxlength="1" id="ex_hour" value="<?php echo $result_info['ex_hour'] ?>" >
                    <label for="ex_hour">시간</label>
                    
                    <input class="time" type="text" name="ex_min" maxlength="2" id="ex_min" value="<?php echo $result_info['ex_min'] ?>" >
                    <label  for="ex_min">분</label>
            
                    <span>완료 여부</span>
                    <input type="checkbox" name="com_flg" value="1"
                    <?php
                    if( $result_info['com_flg'] === "1" )   // com_flg가 "1"일 때 checkbox checked
                    {
                        echo "checked";
                    }
                    ?>
                    >     
                    <label for="com_flg">완료</label>

                    <button type = submit name="submit" >SAVE</button>
                    <a class="link_btn" href="delete01.php?list_no=<?php echo $result_info['list_no']?>">DELETE</a>
                    <a class="link_btn" href="list.php" >CANCEL</a>
            </div>
        </form>
    </div>
</body>
</html>