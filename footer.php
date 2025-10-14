<?php
/**
 * The footer template.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

		<?php heightwind_footer_before(); ?>

		</div><!-- /.content-wrapper -->

		<footer class="footer content-wrapper" role="contentinfo">

			<div class="footer-content">

				<?php heightwind_footer(); ?>

			</div><!-- /.footer-content -->

		</footer>

		<?php heightwind_footer_after(); ?>

	</div><!-- /.inner-wrap -->

</div><!-- /.outer-wrap -->

<?php heightwind_body_bottom(); ?>

<?php wp_footer(); ?>

</body>
</html>