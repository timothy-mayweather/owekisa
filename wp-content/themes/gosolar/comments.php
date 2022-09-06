<?php
/**
 * Comments Template
 *
 * This template file used to display comments, pingbacks, trackbacks and comment form.
 *
 * @package Zozothemes
 */

 
if( post_password_required() ) { ?>
	<p class="zozo-no-comments">
		<?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'gosolar' ); ?>
	</p>
	<?php return;	
} ?>
<div id="comments" class="comments-section">
	<?php if ( have_comments() ) {
		$post_id = get_the_ID(); ?>
	
		<div class="comments-title">
			<h3><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'gosolar' ), number_format_i18n( get_comments_number() ) ); ?></h3>
		</div>
			
		<ul class="zozo-all-comments list-unstyled">
			<?php
				wp_list_comments( array(
					'style'       => 'li',					
					'avatar_size' => 75,
					'callback'    => 'gosolar_custom_comments'
				) );
			?>
		</ul><!-- .comment-list -->
		
		<?php // Comment pagination.
		 	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="navigation comment-nav">
				<ul class="pager comment-pager">
					<li class="previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'gosolar' ) ); ?></li>
                	<li class="next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'gosolar' ) ); ?></li>
				</ul>				
			</div><!-- .navigation -->
		<?php } ?>	
		
	<?php } // have_comments()
	else { 
	
		if ( comments_open() ) {
			// Comments are open ?>
			<h3 class="no-comments"><?php esc_html_e( 'No comments yet.', 'gosolar' ); ?></h3>
		 <?php } else { 
			// Comments are closed ?>
			<!--<h3 class="no-comments"><?php // esc_html_e('Comments are closed.', 'gosolar'); ?></h3>-->
	
		<?php }
		
	} ?>
		
</div><!-- #comments -->
<?php
$commenter = '';
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$required_text = '';
$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => esc_html__( 'Leave a comment', 'gosolar' ),
  'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'gosolar' ),
  'cancel_reply_link' => esc_html__( 'Cancel Comment', 'gosolar' ),
  'label_submit'      => esc_html__( 'Send Comment', 'gosolar' ),
  
  'comment_field' =>  '<div class="comment-form-comment form-group">'.
    '<textarea id="comment" class="form-control" name="comment" cols="45" rows="5" placeholder="'. esc_html__('Your comment', 'gosolar') .'" aria-required="true">' .
    '</textarea></div>',
  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      '%1$s <a href="%2$s">%3$s</a> %4$s',
	  esc_html__( 'You must be', 'gosolar' ),
      esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ),
	  esc_html__( 'logged in', 'gosolar' ),
	  esc_html__( 'to post a comment.', 'gosolar' )
    ) . '</p>',
  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
		'%1$s <a href="%2$s">%3$s</a>. <a href="%4$s" title="%5$s">%6$s?</a>',
		esc_html__( 'Logged in as', 'gosolar' ),
		esc_url( admin_url( 'profile.php' ) ),
		esc_html( $user_identity ),
		esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ),
		esc_html__( 'Log out of this account', 'gosolar' ),
		esc_html__( 'Log out', 'gosolar' )
	) . '</p>',
  'comment_notes_before' => '<p class="comment-notes">' .
    esc_html__( 'Your email address will not be published.', 'gosolar' ) . ( $req ? $required_text : '' ) .
    '</p>',
  'comment_notes_after' => '',
  'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' =>
      '<div class="comment-form-author form-group"><div class="input-group"><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="'. esc_html__('Your name', 'gosolar') . ( $req ? ' *' : '' ).'" size="30"' . $aria_req . ' /></div></div>',
    'email' =>
      '<div class="comment-form-email form-group"><div class="input-group"><input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="'. esc_html__('Your email', 'gosolar') . ( $req ? ' *' : '' ).'" size="30"' . $aria_req . ' /></div></div>',
    'url' =>
      '<div class="comment-form-url form-group"><div class="input-group"><input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'. esc_html__('Your website', 'gosolar') .'" size="30" /></div></div>'
    )
  ),
);
comment_form( $args ); ?>