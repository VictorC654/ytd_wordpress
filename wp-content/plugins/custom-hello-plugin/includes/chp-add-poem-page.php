<?php

// adding a new poem
if(isset($_POST['add_poem']))
{
    $content = sanitize_textarea_field($_POST['poem_content']);

    $poems = get_option('chp_poems');

    if ( !$poems ) {
        $poems = [];
    }
    $poems[] = $content;

    $response = update_option( 'chp_poems', $poems );

    if($response)
    {
        add_post_meta($response, 'poem_content', $content);
        echo '<div class="notice notice-success"><p>Poem added successfully.</p></div>';
        exit;
    }
    else
    {
        echo '<div class="notice notice-error"><p>Poem could not be added.</p></div>';
    }
}

// fetching all poems
$poems = get_option('chp_poems');

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
    <?php if ($poems) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>Poem content</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($poems as $poem) : ?>
                <tr>
                    <td><?php echo nl2br($poem) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No poems found.</p>
    <?php endif; ?>
    </div>
</wrap>
