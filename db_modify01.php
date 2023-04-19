<?php
// include_once("../common/db_common.php");         // 디버그용 
//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수명   : update_list
// 기능     : 특정 게시글 수정
// 파라미터 : Array &$param_arr
// 리턴값   : INT/STRING   $result_cnt/ERRMSG 
//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
function update_list( &$param_arr )
{
    $sql = " UPDATE do_list
    SET list_title = :list_title
        ,list_contents = :list_contents
        ,ex_set = :ex_set
        ,ex_num = :ex_num
        ,ex_hour = :ex_hour
        ,ex_min = :ex_min
        ,com_flg = :com_flg
        ,update_date = NOW()
    WHERE list_no = :list_no; ";
    
    
    $arr_prepare = 
            array(
            ":list_title" => $param_arr["list_title"]
            ,":list_contents" => $param_arr["list_contents"]
            ,":ex_set" => $param_arr["ex_set"]
            ,":ex_num" => $param_arr["ex_num"]
            ,":ex_hour" => $param_arr["ex_hour"]
            ,":ex_min" => $param_arr["ex_min"]
            ,":com_flg" => $param_arr["com_flg"]
            ,":list_no" => $param_arr["list_no"]
            );

    $conn = null;
    try 
    {
        db_conn( $conn );       // PDO object 셋
        $conn->beginTransaction(); // Transaction시작  commit이나 rollback만나면 종료
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount();
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
    return $result_cnt;     //행의 개수 리턴 
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
//             ;";

//     $arr_prepare=array();
//     $conn = null;
//     try 
//     {
//         db_conn( $conn );
//         $stmt = $conn->prepare( $sql );
//         $stmt->execute($arr_prepare);
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

//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ
// 함수     : select_list_info_no
// 기능     : 특정 리스트 정보 검색 
// 파라미터 : INT &$param_no
// 리턴값   : ARRAY $result
//ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ

function select_list_info_no( &$param_no )
{
    $sql = " SELECT list_title ,list_contents ,ex_set ,ex_num ,ex_hour, ex_min, com_flg ,list_no
            FROM do_list
            WHERE list_no = :list_no; ";

    $arr_prepare = 
                array(
                ":list_no" => $param_no
                );

    $conn = null;
    try 
    {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchALL();
    } 
    catch (Exception $e) 
    {
        return $e->getMessage();
    }
    finally
    {
        $conn = null;//     데이터베이스 종료
    }
    return $result[0];
}




?>

