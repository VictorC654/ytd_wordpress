<?php

/**
 * Registering the poem in the options table
 */
if(isset($_POST['add_poem']))
{
    $poem_content = sanitize_textarea_field($_POST['poem_content']);
    $update_response = update_option('chp_poem', $poem_content);

    if(!empty($update_response))
    {
        echo '<div class="notice notice-success"><p>Poem added successfully.</p></div>';
        exit;
    } else
    {
        echo '<div class="notice notice-error"><p>Poem could not be added.</p></div>';
    }
}

/**
 * Retrieveing the poem to display it on this page
 */
$poem = get_option('chp_poem');

?>

<div class="wrap">
    <h1>Add a New Poem</h1>
    <form method="post">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="poem_content">Poem</label>
                </th>
                <td>
                    <textarea name="poem_content" id="poem_content" rows="5" class="large-text" required></textarea>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="add_poem" class="button button-primary" value="Add">
        </p>
    </form>
    <h1>Added Poems</h1>
    <?php if ($poem) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>Poem content</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo nl2br($poem) ?>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php else : ?>
        <p>No poems found.</p>
    <?php endif; ?>
    </div>
</wrap>
