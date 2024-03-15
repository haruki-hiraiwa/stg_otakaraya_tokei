<?php
if (is_category()) :
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
else :
  $post_id = get_the_ID();
endif;
?>

<?php if (!empty(get_field('conditions_h2_ttl', $post_id))) : ?>
  <section class="brandinfo_section">
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php the_field('conditions_h2_ttl') ?>
      </h2>
    </div>
    <?php $conditions_h3_ttl = get_sub_field('conditions_h3_ttl') ?>

    <div class="brandinfo brandinfo_red_repeat">
      <?php if (have_rows('conditions_repeat', $post_id)) : ?>
        <?php while (have_rows('conditions_repeat', $post_id)) : the_row(); ?>

          <div class="brandinfo__main fshoplist-target__list open">
            <div class="brandinfo__header fshoplist-target--ttl">
              <h3 class="brandinfo__header__title"><?php the_sub_field('conditions_h3_ttl') ?></h3>
            </div>

            <div class="fshoplist-target--item brandinfo__body no--image" style="">
              <?php if (get_sub_field('conditions_h3_img')) : ?>
                <figure class="brandinfo__body__img">
                  <picture>
                    <img src="<?php the_sub_field('conditions_h3_img', $post_id); ?>" alt="<?php echo strip_tags($$conditions_h3_ttl); ?>">
                  </picture>
                </figure>
              <?php endif; ?>
              <div class="brandinfo__body__text brandinfo__body__text--top bk_icon_none">
                <?php the_sub_field('conditions_h3_text') ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>


  </section>
<?php endif; ?>