<?php

global $tonight_option;

if ( $tonight_option['share_buttons'] ) : ?>
	<!-- Start: Share Buttons -->
	<div class="share-button">
		<h4 class="widget-title"><?php _e( 'Share this article', 'tonight' ); ?></h4>
		<ul class="icons">
			<li class="facebook"><a class="zocial facebook" title="<?php _e( 'Facebook Share', 'tonight' ); ?>" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;t=<?php echo str_replace( ' ', '%20', get_the_title() ); ?>"><i class="fa fa-facebook"></i></a></li>

			<li class="twitter"><a class="zocial twitter" title="<?php _e( 'Twitter Share', 'tonight' ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;shortened_url=<?php echo get_home_url() .'/?p='. $post->ID; ?>&amp;text=<?php echo str_replace( ' ', '%20', get_the_title() ); ?>"><i class="fa fa-twitter"></i></a></li>

			<li class="gplus"><a class="zocial googleplus" title="<?php _e( 'Google+ Share', 'tonight' ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-google-plus"></i></a></li>

			<li class="pinterest"><a class="zocial pinterest" title="<?php _e( 'Pinterest Share', 'tonight' ); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?source_url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-pinterest"></i></a></li>
		</ul>
	</div>
	<!-- End: Share Buttons -->
<?php endif; ?>
<div class="clearfix"></div>