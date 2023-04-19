<?php
//-----------------------------------------------------
// 파일명 		: db_insert01.php
// 기능			: 리스트 생성
// 이력			: v001 : new - Mihyeon Kim
//-----------------------------------------------------
include_once(URL_DB);

// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명 : insert_list_info
// 기능 : 새로운 리스트 생성
// 파라미터 : ARRAY &$param_array
// 리턴값 : INT $result_cnt / STRING ERRMSG
// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
function insert_list_info( &$param_array )
{
    $sql = " INSERT INTO do_list
    ( list_title
    ,list_contents
    ,ex_set
    ,ex_num
    ,ex_hour
    ,ex_min
    ,write_date )
    VALUES
    (
        :list_title
        ,:list_contents
        ,:ex_set
        ,:ex_num
        ,:ex_hour
        ,:ex_min
        ,NOW()
    ); ";

    $arr_prepare = 
                array(
                    ":list_title" => $param_array["list_title"]
                    ,":list_contents" => $param_array["list_contents"]
                    ,":ex_set"=>$param_array["ex_set"]
                    ,":ex_num"=>$param_array["ex_num"]
                    ,"ex_hour"=>$param_array["ex_hour"]
                    ,"ex_min"=>$param_array["ex_min"]
                );

    $conn = null;
    try 
    {
        db_conn( $conn );       // PDO object 셋
        $conn->beginTransaction(); // Transaction시작  commit이나 rollback만나면 종료
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare ); 
        $result_cnt = $stmt->rowCount();    //insert 성공하면 1 실패하면 0
        if($result_cnt !== 1)   // insert 실패할 경우
            {
                throw new Exception ('rowCount ERROR');
            }
        $conn->commit();
    }
    catch (Exception $e) 
    {
        $conn->rollback();
        return $e->getMessage();
    }
    finally
    {
        $conn = null;//     데이터베이스 종료
    }

    return $result_cnt; 
}


// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명 : select_obj_list
// 기능 : obj_list 출력
// 파라미터 : X
// 리턴값 : STRING $result[0]
// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ


// function select_obj_list()
// {
//     $sql = " SELECT obj_contents
//             FROM obj_list
//             ORDER BY obj_no DESC LIMIT 1 ;";

//     $arr_prepare=array();

//     $conn = null;
//     try 
//     {
//         db_conn( $conn );
//         $stmt = $conn->prepare( $sql );
//         $stmt->execute( $arr_prepare);
//         $result = $stmt->fetchALL();
//     } 
//     catch (Exception $e) 
//     {
//         return $e->getMessage();
//     }
//     finally
//     {
//         $conn = null;//     데이터베이스 종료
//     }
//     return $result[0];
// }

// select_obj_list();
// echo $result;


?>

