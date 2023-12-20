<?php 
/* Template Name: Main */
?>

<?php get_header(); ?>

 
 <div class="container">
      <main>
        <section class="about">
          <img class="about__img" src="<?php the_field('main_img'); ?>" alt="0" />
          <h1 class="about__title"><?php the_field('main_title'); ?></h1>
        </section>

        <section class="whoam">
          <div class="whoam__wrapper">
            <h2 class="whoam__title">Who am I</h2>
            <div class="whoam__words"> 
              <?php if( have_rows('fields_group') ): ?>
              <?php while( have_rows('fields_group') ): the_row(); ?>
                <p class="whoam__word"><?php the_sub_field('fields_subtitle_1'); ?></p>
                <p class="whoam__word"><?php the_sub_field('fields_subtitle_2'); ?></p>
                <p class="whoam__word"><?php the_sub_field('fields_subtitle_3'); ?></p>
                <p class="whoam__word"><?php the_sub_field('fields_subtitle_4'); ?></p>
              <?php endwhile; ?>
              <?php endif; ?> 
             
            </div>
          </div>
        </section>

        <section class="vision" id="vision">
          <div class="spacer"></div>

          <?php if(get_field('vision_card')): ?>
          <?php while(has_sub_field('vision_card')) : ?>
            <div class="vision__item">
              <h3 class="vision__title"><?php the_sub_field('vision_card_title'); ?></h3>

              <?php if( have_rows('vision_card_content') ): ?>
              <?php while( have_rows('vision_card_content') ): the_row(); ?>
                 <div class="vision__content">
                  <p>
                  <?php the_sub_field('vision_card_text'); ?>
                  </p>
                  <img src= "<?php the_sub_field('vision_card_image'); ?>" alt="4" />
                </div>
              <?php endwhile; ?>
              <?php endif; ?> 
            </div>
          <?php endwhile; ?>
          <?php endif; ?>
        </section>

        <a href="#" class="to-top" id="up">&#8593;</a>

        <section class="projects">
          <div class="blob"></div>
          <h2 class="projects__title"><?php the_field('projects_title'); ?></h2>
        </section>

        
          <?php 
            $args = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => '6',
              'paged' => 1,
            );
            $query = new WP_Query($args);
          ?> 
          
          <section id="projects">

          <?php if ($query->have_posts()) : ?>
         <div class="projects__wrapper">
            <?php while ($query -> have_posts()) : $query -> the_post(); ?>
          
            <div class="p__item">        
              <a href="<?php the_permalink(); ?>"
                ><img src="<?php the_field('projects_image'); ?>" alt="" />
                <p><?php the_title(); ?></p></a
              >
            </div>
              <?php endwhile; wp_reset_postdata(); ?>
          </div>
          <button id="loadmore" class="projects__btn">Load More</button>
          <?php endif; ?>
         </section> <!--.projects__wrapper-->

				<?php get_footer(); ?>
       