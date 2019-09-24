<?php

global $tonight_option;

if ( $tonight_option['display_comments'] ): // check on/ off display comments

    // Do not delete these lines  
    if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
        die ( _e( 'Please do not load this page directly. Thanks!', 'tonight' ) );

        if ( !empty( $post->post_password ) ) { // if there's a password
            if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) {  // and it doesn't match the cookie
    ?>
        <p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'tonight' ) ; ?></p>
    <?php
            return;
            }
        }
    ?>

    <?php if ( have_comments() ) : ?>

        <!-- START: COMMENT LIST -->
        <div class="wrapper article-widget list-comments">
            <div class="comments-widget inner">
                <h4 class="widget-title"><span><?php comments_number( __( 'No Comments', 'tonight' ), __( '1 Comment', 'tonight' ), __( '% Comments', 'tonight' ) ); ?></span></h4>
                    <ul>
                        <?php wp_list_comments( 'callback=blog_aink_comment_list' ); ?>
                    </ul>
            
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                    <div class="navigation clearfix">
                        <span class="prev"><?php previous_comments_link(__( '&larr; Previous', 'tonight' ), 0); ?></span>
                        <span class="next"><?php next_comments_link(__( 'Next &rarr;', 'tonight' ), 0); ?></span>
                    </div>  
                <?php endif; ?>

            </div>
        </div>  
        <!-- END: COMMENT LIST -->
        
    <?php else : // or, if we don't have comments: ?>      
    <?php endif; // end have_comments() ?> 

    <!-- START: Respond -->
    <?php if ( comments_open() ) : ?>
        <div class="wrapper article-widget">
            <div class="inner">
            
                <?php 
                comment_form( array(
                    'title_reply'           =>  '<h4 class="widget-title"><span>'. __( 'Leave a Comment','tonight' ) .'</span></h4>',
                    'comment_notes_before'  =>  '<div class="row uniform">',
                    'comment_notes_after'   =>  '</div>',
                    'label_submit'          =>  __( 'Submit', 'tonight' ),
                    'cancel_reply_link'     =>  __( 'Cancel Reply', 'tonight' ),
                    'logged_in_as'          =>  '<p class="logged-user">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a> &#8212; <a href="%3$s">Logout &raquo;</a>', 'tonight' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                    'fields'                => array(
                        'author'                =>  '<div class="6u 12u$(xsmall)"><input type="text" name="author" id="demo-name" class="input-s" value="" placeholder="'. __('Fullname', 'tonight') .'" /></div>',
                    'email'                 =>  '<div class="6u$ 12u$(xsmall)"><input type="text" name="email" id="demo-email" class="input-s" value=""  placeholder="'. __('Email Address', 'tonight') .'" /></div>',
                    'url'                   =>  '<div class="12u$"><input type="text" name="url" id="input-email" class="input-s" value="" placeholder="'. __('Web URL','tonight') .'" /></div>'
                                            ),
                    'comment_field'         =>  '<div class="12u$"><textarea name="comment" id="demo-message" placeholder="'. __('Message', 'tonight') .'" rows="6" /></textarea></div>',
                    'label_submit'          => __('Submit','tonight')
                    ));
                ?>

            </div>
        </div>
    <?php endif; // END: Respond ?>
<?php endif; // END: check on/ off comments ?>