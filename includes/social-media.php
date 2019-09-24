
<?php global $tonight_option; ?>

<!-- Start : Social buttons -->
<ul class="icons">
	<?php if ( $tonight_option['url_facebook'] ) : ?>
		<li class="facebook"><a href="<?php echo esc_url( $tonight_option['url_facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_twitter'] ) : ?>
		<li class="twitter"><a href="<?php echo esc_url( $tonight_option['url_twitter'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_gplus'] ) : ?>
		<li class="gplus"><a href="<?php echo esc_url( $tonight_option['url_gplus'] ); ?>" target="_blank"><i class="fa fa-google"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_instagram'] ) : ?>
		<li class="instagram"><a href="<?php echo esc_url( $tonight_option['url_instagram'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_linkedin'] ) : ?>
		<li class="linkedin"><a href="<?php echo esc_url( $tonight_option['url_linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_pinterest'] ) : ?>
		<li class="pinterest"><a href="<?php echo esc_url( $tonight_option['url_pinterest'] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
	<?php endif; ?>
	<?php if ( $tonight_option['url_youtube'] ) : ?>
		<li class="youtube"><a href="<?php echo esc_url( $tonight_option['url_youtube'] ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
	<?php endif; ?>
</ul>
<!-- End : Social buttons -->