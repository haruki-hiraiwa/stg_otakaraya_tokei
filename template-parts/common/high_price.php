      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('high_price_headline', 19004); ?>
          </h2>
          <div class="titleMain--lead">
            <p><?php echo get_field('high_price_lead_text', 19004); ?></p>
          </div>
        </div>
        <div class="horizonlist">
          <?php
          if (have_rows('high_price_repeat', 19004)) :
            while (have_rows('high_price_repeat', 19004)) : the_row(); ?>

              <div class="horizonlist--link">
                <div class="horizonlist--img"><img src="<?php the_sub_field('high_price_repeat_img'); ?>" alt=<?php echo strip_tags(get_sub_field('high_price_repeat_headline')); ?>></div>
                <div class="horizonlist--text">
                  <h4 class="titleH4 title--left"><?php the_sub_field('high_price_repeat_headline'); ?></h4>
                  <p><?php the_sub_field('high_price_repeat_method'); ?></p>
                </div>
              </div>
          <?php
            endwhile;
          endif;
          ?>
        </div>

      </section>