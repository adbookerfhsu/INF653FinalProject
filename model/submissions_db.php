<?php

function get_user_quotes() {
        global $db;
        $query = 'SELECT  ID, catID, authID, mYear, genre, mTitle, quote 
            FROM userquotes';
        $statement = $db->prepare($query);
        $statement->execute();
        $user_quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $user_quotes;
    }

    function add_user_quote($cat_ID, $auth_ID, $year, $genre, $title,$quote) {
        global $db;
        $query = 'INSERT INTO quotes (catID, authID, mYear, genre, mTitle, quote)
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
    
    function delete_user_quote($quote_ID) {
        global $db;
        $query = 'DELETE FROM userquotes WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $quote_ID);
        $statement->execute();
        $statement->closeCursor();
    }

?>    