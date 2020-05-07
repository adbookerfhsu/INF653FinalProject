<?php 
    require_once('util/valid_admin.php');
?>
<main>
    <p>"Your future hasn't been written yet. No one's has. Your future is whatever you make it. So make it a good one. ~Doc Brown, Back to the Future, 1985."
    <section>
        <?php if( sizeof($user_quotes) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Movie Year</th>
                            <th>Genre</th>
                            <th>Movie Title</th>
                            <th>Quote</th>
                            <th>Approve</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($user_quotes as $user_quote) : ?>
                        <tr>
                        <form action="admin.php" method="post">
                            <input type="hidden" name="action" value="add_user_quote">
                            <td><?php echo $user_quote['catID']; ?></td>
                            <input type="hidden" name="catID" value="<?php echo $user_quote['catID']; ?>">
                            <td><?php echo $user_quote['authID']; ?></td>
                            <input type="hidden" name="authID" value="<?php echo $user_quote['authID']; ?>">
                            <td><?php echo $user_quote['mYear']; ?></td>
                            <input type="hidden" name="mYear" value="<?php echo $user_quote['mYear']; ?>">
                            <td><?php echo $user_quote['genre']; ?></td>
                            <input type="hidden" name="genre" value="<?php echo $user_quote['genre']; ?>">
                            <td><?php echo $user_quote['mTitle']; ?></td>
                            <input type="hidden" name="mTitle" value="<?php echo $user_quote['mTitle']; ?>">
                            <td><?php echo $user_quote['quote']; ?></td>
                            <input type="hidden" name="quote" value="<?php echo $user_quote['quote']; ?>">
                            <td>
                            <input type="submit" value="ADD" class="button red"></td>
                        </form>
                            <td>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="action" value="delete_user_quote">
                                    <input type="hidden" name="ID"
                                        value="<?php echo $user_quote['ID']; ?>">
                                    <input type="submit" value="DELETE" class="button red">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                            
                        
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching user quotes in Amy&apos;s list. 
            </p>     
        <?php } ?>
    </section>
    <?php include 'view/amyslinks.php'; ?>
</main>
<script defer src="view/js/main.js" type="text/javascript"></script>