<?php 
    function get_genres() {
        global $db;
        $query = 'SELECT genre FROM quotes GROUP BY genre';
        $statement = $db->prepare($query);
        $statement->execute();
        $genres = $statement->fetchAll();
        $statement->closeCursor();
        return $genres;
    }
?>