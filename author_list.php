<?php 
    require_once('util/valid_admin.php');
?>
<main>
    <h2>List of Authors - Admin</h2>
    <p>"somequote here"</p>
    <section>
        <?php if ( sizeof($authors) != 0) { ?>
            <table>
                <tr>
                    <th colspan="2">Name</th>
                </tr>        
                <?php foreach ($authors as $author) : ?>
                <tr>
                    <td><?php echo $author['authName']; ?></td>
                    <td>
                        <form action="admin.php" method="post">
                            <input type="hidden" name="action" value="delete_author">
                            <input type="hidden" name="authID"
                                value="<?php echo $author['authID']; ?>"/>
                            <input type="submit" value="DELETE" class="button red" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>    
            </table>
        <?php } else { ?>
            <p>
                There are no authors in your database.
            </p>
        <?php } ?>
    </section>
    <section>
        <h2>Add Author</h2>
        <form action="admin.php" method="post" id="add_author_form">
            <input type="hidden" name="action" value="add_author">

            <label>Name:</label>
            <input type="text" name="authName" max="30" required><br>

            <label id="blankLabel">&nbsp;</label>
            <input id="add_author_button" type="submit" class="button blue" value="ADD AUTHOR"><br>
        </form>
    </section>
    <?php include 'view/amyslinks.php'; ?>
</main>