<?php
/**
 * The sidebar template.
 * @package heightwind
 * @since 2.0.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php heightwind_sidebar_before(); ?>

<aside class="sidebar" role="complementary">

	<?php heightwind_sidebar_top(); ?>

	<?php dynamic_sidebar( 'primary-sidebar' ); ?>

	<?php heightwind_sidebar_bottom(); ?>

</aside>

<?php heightwind_sidebar_after(); ?>