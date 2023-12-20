<footer class="contacts" id="contacts" style="padding-top: 10svh;">
  <h2 class="contacts__title"><?php the_field('contacts_title', 'options'); ?></h2>

  <div class="contacts__content" style="line-height: 1.5;"><?php the_field('contacts_info', 'options'); ?></div>
  
  <div class="socials">

  <?php if(get_field('contacts_links', 'options')): ?>
  <?php while(has_sub_field('contacts_links', 'options')) : ?>
     <a href="<?php the_sub_field('contacts_link_url', 'options'); ?>"><img class="socials__icon" src="<?php the_sub_field('contacts_link_image', 'options'); ?>" alt=""
   /></a>
  <?php endwhile; ?>
  <?php endif; ?>
          </div>
        </footer>
      </main>
    </div>

    <?php wp_footer(); ?>
  </body>
</html>

