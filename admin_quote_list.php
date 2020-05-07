<?php 
    require_once('util/valid_admin.php');
?>
<main>
    <p>"Your future hasn't been written yet. No one's has. Your future is whatever you make it. So make it a good one. ~Doc Brown, Back to the Future, 1985."</p>
    <nav>
    <br>
        <form action="admin.php" method="get" id="make_selection">
            <!-- dropdown menus for user selection -->
            <section id="dropmenus">
                <?php if ( sizeof($genres) != 0) { ?>
                    <label>Genres:</label>
                    <select name="make">
                        <option value="0">View All Genres</option>
                        <?php foreach ($genres as $genre) : ?>
                            <option value="<?php echo $genre['genre']; ?>" <?php echo ($genre_name == $genre['genre'] ? "selected" : false)?>>
                                <?php echo $genre['genre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
                <br>
                <?php if ( sizeof($authors) != 0) { ?>
                    <label>Authors:</label>
                    <select name="authID">
                        <option value="0">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['authID']; ?>" <?php echo ($auth_name == $author['authName'] ? "selected" : false)?>>
                                <?php echo $author['authName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
                <br>
                <?php if ( sizeof($categories) != 0) { ?>
                    <label>Categories:</label>
                    <select name="catID">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['catID']; ?>" <?php echo ($cat_name == $category['catName'] ? "selected" : false)?>>
                                <?php echo $category['catName']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
            </section>
            <br>
            <section id="sortBy">
                <div>
                    <!-- sort function -->
                    <span>Sort by: </span>
                    <input type="radio" id="sortBymYear" name="sort" value="mYear" <?php echo ($sort == "mYear" ? "checked" : false)?>>
                    <label for="sortBymYear">Movie Year</label>
                    <input type="radio" id="sortBymTitle" name="sort" value="mTitle" <?php echo ($sort == "mTitle" ? "checked" : false)?>>
                    <label for="sortBymTitle">Movie Title</label> 
                    <input type="submit" value="SEARCH" class="button blue button-slim">
                    <input id="resetVehicleListForm" type="reset" value= "RESET" class="button red button-slim">
                    </div>
            </section>
        </form>
        <br>
    </nav>
    <section>
        <?php if( sizeof($quotes) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Genre</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Title</th>
                            <th>Quote</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($quotes as $quote) : ?>
                        <tr>
                            <?php if (empty($quote['catName'])) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $quote['catName']; ?></td>
                            <?php } ?>
                            <td><?php echo $quote['genre']; ?></td>
                            <?php if (empty($quote['authName'])) { ?>
                                <td>None</td>
                            <?php } else { ?>
                                <td><?php echo $quote['authName']; ?></td>
                            <?php } ?>
                            <td><?php echo $quote['mYear']; ?></td>
                            <td><?php echo $quote['mTitle']; ?></td>
                            <td><?php echo $quote['quote']; ?></td>
                            <td>
                                <form action="admin.php" method="post">
                                    <input type="hidden" name="action" value="delete_quote">
                                    <input type="hidden" name="quoteID"
                                        value="<?php echo $quote['quoteID']; ?>">
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
                There are no matching quotes in Amy&apos;s list. 
            </p>     
        <?php } ?>
    </section>
    <?php include 'view/amyslinks.php'; ?>
</main>
<script defer src="view/js/main.js" type="text/javascript"></script>