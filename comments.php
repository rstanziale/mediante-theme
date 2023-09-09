<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                /* translators: %s: post title */
                printf(_x('<p class="fw-bold text-center text-primary">1 commento a %s</p>', 'comments title', 'mediante'), get_the_title());
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '<p class="fw-bold text-center text-primary">%1$s commento a %2$s</p>',
                        '<p class="fw-bold text-center text-primary">%1$s commenti a %2$s</p>',
                        $comments_number,
                        'comments title',
                        'mediante'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <ul class="comment-list ps-0 mb-0">
            <?php wp_list_comments(array('callback' => 'mediante_comment', 'avatar_size' => 64)); ?>
        </ul>

    <?php endif; ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'commenti')) :
    ?>
        <p class="no-comments"><?php _e('Commenti non disponibili.', 'mediante'); ?></p>
    <?php endif; ?>

    <?php
    $fields = array(
        'author'    => '<div class="form-group mb-2"><input id="author" name="author" type="text" class="form-control form-control-sm" placeholder="Nome*" required="required"></div>',
        'email'     => '<div class="form-group mb-2"><input id="email" name="email" type="email" class="form-control form-control-sm" placeholder="Mail*" required="required"></div>',
        'url'       => '<div class="form-group mb-2"><input id="url" name="url" type="url" class="form-control form-control-sm" placeholder="Sito"></div>',
        'cookies'   => '<div class="form-check mb-2"><input type="checkbox" required="required" class="form-check-input" id="cookies"><label class="form-check-label" for="cookies">Ho letto e accettato l\'informativa <a class="text-muted" href="' . get_privacy_policy_url() . '">privacy</a></label></div>',
    );

    $class = $comments_number > 0 ? ' pt-4' : '';

    $args = array(
        'fields' => $fields,
        'label_submit'  => 'Invia',
        'class_submit'  => 'btn btn-sm btn-primary mt-2',
        'title_reply'   => '<p class="fw-bold text-center text-primary' . $class . '">Dialogo</p>',
        'comment_field' => '<div class="form-group mb-2"><textarea id="comment" name="comment" class="form-control form-control-sm" placeholder="Il tuo commento..." rows="8"></textarea></div>',
    );

    comment_form($args); ?>
</div>