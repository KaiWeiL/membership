<?php
        session_start();
        $search_term_s = filter_input(INPUT_POST, 'search_box');
        $search_term = explode(" ", $search_term_s);
        
    
        
        require_once('connect.php');
        
        unset($fetch);
        unset($fetch_more);
        $num_search_terms = count($search_term);
        $_SESSION['num_search_terms'] = $num_search_terms;
       
        for($k = 0; $k < $num_search_terms; $k++){
        try{
            $query = "SELECT * FROM user_info WHERE first_name LIKE '%" . $search_term[$k]. "%' OR last_name LIKE '%" . $search_term[$k] . "%' OR email LIKE '%" . $search_term[$k]. "%'";
            $statement = $db->prepare($query);
            $statement->execute();
            $fetch[$k] = $statement->fetchAll();
            $statement->closeCursor();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
        try{
            $query_more = "SELECT * FROM user_info_more WHERE location LIKE '%" . $search_term[$k] . "%' OR social_media_URL LIKE '%" . $search_term[$k] . "%' OR skill LIKE '%" . $search_term[$k] ."%'";
            $statement_more = $db->prepare($query_more);
            $statement_more->execute();
            $fetch_more[$k] = $statement_more->fetchAll();
            $statement->closeCursor();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
//get the other information from the other table through the searched id of the searched table
        if($fetch[$k] != false){
            try{
                for($i = 0; $i < count($fetch[$k]); $i++){
                    $query_other = "SELECT * FROM user_info_more WHERE id = :id";
                    $statement_other = $db->prepare($query_other);
                    $statement_other->bindValue(':id', $fetch[$k][$i][0]);
                    $statement_other->execute();
                    $fetch_other[$k][$i] = $statement_other->fetch();
                    $statement_other->closeCursor();
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        if($fetch_more[$k] != false){
            try{
                for($i = 0; $i < count($fetch_more[$k]); $i++){
                    $query_more_other = "SELECT * FROM user_info WHERE id = :id";
                    $statement_more_other = $db->prepare($query_more_other);
                    $statement_more_other->bindValue(':id', $fetch_more[$k][$i][0]);
                    $statement_more_other->execute();
                    $fetch_more_other[$k][$i] = $statement_more_other->fetch();
                    $statement_more_other->closeCursor();
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
 /*
  *             Map
  * Variable             Table
  * $fetch[$k]            -> user_info
  * $fetch_more[$k]       -> user_info_more
  * $fetch_other[$k]      -> user_info_more
  * $fetch_more_other[$k] -> user_info
 */
        $_SESSION['search_result'] = $fetch;    //user_info
        $_SESSION['search_result_other'] = $fetch_other;    //user_info_more
        $_SESSION['search_result_more'] = $fetch_more;      //user_info_more
        $_SESSION['search_result_more_other'] = $fetch_more_other;     //user_info
        
        if( isset($fetch_other) || isset($fetch_more_other)){
            $_SESSION['isSearched'] = 1;
        }else{
            $_SESSION['search_status'] = "Not Found!";
            unset($_SESSION['isSearched']);
        }
        
        }
        
        header('location: overview.php');
        
        
?>

