<?php 
    function get_authors() {
        global $db;
        $query = 'SELECT * FROM author ORDER BY authID';
        $statement = $db->prepare($query);
        $statement->execute();
        $authors = $statement->fetchAll();
        $statement->closeCursor();
        return $authors;
    }

    function get_author_name($auth_ID) {
        if ($auth_ID == NULL || $auth_ID == FALSE) {
            return NULL;
        }
        global $db;
        $query = 'SELECT * FROM author WHERE authID = :authID';
        $statement = $db->prepare($query);
        $statement->bindValue(':authID', $auth_ID);
        $statement->execute();
        $author = $statement->fetch();
        $statement->closeCursor();
        $auth_name = $author['authName'];
        return $auth_name;
    }

    function delete_author($auth_ID) {
        global $db;
        $query = 'DELETE FROM author WHERE authID = :authID';
        $statement = $db->prepare($query);
        $statement->bindValue(':authID', $auth_ID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_author($auth_name) {
        global $db;
        $query = 'INSERT INTO author (authName)
              VALUES
                 (:authName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':authName', $auth_name);
        $statement->execute();
        $statement->closeCursor();
    }

?>