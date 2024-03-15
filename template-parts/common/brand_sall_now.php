<section class="section-reason">
  <?php if (!empty(get_field('brand_sall_now_headline', 19002))) : ?>
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php echo get_field('brand_sall_now_headline', 19002); ?>
      </h2>
      <div class="titleMain--lead">
        <p><?php echo get_field('brand_sall_now_lead_text', 19002); ?></p>
      </div>
    </div>
  <?php endif; ?>

  <div class="horizonlist">

    <?php
    if (have_rows('brand_sall_now_repeat', 19002)) :
      while (have_rows('brand_sall_now_repeat', 19002)) : the_row(); ?>
        <?php if (!empty(get_sub_field('brand_sall_now_repeat_headline'))) : ?>

          <div class="horizonlist--link">
            <div class="horizonlist--img"><img src="<?php the_sub_field('brand_sall_now_repeat_img'); ?>" alt=""></div>
            <div class="horizonlist--text">
              <h4 class="titleH4 title--left"><?php echo nl2br(get_sub_field('brand_sall_now_repeat_headline')); ?></h4>
              <p><?php the_sub_field('brand_sall_now_repeat_text'); ?></p>
            </div>
          </div>
        <?php endif; ?>
    <?php
      endwhile;
    endif;
    ?>
  </div>

  <?php get_template_part('/template-parts/cta/cta01'); ?>
  <?php get_template_part('/template-parts/cta/cta02'); ?>

</section>