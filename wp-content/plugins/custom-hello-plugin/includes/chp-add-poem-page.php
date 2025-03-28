<?php

// adding a new poem
if(isset($_POST['add_poem']))
{
    $content = sanitize_textarea_field($_POST['poem_content']);

    $poem_post = array(
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'poem',
    );

    $post_id = wp_insert_post($poem_post);

    if($post_id)
    {
        add_post_meta($post_id, 'poem_content', $content);
        echo '<div class="notice notice-success"><p>Poem added successfully.</p></div>';
        exit;
    }
    else
    {
        echo '<div class="notice notice-error"><p>Poem could not be added.</p></div>';
    }
}

// fetching all poems

$queryArgs = array(
    'post_type' => 'poem',
    'post_status' => 'publish',
    'posts_per_page' => -1, // Display all poems
);
$poem_query = new WP_Query($queryArgs);

wp_reset_postdata();
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
    <?php if ($poem_query->have_posts()) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
            <tr>
                <th>Poem content</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($poem_query->have_posts()) : $poem_query->the_post(); ?>
                <tr>
                    <td><?php the_content(); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No poems found.</p>
    <?php endif; ?>
    </div>
</wrap>
