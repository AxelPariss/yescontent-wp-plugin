<?php

function yescontent_register_settings()
{
    register_setting('yescontent_options_group', 'yescontent_post_type');
}

function yescontent_register_options_page()
{
    add_options_page(
        'YesContent',
        'YesContent',
        'manage_options',
        'yescontent',
        'yescontent_options_page'
    );
}
add_action('admin_menu', 'yescontent_register_options_page');
add_action('admin_init', 'yescontent_register_settings');

function yescontent_options_page()
{
    $post_types = get_post_types([], 'objects'); ?>
    
    <div>
        <h2>Réglages YesContent</h2>
        <form method="post" action="options.php">
            <?php settings_fields('yescontent_options_group'); ?>
            <table style="width: 100%; font-size: 13px">
               
                <tr valign="top">
                    <th scope="row"><label for="yescontent_post_type">Post Type</label></th>
										<td>
										<select id="yescontent_post_type" name="yescontent_post_type">
                        <?php foreach ($post_types as $post_type): ?>
                        <option value="<?= $post_type->name ?>" <?= get_option(
    'yescontent_post_type'
) == $post_type->name
    ? 'selected'
    : '' ?>><?= $post_type->name ?></option>
                        <?php endforeach; ?>
                    </select>
										</td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
} ?>
