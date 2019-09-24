
			</section> <!-- END: Content article -->

			<section id="three" class="wrapper style3 special">
				<div class="inner">
					<div class="my-widgets-area">
						<?php
							// Load footer widgets
							if ( is_active_sidebar( 'footer-widgets' ) ) {
								dynamic_sidebar( 'footer-widgets' );
							} else {
								echo '<div class="container"><p class="no-widget">';
								_e( 'There\'s no widget assigned. You can start assigning widgets to "Footer" widget area from the <a href="'. admin_url('/widgets.php') .'">Widgets</a> page.', 'tonight' );
								echo '</p></div>';
							}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			</section>

		<!-- START: Footer -->
			<footer id="footer">
				<?php get_template_part( 'includes/social-media' ); ?>
				<ul class="copyright">
					<li>
						<?php printf( __('&copy; Copyright %1$s %2$s.', 'tonight' ), date_i18n('Y', strtotime( get_the_date() ) ), get_bloginfo('name') ); ?>
					</li>
					<li>
						<?php printf( __( 'WordPress Themes by %1$s.', 'asli_bejo' ), '<a href="http://aziz-rahman.com" target="_blank">'. __( 'Aziz Rahman Aji', 'asli_bejo' ) .'</a>' ); ?>
					</li><br>
					<li>
						<?php printf( __( 'Powered by %1$s.', 'tonight' ), '<a href="http://wordpress.org">'. __( 'WordPress', 'tonight' ) .'</a>' ); ?>
					</li>
				</ul>
			</footer>
		<!-- END: Footer -->
		</div> <!-- END: #page-wrapper -->

		<?php wp_footer(); ?>

	</body>
</html>