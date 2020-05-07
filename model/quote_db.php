<?php 
    function get_all_quotes($sort) {
        global $db;
        if ($sort == 'mYear'){
            $orderby = 'q.mYear';
        } else {
            $orderby = 'q.mTitle';
        }
        $query = 'SELECT q.quoteID, q.mYear, q.genre, q.mTitle, a.authName, c.catName, q.quote 
            FROM quotes q 
            LEFT JOIN category c ON q.catID = c.catID 
            LEFT JOIN author a ON q.authID = a.authID  
            ORDER BY ' .$orderby . '';
        $statement = $db->prepare($query);
        $statement->execute();
        $quotes = $statement->fetchAll();
        $statement->closeCursor();
        return $quotes;
    }

    function get_quote($quote_ID) {
        global $db;
        $query = 'SELECT * FROM quotes WHERE quoteID = :quoteID';
        $statement = $db->prepare($query);
        $statement->bindValue(':quoteID', $quote_ID);
        $statement->execute();
        $quote = $statement->fetch();
        $statement->closeCursor();
        return $quote;
    }

    function delete_quote($quote_ID) {
        global $db;
        $query = 'DELETE FROM quotes WHERE quoteID = :quoteID';
        $statement = $db->prepare($query);
        $statement->bindValue(':quoteID', $quote_ID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_quote($cat_ID, $auth_ID, $year, $genre, $title, $quote) {
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
?>