<?php
    require('../model/database.php');
    require('api_db.php');
    require('../model/quote_db.php');
    require('../model/author_db.php');
    require('../model/category_db.php');
    require('../model/genre_db.php');

    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $cat_ID = filter_input(INPUT_GET, 'categoryId');
        $auth_ID = filter_input(INPUT_GET, 'authorId');
        $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT); 
        // check for author and category request
        if ($auth_ID == 'all') {
            $authors = get_api_authors();
            header('Content-Type: application/json');
            echo json_encode($authors);
        } else if($cat_ID == 'all')  {
            $categories = get_api_categories();
            header('Content-Type: application/json');
            echo json_encode($categories);
        }  else { 
            // begins the api quotes section
            if (isset($cat_ID, $auth_ID)) {
                $quotes = get_api_quotesByBoth($cat_ID, $auth_ID);
            } else if (!empty($auth_ID)) {
                $quotes = get_api_quotesByAuthor($auth_ID);
            } else if (!empty($cat_ID)) {
                $quotes = get_api_quotesByCategory($cat_ID);
            } else if (isset($limit)) {
                $quotes = get_api_quotesByLimit($limit);
            } else {
                $quotes = get_api_allquotes();
            }
                header('Content-Type: application/json');
                echo json_encode($quotes);
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {    
        if (!isset($_SERVER["CONTENT_TYPE"])) {
            $data = array("message"=>"Required: Content-Type header");
            header('Content-Type: application/json');
            echo json_encode($data);
        } else if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            //if we receive raw JSON data
            $json = file_get_contents('php://input');
            //$data is a php array
            $data = json_decode($json);
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
        if (property_exists($data, 'catID')) {
            $cat_ID = $data->catID;
        } else {
            $error_message = "You didn't enter a category ID.";
        }
        if (property_exists($data, 'authID')) {
            $auth_ID = $data->authID;
        } else {
            $error_message = "You didn't enter an author ID.";
        }
        if (property_exists($data, 'authID')) {
            $genre = $data->genre;
        } else {
            $error_message = "You didn't enter an genre.";
        }
        if (property_exists($data, 'mYear')) {
            $year = $data->mYear;
        } else {
            $error_message = "You didn't enter an movie year.";
        }
        if (property_exists($data, 'mTitle')) {
            $title = $data->mTitle;
        } else {
            $error_message = "You didn't enter an movie title.";
        }
        if (property_exists($data, 'quote')) {
            $user_quote = $data->quote;
        } else {
            $error_message = "You didn't enter a movie qoute.";
        }
        if (empty($error_message)) {
            $auth_ID = filter_input(INPUT_POST, 'authID', FILTER_VALIDATE_INT);
            $cat_ID = filter_input(INPUT_POST, 'catID', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'mYear', FILTER_VALIDATE_INT);
            $genre = filter_input(INPUT_POST, 'genre');
            $title = filter_input(INPUT_POST, 'mTitle');
            $quote = filter_input(INPUT_POST, 'quote');
            $data = array("authID"=>$auth_ID, "catID"=>$cat_ID, "genre"=>$genre, "mYear"=>$year, "mTitle"=>$title, "quote"=>$quote);
            add_user_quote($cat_ID, $auth_ID, $genre, $year, $title, $quote); 
            $success_message = "User quote submitted!";
            header('Content-Type: application/json');
            echo json_encode($data);
            echo json_encode($success_message);
              
        } else {
            header('Content-Type: application/json');
            echo json_encode($error_message);
            echo json_encode($data);
            }
        }
    } else {
        $data = array("message"=>"You did not send a GET or POST request");
        header('Content-Type: application/json');
        echo json_encode($data);
    }   
    //
        
       // 
       // } else if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            //if we receive raw JSON data
       //     $json = file_get_contents('php://input');
            //$data is a php array
        //    $data = json_decode($json);
        //    header('Content-Type: application/json');
        //    echo json_encode($data);
        //} else {
        //    $first = trim(filter_input(INPUT_POST, 'first'));
        //    $last = trim(filter_input(INPUT_POST, 'last'));
        //    $data = array("first"=>$first, "last"=>$last);
        //    header('Content-Type: application/json');
        //    echo json_encode($data);
      //  }
    //} else {
    //    $data = array("message"=>"You did not send a GET or POST request");
    //    header('Content-Type: application/json');
    //    echo json_encode($data);
    

?>