<html>
    <head>
        <title> 2020 COMP1006 - Final Project </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="search.php" method="post">
            
            <input type="text" name="search_box" id="search_box" placeholder="Search with keyword(s)..">
            <input type="submit" name="search" value="search">
            
        </form>

<?php
        session_start();
        
        if(isset($_SESSION['search_status'])){
            echo $_SESSION['search_status'];
            unset($_SESSION['search_status']);
        }else{
        
        if(!isset($_SESSION['isSearched'])){
            try{
                require_once('connect.php');

                $query = "SELECT * FROM user_info";
                $statement = $db->prepare($query);
                $statement->execute();
                $fetch = $statement->fetchAll();
                $statement->closeCursor();

                $query_more = "SELECT * FROM user_info_more";
                $statement_more = $db->prepare($query_more);
                $statement_more->execute();
                $fetch_more = $statement_more->fetchAll();
                $statement_more->closeCursor();
            }catch(PDOException $e){
                echo $e->getMessage();
            }


            echo
                    '<table>'.
                        '<tr>'.
                            '<th>'. 'Profile'. '</th>'.
                            '<th>'. 'Name'. '</th>'.
                            '<th>'. 'Email'. '</th>'.
                            '<th>'. 'Location'. '</th>'.
                            '<th>'. 'Skills'. '</th>'.
                            '<th>'. 'Social Media'. '</th>'.
                        '</tr>';


            $recordNumber = count($fetch);
            for($j = 0; $j < $recordNumber; $j++){
                $fnameArray = $fetch[$j]['first_name'];
                $lnameArray = $fetch[$j]['last_name'];
                $emailArray = $fetch[$j]['email'];
                $profilePicArray = $fetch_more[$j]['image_id'];
                $pic_link = "profile_pics/" . $profilePicArray;
                $locationArray = $fetch_more[$j]['location'];
                $skillArray = $fetch_more[$j]['skill'];
                $socialMediaArray = $fetch_more[$j]['social_media_URL'];

                echo        '<tr>'.
                                '<td>'. '<img src="'. $pic_link .'" caption="profile pic" width="66" length="66">'. '</td>'.
                                '<td>'. $fnameArray. " ". $lnameArray. '</td>'.
                                '<td>'. $emailArray. '</td>'.
                                '<td>'. $locationArray. '</td>'.
                                '<td>'. $skillArray. '</td>'.
                                '<td>'. $socialMediaArray. '</td>'.
                            '</tr>';
            }
            echo   '</table>';
        }else if(isset($_SESSION['search_result']) || isset($_SESSION['search_result_more'])){

             echo
                    '<table>'.
                        '<tr>'.
                            '<th>'. 'Profile'. '</th>'.
                            '<th>'. 'Name'. '</th>'.
                            '<th>'. 'Email'. '</th>'.
                            '<th>'. 'Location'. '</th>'.
                            '<th>'. 'Skills'. '</th>'.
                            '<th>'. 'Social Media'. '</th>'.
                        '</tr>';
            for($k = 0; $k < $_SESSION['num_search_terms']; $k++){             
            //search user_info table and merge the information from user_info_more
            if(isset($_SESSION['search_result'])){
                
                $num = count($_SESSION['search_result'][$k]);

                for($j = 0; $j < $num; $j++){
                        $fnameArray = $_SESSION['search_result'][$k][$j]['first_name'];
                        $lnameArray = $_SESSION['search_result'][$k][$j]['last_name'];
                        $emailArray = $_SESSION['search_result'][$k][$j]['email'];
                        $profilePicArray = $_SESSION['search_result_other'][$k][$j]['image_id'];
                        $pic_link = "profile_pics/" . $profilePicArray;
                        $locationArray = $_SESSION['search_result_other'][$k][$j]['location'];
                        $skillArray = $_SESSION['search_result_other'][$k][$j]['skill'];
                        $socialMediaArray = $_SESSION['search_result_other'][$k][$j]['social_media_URL'];

                    echo        '<tr>'.
                                    '<td>'. '<img src="'. $pic_link .'" caption="profile pic" width="66" length="66">'. '</td>'.
                                    '<td>'. $fnameArray. " ". $lnameArray. '</td>'.
                                    '<td>'. $emailArray. '</td>'.
                                    '<td>'. $locationArray. '</td>'.
                                    '<td>'. $skillArray. '</td>'.
                                    '<td>'. $socialMediaArray. '</td>'.
                                '</tr>';
                }
            }
            
            //search user_info_more table and merge the information from user_info
            if(isset($_SESSION['search_result_more'])){
                
                $num = count($_SESSION['search_result_more'][$k]);
                
                    for($j = 0; $j < $num; $j++){
                        for($i = 0; $i < count($_SESSION['search_result'][$k]); $i++){
                            if($_SESSION['search_result_more'][$k][$j]['id'] == $_SESSION['search_result'][$k][$i]['id']){
                                $duplicate_id = $_SESSION['search_result_more'][$k][$j]['id'];
                            }
                        }
                        if(isset($duplicate_id)) {unset($duplicate_id); continue;}
                            $fnameArray = $_SESSION['search_result_more_other'][$k][$j]['first_name'];
                            $lnameArray = $_SESSION['search_result_more_other'][$k][$j]['last_name'];
                            $emailArray = $_SESSION['search_result_more_other'][$k][$j]['email'];
                            $profilePicArray = $_SESSION['search_result_more'][$k][$j]['image_id'];
                            $pic_link = "profile_pics/" . $profilePicArray;
                            $locationArray = $_SESSION['search_result_more'][$k][$j]['location'];
                            $skillArray = $_SESSION['search_result_more'][$k][$j]['skill'];
                            $socialMediaArray = $_SESSION['search_result_more'][$k][$j]['social_media_URL'];

                        echo        '<tr>'.
                                        '<td>'. '<img src="'. $pic_link .'" caption="profile pic" width="66" length="66">'. '</td>'.
                                        '<td>'. $fnameArray. " ". $lnameArray. '</td>'.
                                        '<td>'. $emailArray. '</td>'.
                                        '<td>'. $locationArray. '</td>'.
                                        '<td>'. $skillArray. '</td>'.
                                        '<td>'. $socialMediaArray. '</td>'.
                                    '</tr>';
                        
                    }
                }
              }
            }
            echo   '</table>';
            
            unset($_SESSION['isSearched']);
        }
                
?>
        <a href="overview.php">Get All</a>
        <a href="index.php">Go Back</a>
    </body>
</html>