<?php
/**
 * Popular Posts Widgets
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'my_popular_post' );

// Register our widget
function my_popular_post() {
	register_widget( 'Wp_popular_posts' );
}

// Widgets Latest Video Widget
class Wp_popular_posts extends WP_Widget {

	//  Setting up the widget
	function Wp_popular_posts() {
		$widget_ops  = array( 'classname' => 'widgets_popular_post', 'description' => __( 'Display popular articles post type.', 'tonight' ) );
		$control_ops = array( 'id_base' => 'widgets_popular_post' );

		parent::__construct( 'widgets_popular_post', __( 'Widgets Popular Posts', 'tonight' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $tonight_option;
		
		extract( $args );

		$widgets_popular_post_title = apply_filters('widget_title', empty( $instance['widgets_popular_post_title'] ) ? __( '', 'tonight' ) : $instance['widgets_popular_post_title'], $instance, $this->id_base );
		$widgets_popular_post_count = !empty( $instance['widgets_popular_post_count'] ) ? absint( $instance['widgets_popular_post_count'] ) : 3;
		$my_wp_popular_title_limiter = !empty( $instance['my_wp_popular_title_limiter'] ) ? absint( $instance['my_wp_popular_title_limiter'] ) : 10;

		if ( ! $widgets_popular_post_count )
 			$widgets_popular_post_count = 3;

		echo $before_widget; ?>
        	<?php echo $before_title . $widgets_popular_post_title . $after_title; ?>
		 	<div class="inner-widget">
				<ul>
					<?php
					global $post;
					// Get the posts from database
					$args = array(
						'post_type' 			=> 'post',
						'post_status' 			=> 'publish',
						'ignore_sticky_posts' 	=> 1,
						'meta_key' 				=> 'post_views_count',
						'orderby' 				=> 'meta_value_num',
						'meta_query' 			=> array(
													array(
														'key'  => 'post_views_count'
													),
												),	
						'order'					=> 'desc',
						'posts_per_page' 		=> $widgets_popular_post_count
					);

					$wp_query = new WP_Query();
					$wp_query->query( $args );
				       
				    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<li>
			    			<article class="popular-post clearfix">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="thumbnail">
										<?php the_post_thumbnail( 'small-thumb' ); ?>
									</div>
								<?php endif; ?>

								<div class="detail">
									<div class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $my_wp_popular_title_limiter .' ...' ); ?></a></div>
									<div class="entry-meta">
										<span><?php echo date_i18n( 'F d, Y', strtotime( get_the_date('Y-m-d'), false ) ); ?></span>
									</div>
								</div>
							</article>
						</li>
					<?php endwhile; else: _e( 'Not have popular posts !', 'tonight' ); endif; ?>
				</ul>
			</div>
		<?php echo $after_widget;

		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['widgets_popular_post_title'] 	= strip_tags( $new_instance['widgets_popular_post_title'] );
		$instance['widgets_popular_post_count']  	= (int) $new_instance['widgets_popular_post_count'];
		$instance['my_wp_popular_title_limiter']  	= (int) $new_instance['my_wp_popular_title_limiter'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'widgets_popular_post_title' => __( 'Popular Posts', 'tonight' ), 'widgets_popular_post_count' => '3', 'my_wp_popular_title_limiter' => '10') );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'widgets_popular_post_title' ); ?>"><?php _e( 'Widget Title:', 'tonight' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'widgets_popular_post_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'widgets_popular_post_title' ); ?>" value="<?php echo esc_attr( $instance['widgets_popular_post_title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'widgets_popular_post_count' ); ?>"><?php _e('Number of posts to show:', 'tonight'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'widgets_popular_post_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'widgets_popular_post_count' ); ?>" value="<?php echo esc_attr( $instance['widgets_popular_post_count'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'my_wp_popular_title_limiter' ); ?>"><?php _e('Post Title Limiter', 'tonight'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'my_wp_popular_title_limiter' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'my_wp_popular_title_limiter' ); ?>" value="<?php echo esc_attr( $instance['my_wp_popular_title_limiter'] ); ?>" />
            <p><small><?php _e( 'The post title will be trim after reaching the number of characters defined.', 'tonight' ); ?></small></p>
        </p>
	<?php
	}
}
?>