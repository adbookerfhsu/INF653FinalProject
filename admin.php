<?php
    session_start();
    require_once('util/valid_admin.php');
    require('model/database.php'); 
    require('model/quote_db.php');
    require('model/author_db.php');
    require('model/category_db.php');
    require('model/genre_db.php');
    require('model/submissions_db.php');

    //Null Coalescing Operator
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';

    switch ($action) {
        case 'list_quotes':
            $auth_ID = filter_input(INPUT_GET, 'authID', FILTER_VALIDATE_INT);
            $cat_ID = filter_input(INPUT_GET, 'catID', FILTER_VALIDATE_INT);
            $genre_name = filter_input(INPUT_GET, 'genre');
            $sort = filter_input(INPUT_GET, 'sort');

            // ternary statement to sort defaulted to year
            $sort = ($sort == "mYear") ? "mYear" : "mTitle";

            // needed to dropdown menus
            $cat_name = get_category_name($cat_ID);
            $auth_name = get_author_name($auth_ID);
            $quotes = get_all_quotes($sort);
            // filter for genres
            if (!empty($genre_name)) {
                $quotes = array_filter($quotes, function($array) use ($genre_name) {
                    return $array["make"] == $genre_name;
                });
            }
            // filter for authors
            if (!empty($auth_ID)) {
                $quotes = array_filter($quotes, function($array) use ($auth_name) {
                    return $array["authName"] == $auth_name;
                });
            }
            // filter for categories 
            if (!empty($cat_ID)) {
                $quotes = array_filter($quotes, function($array) use ($cat_name) {
                    return $array["catName"] == $cat_name;
                });
            }
           
            // more for drop menus 
            $authors = get_authors();
            $categories = get_categories();
            $genres = get_genres();
            include('view/header_admin.php');
            include('admin_quote_list.php');
            include('view/footer.php');
            break;
        case 'list_authors':
            $authors = get_authors();
            include('view/header_admin.php');
            include('author_list.php');
            include('view/footer.php');
            break;
        case 'list_categories':
            $categories = get_categories();
            include('view/header_admin.php');
            include('category_list.php');
            include('view/footer.php');
            break;
        case 'delete_quote':
            $quote_ID = filter_input(INPUT_POST, 'quoteID', FILTER_VALIDATE_INT);
            if (empty($quote_ID)) {
                $error = "Missing or incorrect quote id.";
                include('view/header_admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_quote($quote_ID);
                header("Location: admin.php"); 
            }
            break;
        case 'delete_author':
            $auth_ID = filter_input(INPUT_POST, 'authID', FILTER_VALIDATE_INT);
            if (empty($auth_ID)) {
                $error = "Missing or incorrect author id.";
                include('view/header_admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_author($auth_ID);
                header("Location: admin.php?action=list_authors");
            }
            break;
        case 'delete_category':
            $cat_ID = filter_input(INPUT_POST, 'catID', FILTER_VALIDATE_INT);
            if (empty($cat_ID)) {
                $error = "Missing or incorrect category id.";
                include('view/header_admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                delete_category($cat_ID);
                header("Location: admin.php?action=list_categories");
            }
            break;
        case 'show_add_form':
            $categories = get_categories();
            $authors = get_authors();
            include('view/header_admin.php');
            include('add_quote_form.php');
            include('view/footer.php');
            break;
        case 'add_quote':
            $auth_ID = filter_input(INPUT_POST, 'authID', FILTER_VALIDATE_INT);
            $cat_ID = filter_input(INPUT_POST, 'catID', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'mYear', FILTER_VALIDATE_INT);
            $genre = filter_input(INPUT_POST, 'genre');
            $title = filter_input(INPUT_POST, 'mTitle');
            $quote = filter_input(INPUT_POST, 'quote');
            if (empty($auth_ID) || empty($cat_ID) || empty($year) || empty($genre) || empty($title) || empty($quote)) {
                $error = "Invalid movie quote information. Check all fields and try again.";
                include('view/header_admin.php');
                include('errors/error.php');
                include('view/footer.php');
            } else {
                add_quote($cat_ID, $auth_ID, $year, $genre, $title, $quote);
                header("Location: admin.php");
            }
            break;
        case 'list_user_quotes':
            $user_quotes = get_user_quotes();
            include('view/header_admin.php');
            include('admin_submissions.php');
            include('view/footer.php');
            break;    
        case 'add_user_quote':
            $user_quotes = get_user_quotes();
            $cat_ID = filter_input(INPUT_POST, 'catID', FILTER_VALIDATE_INT);
            $genre = filter_input(INPUT_POST, 'genre');
            $auth_ID = filter_input(INPUT_POST, 'authID', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'mYear', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'mTitle');
            $quote = filter_input(INPUT_POST, 'quote');
                    include('view/header_admin.php');
                    include('errors/error.php');
                    include('view/footer.php');
                    add_user_quote($cat_ID, $auth_ID, $year, $genre, $title, $quote);
                    header("Location: admin.php");
                break;
        case 'delete_user_quote':
                $quote_ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
                if (empty($quote_ID)) {
                    $error = "Missing or incorrect quote id.";
                    include('view/header_admin.php');
                    include('errors/error.php');
                    include('view/footer.php');
                } else {
                    delete_user_quote($quote_ID);
                    header("Location: admin.php"); 
                }
                break;            
        case 'add_author':
            $auth_name = filter_input(INPUT_POST, 'authName');
            add_author($auth_name);
            header("Location: admin.php?action=list_authors");
            break;
        case 'add_category':
            $cat_name = filter_input(INPUT_POST, 'catName');
            add_category($cat_name);
            header("Location: admin.php?action=list_categories");
            break;
        case 'logout':
            // clear session data and session ID
            $_SESSION = array();    
            session_destroy();      
            header("Location: admin_login.php");
    }
?> 

   