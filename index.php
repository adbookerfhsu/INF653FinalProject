<?php
    require('model/database.php');
    require('model/quote_db.php');
    require('model/author_db.php');
    require('model/category_db.php');
    require('model/genre_db.php');

    //Null Coalescing Operator
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_quotes';

    switch ($action) {
        default: //'list_quotes' 
            $auth_ID = filter_input(INPUT_GET, 'authID', FILTER_VALIDATE_INT);
            $cat_ID = filter_input(INPUT_GET, 'catID', FILTER_VALIDATE_INT);
            $genre_name = filter_input(INPUT_GET, 'genre');
            $sort = filter_input(INPUT_GET, 'sort');

            // ternary statement to sort defaulted to year
            $sort = ($sort == "mYear") ? "mYear" : "mTitle";

            // needed for dropdown menus
            $cat_name = get_category_name($cat_ID);
            $auth_name = get_author_name($auth_ID);
            $quotes = get_all_quotes($sort);
            // fiter for genres
            if (!empty($genre_name)) {
                $quotes = array_filter($quotes, function($array) use ($genre_name) {
                    return $array["genre"] == $genre_name;
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

            // more used in dropdowns 
            $authors = get_authors();
            $categories = get_categories();
            $genres = get_genres();
            include('view/header.php');
            include('quote_list.php');
            include('view/footer.php');
    }
?> 

   