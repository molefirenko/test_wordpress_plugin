<?php
/*
Plugin Name: WP Bookmark Posts
Description: Bookmark posts
Version: 1.0.0
Author: Maxim Olefirenko
*/

class WP_BookmarkPosts_Plugin
{
    static $instance = false;

    private function __construct()
    {
        add_filter('the_content', array($this, 'add_bookmark_button'));
        add_action('admin_post_add_post_to_bookmark', array($this, 'action_add_post_to_bookmark'));
        add_action('admin_action_remove_from_bookmark', array($this, 'action_remove_from_bookmark'));
        add_action('admin_menu', array($this, 'bookmarked_page'));
    }

    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self;

        return self::$instance;
    }

    public function add_bookmark_button($content) {
        if ( is_singular() && in_the_loop() && is_main_query() ) {
            global $post;
            $user_id = get_current_user_id();
            $bookmarked_posts = get_user_meta($user_id, 'bookmarked_post');
            if (in_array($post->ID, $bookmarked_posts)) {
                return $content;
            }
            $content .= '<form action="'. esc_url( admin_url( 'admin-post.php' ) ) .'" method="post">';
            $content .= wp_nonce_field('add_bookmark_post_nonce');
            $content .= '<input type="hidden" name="action" value="add_post_to_bookmark" />';
            $content .= '<input type="hidden" name="user_id" value="'. $user_id .'">';
            $content .= '<input type="hidden" name="post_id" value="'. $post->ID .'">';
            $content .= '<input type="submit" value="Add to bookmark"/>';
            $content .= '</form>';

            return $content;
        } else {
            return $content;
        }
    }

    public function action_add_post_to_bookmark() {
        check_admin_referer('add_bookmark_post_nonce');
        $user_id = sanitize_key($_POST['user_id']);
        $post_id = sanitize_key($_POST['post_id']);
        add_user_meta($user_id, 'bookmarked_post', $post_id);
        $url = wp_get_referer();
        wp_redirect($url);
    }

    public function action_remove_from_bookmark() {
        check_admin_referer('remove_bookmark_post_nonce');
        $user_id = sanitize_key($_GET['user_id']);
        $post_id = sanitize_key($_GET['post_id']);
        delete_user_meta($user_id, 'bookmarked_post', $post_id);
        $url = wp_get_referer();
        wp_redirect($url);
    }

    public function bookmarked_page() {
        add_menu_page(
            'Bookmarked Posts',
            'Bookmarked Posts',
            'read',
            'bookmarked_posts',
            array($this, 'bookmarked_admin_html'),
            'dashicons-visibility',
            20
        );
    }

    public function bookmarked_admin_html() {
        $user_id = get_current_user_id();
        $bookmarked_posts = get_user_meta($user_id, 'bookmarked_post');

        ?>

        <style>
        table, th, td {
            border: 1px solid black;
        }
        </style>

        <div class="wrap">
            <h2><?php echo get_admin_page_title() ?></h2>
    
            <?php if (empty($bookmarked_posts)): ?>
                <p> Nothing to show </p>
            <?php else: ?>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($bookmarked_posts as $post_id): $post = get_post($post_id); ?>
                    <tr>
                        <td><img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail') ?>" /></td>
                        <td><?php echo get_the_title($post); ?></td>
                        <td><?php echo get_the_excerpt($post); ?></td>
                        <td>
                            <form action="<?php echo admin_url( 'admin.php' ); ?>">
                                <?php wp_nonce_field('remove_bookmark_post_nonce'); ?>
                                <input type="hidden" name="action" value="remove_from_bookmark" />
                                <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
                                <input type="hidden" name="post_id" value="<?php echo $post_id ?>" />
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        
        <?php        
    }
}

$WP_BookmarkPost = WP_BookmarkPosts_Plugin::getInstance();
