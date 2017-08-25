<?php
define('WP_USE_THEMES', true);
require($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');
get_header();
?>
<?php echo "You can insert other php between the header and footer<br>"; ?>
<?php echo "These statements are in separate php tags, so the support forum may just fit into here"; ?>
<?php get_footer(); ?>
