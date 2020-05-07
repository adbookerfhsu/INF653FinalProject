<?php 
    require_once('util/valid_admin.php');
?>
<main>
    <h2>Add Quote:</h2>
    <p>"Gentlemen, I wash my hands of this weirdness", <br>~Jack Sparrow, Pirates of the Caribbean At World's End, 2007.</p>
    <p id="add_quote_instruct">If the author or category do not match one listed in the dropdown menu, please visit the View/Edit page for that section before adding your quote. (Since quotes from Movies are the intellectual property of the screenwriters, the author is considered the character that said the line in the movie, not the actor that starred as the character.)</p>
    <form action="admin.php" method="post" id="add_quote_form">
        <input type="hidden" name="action" value="add_quote">

        <label>Author (The character that said the quote):</label>
        <br>
        <select name="authID">
        <?php foreach ($authors as $author) : ?>
            <option value="<?php echo $author['authID']; ?>">
                <?php echo $author['authName']; ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label>Category (Humor, Wisdom, Politics, Life Lessons, etc.):</label>
        <br>
        <select name="catID">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category['catID']; ?>">
                <?php echo $category['catName']; ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label for="mYear">Year the Movie was Released:</label>
        <br>
        <input type="year" name="mYear" min="1920" max="2100" maxlength="4" pattern="[0-9]{1,5}" required><br>

        <label for="genre">Genre (Sci Fi, Animation, Documentary, Romance, Adventure, Action, Fantasy, etc):</label>
        <br>
        <input type="text" name="genre" maxlength="75" required><br>

        <label for="mTitle">Movie Title:</label>
        <br>
        <input type="text" name="mTitle" maxlength="100" required><br>

        <label for="quote">Movie Quote:</label>
        <br>
        <input type="text" name="quote" maxlength="255" required><br>

        <label id="blankLabel">&nbsp;</label>
        <input type="submit" value="ADD QUOTE" class="button blue"><br>
    </form>
    <?php include 'view/amyslinks.php'; ?>
</main>
