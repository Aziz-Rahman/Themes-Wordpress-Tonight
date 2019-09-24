
<?php 

get_header(); 

//global $tonight_option; ?>

<!-- START: Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post hentry spotlight' ); ?>>
	<div class="image">
		<img class="wp-post-image" src="<?php echo $tonight_option['404_image']['url']; ?>" alt="" />
	</div>

	<div class="content">
		<header class="head-article">
			<h1 class="post-title"><?php _e( 'Page Not Found !', 'tonight' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'The page you are looking for is not available. The page may have been deleted or unpublished.', 'tonight' ); ?></p>
		</div>
	</div> <!-- END: class content -->

</article>
<!-- END: Article -->

<?php get_footer(); ?>