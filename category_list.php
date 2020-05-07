<?php 
    require_once('util/valid_admin.php');
?>
<main>
    <h2>Category List for Movies</h2>
    <section>
        <?php if ( sizeof($categories) != 0) { ?>
            <table>
                <tr>
                    <th colspan="2">Name</th>
                </tr>        
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['catName']; ?></td>
                    <td>
                        <form action="admin.php" method="post">
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="catID"
                                value="<?php echo $category['catID']; ?>"/>
                            <input type="submit" value="DELETE" class="button red" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>    
            </table>
        <?php } else { ?>
            <p>
                There are no movie categories in your database.
            </p>
        <?php } ?>
    </section>
    <section>
        <h2>Add Movie Category</h2>
        <form action="admin.php" method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_category">

            <label>Category Name:</label>
            <input type="text" name="catName" max="40" required><br>

            <label id="blankLabel">&nbsp;</label>
            <input id="add_category_button" type="submit" class="button blue" value="ADD CATEGORY"><br>
        </form>
    </section>
    <?php include 'view/amyslinks.php'; ?>
</main>
