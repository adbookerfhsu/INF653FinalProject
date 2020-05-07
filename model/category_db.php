<?php 
    function get_categories() {
        global $db;
        $query = 'SELECT * FROM category ORDER BY catID';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function get_category_name($cat_ID) {
        if ($cat_ID == NULL || $cat_ID == FALSE) {
            return NULL;
        }
        global $db;
        $query = 'SELECT * FROM category WHERE catID = :catID';
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $cat_ID);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        $category_name = $category['catName'];
        return $category_name;
    }

    function delete_category($cat_ID) {
        global $db;
        $query = 'DELETE FROM category WHERE catID = :catID';
        $statement = $db->prepare($query);
        $statement->bindValue(':catID', $cat_ID);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($cat_name) {
        global $db;
        $query = 'INSERT INTO category (catName)
              VALUES
                 (:catName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':catName', $cat_name);
        $statement->execute();
        $statement->closeCursor();
    }
?>