<?php
/**
 * The template for displaying comments
 *
 * @package kreators
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="kr-comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="kr-comments-title">
            <?php kreators_icon('message-circle'); ?>
            <?php
            $kreators_comment_count = get_comments_number();
            if ('1' === $kreators_comment_count) {
                printf(
                    esc_html__('1 Comment', 'kreators')
                );
            } else {
                printf(
                    esc_html(_n('%s Comment', '%s Comments', $kreators_comment_count, 'kreators')),
                    number_format_i18n($kreators_comment_count)
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="kr-comments-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'callback'    => 'kreators_comment_callback',
                'avatar_size' => 60,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note
        if (!comments_open()) :
        ?>
            <p class="kr-comments-closed">
                <?php kreators_icon('lock'); ?>
                <?php esc_html_e('Comments are closed.', 'kreators'); ?>
            </p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    // Comment Form
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true' required" : '');

    $fields = array(
        'author' => sprintf(
            '<div class="kr-comment-field kr-comment-field-author"><label for="author">%s%s</label><input id="author" name="author" type="text" value="%s" placeholder="%s" %s /></div>',
            esc_html__('Name', 'kreators'),
            ($req ? ' <span class="required">*</span>' : ''),
            esc_attr($commenter['comment_author']),
            esc_attr__('Your name', 'kreators'),
            $aria_req
        ),
        'email' => sprintf(
            '<div class="kr-comment-field kr-comment-field-email"><label for="email">%s%s</label><input id="email" name="email" type="email" value="%s" placeholder="%s" %s /></div>',
            esc_html__('Email', 'kreators'),
            ($req ? ' <span class="required">*</span>' : ''),
            esc_attr($commenter['comment_author_email']),
            esc_attr__('your@email.com', 'kreators'),
            $aria_req
        ),
        'url' => sprintf(
            '<div class="kr-comment-field kr-comment-field-url"><label for="url">%s</label><input id="url" name="url" type="url" value="%s" placeholder="%s" /></div>',
            esc_html__('Website', 'kreators'),
            esc_attr($commenter['comment_author_url']),
            esc_attr__('https://yourwebsite.com', 'kreators')
        ),
    );

    $comments_args = array(
        'fields' => $fields,
        'class_form' => 'kr-comment-form',
        'title_reply' => __('Leave a Comment', 'kreators'),
        'title_reply_to' => __('Reply to %s', 'kreators'),
        'title_reply_before' => '<h3 id="reply-title" class="kr-comment-reply-title">',
        'title_reply_after' => '</h3>',
        'cancel_reply_before' => '',
        'cancel_reply_after' => '',
        'cancel_reply_link' => __('Cancel Reply', 'kreators'),
        'comment_field' => sprintf(
            '<div class="kr-comment-field kr-comment-field-message"><label for="comment">%s <span class="required">*</span></label><textarea id="comment" name="comment" rows="6" placeholder="%s" aria-required="true" required></textarea></div>',
            esc_html__('Comment', 'kreators'),
            esc_attr__('Write your comment here...', 'kreators')
        ),
        'comment_notes_before' => '<p class="kr-comment-notes">' . esc_html__('Your email address will not be published. Required fields are marked *', 'kreators') . '</p>',
        'submit_button' => '<button type="submit" name="%1$s" id="%2$s" class="kr-btn kr-btn-primary">%4$s</button>',
        'submit_field' => '<div class="kr-comment-form-submit">%1$s %2$s</div>',
        'label_submit' => __('Post Comment', 'kreators'),
    );

    comment_form($comments_args);
    ?>
</div>
