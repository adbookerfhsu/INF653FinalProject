<?php

    function get_api_allquotes() {
        global $db;
        $query  =  ' SELECT  q.quoteID, q.catID, c.catName, q.authID, a.authName, q.mYear, q.genre, q.mTitle, q.quote  
                FROM  quotes q  
                LEFT JOIN  category c  ON  q.catID  =  c.catID 
                LEFT JOIN  author a  ON  q.authID  =  a.authID  
                ORDER BY  q.quoteID ' ; 
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

    function get_api_quotesByLimit($limit) {
        global $db;
        $query  =  ' SELECT  q.quoteID, q.catID, c.catName, q.authID, a.authName, q.mYear, q.genre, q.mTitle, q.quote  
                FROM  quotes q  
                LEFT JOIN  category c  ON  q.catID  =  c.catID 
                LEFT JOIN  author a  ON  q.authID  =  a.authID  
                ORDER BY  q.quoteID 
                LIMIT ' .$limit . ''; 
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

      
    function get_api_quotesByAuthor($auth_ID) {
        global $db;
        $query  =  ' SELECT  q.quoteID, q.catID, c.catName, q.authID, a.authName, q.mYear, q.genre, q.mTitle, q.quote  
                    FROM  quotes q  
                    LEFT JOIN  category c  ON  q.catID  =  c.catID 
                    LEFT JOIN  author a  ON  q.authID  =  a.authID  
                    WHERE  q.authID = :authID' ; 
        $statement = $db->prepare($query);
        $statement->bindValue(':authID', $auth_ID);
        $statement->execute();
        $quotes = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

    function get_api_quotesByCategory($cat_ID) {
        global $db;
        $query  =  ' SELECT  q.quoteID, q.catID, c.catName, q.authID, a.authName, q.mYear, q.genre, q.mTitle, q.quote  
                    FROM  quotes q  
                    LEFT JOIN  category c  ON  q.catID  =  c.catID 
                    LEFT JOIN  author a  ON  q.authID  =  a.authID  
                    WHERE  q.catID = :catID' ; 
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $cat_ID);
        $statement->execute();
        $quotes = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

    function get_api_quotesByBoth($cat_ID, $auth_ID) {
        global $db;
        $query  =  ' SELECT  q.quoteID, q.catID, c.catName, q.authID, a.authName, q.mYear, q.genre, q.mTitle, q.quote  
                    FROM  quotes q  
                    LEFT JOIN  category c  ON  q.catID  =  c.catID 
                    LEFT JOIN  author a  ON  q.authID  =  a.authID  
                    WHERE  q.catID = :catID AND q.authID = :authID'  ; 
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $cat_ID);
        $statement->bindValue(':authID', $auth_ID);
        $statement->execute();
        $quotes = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $quotes;
    }

    function get_api_categories() {
        global $db;
        $query = 'SELECT * FROM category ORDER BY catID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $categories;
    }

    function get_api_authors() {
        global $db;
        $query = 'SELECT * FROM author ORDER BY authID';
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $authors;
    }

    function add_user_quote($cat_ID, $auth_ID, $year, $genre, $title, $quote) {
        global $db;
        $query = 'INSERT INTO userquotes (catID, authID, mYear, genre, mTitle, quote)
        VALUES
           (:catID, :authID, :mYear, :genre, :mTitle, :quote)';
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $cat_ID);
        $statement->bindValue(':authID', $auth_ID);
        $statement->bindValue(':mYear', $year);
        $statement->bindValue(':genre', $genre);
        $statement->bindValue(':mTitle', $title);
        $statement->bindValue(':quote', $quote);
        $statement->execute();
        $statement->closeCursor();
    }
    
?>