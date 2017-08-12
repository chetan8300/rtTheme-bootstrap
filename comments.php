<div class="comments">
    <?php if(have_comments()): ?>
        <h3 class="comment-title">
            <?php   if(get_comments_number() == 1) {
                        echo get_comments_number(). ' Comment';
                    }
                    else {
                        echo get_comments_number(). ' Comments';
                    }
            ?>
        </h3>
        <ul class="row comment-list">
            <?php 
                wp_list_comments(array(
                    'avatar_size'   => 90,
                    'callback'      => 'add_theme_comments',
                ));
            ?>
        </ul>
    <?php endif; ?>
    
    <?php
        //If Comments are closed and there are comments 
        if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
    
    <p class="no-comments"><?php _e('Comments are closed', 'dazzling')?></p>
    
    <?php 
        endif;
    ?>
</div>

<hr>


<?php
        $aria_req = "aria-required='true'";
    $fields =  array(

      'author' =>
        '<p class="comment-form-author"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></p>',

      'email' =>
        '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></p>',

      'url' =>
        '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
        '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></p>',
        
    );

    $comment_args = array(
        //Change the title of send button
        'label_submit'  => 'Send',
        // Change class of submit button
        'class_submit'  => 'btn btn-primary form-control',
        //Change the title of reply section
        'title_reply'   => 'Write a Reply or Comment',
        //remove 'Text or HTML to be displayed after the set of comment field'
        'comment_notes_after'   => '',
        //redfine your own textarea (Comment Body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">'._x( 'Comment', 'noun' ).'</label><br />'
        . '<textarea class="form-control" id="comment" name="comment" area-required="true" rows=5 cols=50></textarea></p>',
        //
        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
        
    );
    
    comment_form($comment_args);