<?php
/**
 * The template for displaying the footer.
 *
 * @package Zozothemes
 */
?>
	</div><!-- #main -->
	
	<?php
		/**
		 * @hooked - gosolar_featured_post_slider - 5
		 * @hooked - gosolar_footer_hidden_wrapper_end - 20
		**/
		do_action('gosolar_header_wrapper_end');
	?>
	
	<?php
		/**
		 * @hooked - gosolar_footer_wrapper - 10
		**/
		do_action('gosolar_footer_wrapper_start');
	?>
	
	</div><!-- .zozo-main-wrapper -->
</div><!-- #zozo_wrapper -->
<?php do_action('gosolar_after_page_wrapper'); ?>
	
<?php wp_footer(); ?>
</body>
</html>