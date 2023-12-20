<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ph-portfolio
 */

?>

	<div class="entry-header">
		<?php

		if ( 'post' === get_post_type() ) :
			?>
		<?php endif; ?>
	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$phrase = get_the_content();
    $phrase = apply_filters('the_content', $phrase);
    $replace = '<p style="margin-top: 10px;">';

    echo str_replace('<p>', $replace, $phrase);
		?>

	</div><!-- .entry-content -->




