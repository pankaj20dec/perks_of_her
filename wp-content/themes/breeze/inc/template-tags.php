<?php
if (!function_exists('breeze_entry_meta2')):
    function breeze_entry_meta2()
    {
        if ('post' === get_post_type()) {
            $author_avatar_size = apply_filters('breeze_author_avatar_size', 49);
            printf('<li><a class="url fn n" href="%1$s">%2$s</a></li>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), ucwords(get_the_author()));
        }
        if ('post' === get_post_type()) {

            $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'breeze'));
            if ($categories_list && breeze_categorized_blog()) {
                printf('<li>%1$s</li>', $categories_list);
            }
            $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'breeze'));
            if ($tags_list) {
                printf('<li>%1$s</li>', $tags_list);
            }
        }
    }
endif;
if (!function_exists('breeze_entry_meta')):
    function breeze_entry_meta()
    {
        if ('post' === get_post_type()) {
            $author_avatar_size = apply_filters('breeze_author_avatar_size', 49);
            printf('<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', get_avatar(get_the_author_meta('user_email'), $author_avatar_size), _x('Author', 'Used before post author name.', 'breeze'), esc_url(get_author_posts_url(get_the_author_meta('ID'))), get_the_author());
        }
        if (in_array(get_post_type(), array(
            'post',
            'attachment'
        ))) {
            breeze_entry_date();
        }
        $format = get_post_format();
        if (current_theme_supports('post-formats', $format)) {
            printf('<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>', sprintf('<span class="screen-reader-text">%s </span>', _x('Format', 'Used before post format.', 'breeze')), esc_url(get_post_format_link($format)), get_post_format_string($format));
        }
        if ('post' === get_post_type()) {
            breeze_entry_taxonomies();
        }
        if (!is_singular() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(sprintf(__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'breeze'), get_the_title()));
            echo '</span>';
        }
    }
endif;

if (!function_exists('breeze_entry_date')):
    function breeze_entry_date()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), get_the_date(), esc_attr(get_the_modified_date('c')), get_the_modified_date());
        printf('<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>', _x('Posted on', 'Used before publish date.', 'breeze'), esc_url(get_permalink()), $time_string);
    }
endif;

if (!function_exists('breeze_entry_taxonomies')):
    function breeze_entry_taxonomies()
    {
        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'breeze'));
        if ($categories_list && breeze_categorized_blog()) {
            printf('<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Categories', 'Used before category names.', 'breeze'), $categories_list);
        }
        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'breeze'));
        if ($tags_list) {
            printf('<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>', _x('Tags', 'Used before tag names.', 'breeze'), $tags_list);
        }
    }
endif;

if (!function_exists('breeze_post_thumbnail')):
    function breeze_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        if (is_singular()): ?>
            <div class="post-thumbnail">
                <?php
                    the_post_thumbnail();
                ?>
            </div><!-- .post-thumbnail -->
        <?php
        else: ?>
            <a class="post-thumbnail" href="<?php
            the_permalink(); ?>" aria-hidden="true">
            <?php the_post_thumbnail('post-thumbnail', array(
                    'alt' => the_title_attribute('echo=0')
                )); ?>
            </a>
            <?php
        endif;
    }
endif;

if (!function_exists('breeze_excerpt')):
    function breeze_excerpt($class = 'entry-summary')
    {
        $class = esc_attr($class);
        if (has_excerpt() || is_search()):
            ?>
            <div class="<?php echo $class; ?>">
                <?php the_excerpt(); ?>
            </div>
            <!-- .<?php echo $class; ?> -->
            <?php
        endif;
    }
endif;

if (!function_exists('breeze_excerpt_more') && !is_admin()):
    function breeze_excerpt_more()
    {
        $link = sprintf('<a href="%1$s" class="more-link">%2$s</a>', esc_url(get_permalink(get_the_ID())), sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'breeze'), get_the_title(get_the_ID())));
        return ' &hellip; ' . $link;
    }
    add_filter('excerpt_more', 'breeze_excerpt_more');
endif;

function breeze_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('breeze_categories'))) {
        $all_the_cool_cats = get_categories(array(
            'breeze' => 'ids',
            'number' => 2
        ));
        $all_the_cool_cats = count($all_the_cool_cats);
        set_transient('breeze_categories', $all_the_cool_cats);
    }
    if ($all_the_cool_cats > 1) {
        return true;
    } else {
        return false;
    }
}
function breeze_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    delete_transient('breeze_categories');
}
add_action('edit_category', 'breeze_category_transient_flusher');
add_action('save_post', 'breeze_category_transient_flusher');
if (!function_exists('breeze_the_custom_logo')):
    function breeze_the_custom_logo()
    {
        if (function_exists('the_custom_logo')) {
            the_custom_logo();
        }
    }
endif;
