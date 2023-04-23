<?php
    define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");                                   //root 설정
    define("URL_DB",DOC_ROOT."first_pj/src/common/db_common.php");                      // db연결
    define("URL_DB_COMMON_QUERY",DOC_ROOT."first_pj/src/db_query/db_common_query.php"); // function 연결
    define("URL_HEADER",DOC_ROOT."first_pj/src/header.php");                            //header 연결
    include_once(URL_DB);
    include_once(URL_DB_COMMON_QUERY);

    // REQUEST_METHOD 가져옴
    $http_method = $_SERVER["REQUEST_METHOD"];         
    $checked="";                                                                        //체크박스
    // GET 일 경우
    if( $http_method === "GET" )                        
    {                    
        $arr_get = $_GET;
        if( array_key_exists("list_no",$_GET) )                                         // $_GET의 키에 list_no가 존재하는 경우
        {
            $list_no = $arr_get["list_no"];                                             // $list_no를 $_GET["list_no"]  지정
        }else{
            $first_date = select_first_date();                                          // 아닌 경우 오름차순으로 첫 번째 list_no 가져옴
            $list_no = $first_date["list_no"];
        }
        $result_info = select_list_info_no( $list_no );                                 // $arr_get["list_no"]에 해당하는 정보 SELECT
        if($result_info['com_flg'] === "1" )                                            // $result_info['com_flg']값이 1인 경우 checked 출력
        {
            $checked = "checked";
        }    
    }
    // POST일 경우 
    else                                             
    {
        $arr_post = $_POST;
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
        if($arr_info['com_flg'] === "1" )                                                   // $arr_info['com_flg']값이 1인 경우 checked 출력
        {
            $checked = "checked";
        }else
        {
            $arr_info["com_flg"] = "0";                                                     // 체크 해제하고 update 시 $arr_flg['com_flg'] 값이 null값이 되는데 
        }                                                                                   // com_flg는 데이터베이스에서 제약조건이 not null 이라 
                                                                                            // null 값으로 보내면 실패하고 다시 롤백이 되기 때문에 
                                                                                            // $arr_info["com_flg"]="1" 이 아닐 때는
                                                                                            // $arr_info["com_flg"] = "0"을 넣어준다.  
        $result_update = update_list( $arr_info );                                          // UPDATE
        header( "Location: list.php");                                                      // list.php로 redirect
        exit();                                                                             // 종료
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
                <form method="post" action="modify01.php">
                    <input type="hidden" name="list_no" value="<?php echo $result_info['list_no'] ?>" >     
                    <!-- 리스트의 PK값을 가져와서 데이터를 보내야하기 때문에 hidden으로 list_no를 가져옴 -->
                    <div class="form_box1">
                        <label for="list_title">제목</label>
                        <input type="text" name="list_title" id="list_title" required maxlength="50" value="<?php echo $result_info['list_title'] ?>" >
                        <label for="list_contents">내용</label>
                        <input type="text" name="list_contents" id="list_contents" required maxlength="50" value="<?php echo $result_info['list_contents'] ?>" >
                    </div>
                    <div class="form_box2 form_box2_m_d">
                        <label class="box2_tit box2_tit_m_d" for="ex_set">세트</label>
                        <input type="number" name="ex_set" maxlength="2" id="ex_set" min="0" max="50" value="<?php echo $result_info['ex_set'] ?>" >
                        <span class="set_box">SET</span>
                        <label class="box2_tit box2_tit_m_d " for="ex_num">횟수</label>
                        <input type="number" name="ex_num" maxlength="4" min="0" max="1000" id="ex_num" value="<?php echo $result_info['ex_num'] ?>" >
                        <span class="num_box" >회</span>
                        <span  class="box2_tit box2_tit_m_d">시간</span>
                        <input  type="number" name="ex_hour" maxlength="1" min="0" max="9" id="ex_hour" value="<?php echo $result_info['ex_hour'] ?>" >
                        <label for="ex_hour">시간</label>
                        <input  type="number" name="ex_min" maxlength="2" min="0" max="59" id="ex_min" value="<?php echo $result_info['ex_min'] ?>" >
                        <label  for="ex_min">분</label>
                        <label for="com_flg" class="box2_tit box2_tit_m_d" >완료 여부</label>
                        <input class="ch_box_m"type="checkbox" name="com_flg" value="1" <?php echo $checked ?>>
                    </div>
                    <div class="btn_group btn_tl70">
                        <button class="btn" type ="submit">SAVE</button>
                        <a class="btn" href="delete01.php?list_no=<?php echo $result_info['list_no']?>">DELETE</a>
                        <a class="btn" href="list.php" >CANCEL</a>
                    </div>
            </form>
        </div>
    </div>
    </body>
</html>