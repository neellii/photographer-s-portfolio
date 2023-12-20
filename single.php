<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ph-portfolio
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
    <header>
      <nav>
        <ul>
					<li><a href="javascript:history.back()" id="goback">< go back</a></li>
          <li><a href="./index.php/main#vision">about me</a></li>
          <li><a href="./index.php/main#projects">my projects</a></li>
          <li><a href="#contacts">contact</a></li>
        </ul>
      </nav>
    </header>
	<div>
	<main>
	<div id="primary" class="site-main" style="padding-top: 60px;">
		<div style="width: 90vw; margin: 0 auto;">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

			endwhile; // End of the loop.
			?>
		</div>
	</div><!-- #main -->

<?php get_footer(); ?>
