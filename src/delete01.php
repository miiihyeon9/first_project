<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");//root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");// db연결
    define("URL_DB_COMMON_QUERY",DOC_ROOT."first_pj/src/db_query/db_common_query.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php"); //header 연결
    include_once( URL_DB );
    include_once( URL_DB_COMMON_QUERY );

    // Request Method 획득
    $http_method = $_SERVER["REQUEST_METHOD"];

    // GET 일 때
    if ( $http_method === "GET" )
    {
        if( array_key_exists("list_no",$_GET) ) // $_GET안에 list_no키가 존재 할 때
        {
            $arr_get = $_GET;
            $list_no = $arr_get["list_no"];
        }
        else
        {
            $first_date = select_first_date();
            $list_no = $first_date["list_no"];
        }
        $result_info = delete01_print01( $list_no );
        $str_com_flg = "";
        if( $result_info["com_flg"] === "1" )
        {
            $str_com_flg = "완료";
        }
        else
        {
            $str_com_flg = "미완료";
        }
    }
    // POST 일 때
    else
    {
        $arr_post = $_POST;
        $arr_info =
            array(
                "list_no" => $arr_post["list_no"]
            );
        
        $result_delete = delete01_execute01( $arr_info ); // DELETE
        header( "Location: list.php" );
        exit();
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
            <div class="container container_m_i_d" >
                <form method="POST" action="delete01.php">
                    <input type="hidden" name="list_no" value="<?php echo $result_info['list_no'] ?>" >     
                    <!-- 클릭한 리스트를 가져와야 하기 때문에 화면에 출력이 되지 않지만 
                        리스트의 PK값을 가져와서 데이터를 출력 list_no가 없으면 어떤 데이터를 가져와야 하는지 모름-->
                    <div class="form_box1">
                        <label for="list_title">제목</label>
                        <input type="text" name="list_title" id="list_title" required maxlength="50" value="<?php echo $result_info['list_title'] ?>" readonly>
                        
                        <label for="list_contents">내용</label>
                        <input type="text" name="list_contents" id="list_contents" required maxlength="50" value="<?php echo $result_info['list_contents'] ?>" readonly>
                    </div>
                    <div class="form_box2 form_box2_m_d">
                        <label class="box2_tit" for="ex_set">세트</label>
                        <input type="number" name="ex_set" maxlength="2" id="ex_set" value="<?php echo $result_info['ex_set'] ?>" readonly>
                        <span class="set_box">SET</span>
                        
                        <label class="box2_tit" for="ex_num">횟수</label>
                        <input type="number" name="ex_num" maxlength="3" id="ex_num" value="<?php echo $result_info['ex_num'] ?>" readonly>
                        <span class="num_box" >회</span>
                        
                        <span  class="box2_tit">시간</span>
                        <input type="number" name="ex_hour" maxlength="1" id="ex_hour" value="<?php echo $result_info['ex_hour'] ?>" readonly>

                        <label for="ex_hour">시간</label>                        
                        <input type="number" name="ex_min" maxlength="2" id="ex_min" value="<?php echo $result_info['ex_min'] ?>" readonly>
                        <label  for="ex_min">분</label>
                
                        <label for="com_flg" class="box2_tit box2_tit_m_d" >완료 여부</label>
                        <input type="text" name="com_flg" value=" <?php echo $str_com_flg ?>
                        " readonly> 
                    </div>
                    <p class="alert">정보를 모두 삭제합니다.<br>동의 하시면 확인을 눌러 주세요.</p>
                    <div class="btn_group btn_tl15">
                        <button type ="submit" class="btn">확인</button>
                        <a class="btn" href="list.php">취소</a>                   
                    </div>
            </form>
        </div>
    </div>
</body>
</html>