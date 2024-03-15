      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('state_bad_purchase_headline', 19003); ?>
          </h2>
          <div class="titleMain--lead">
            <p><?php echo get_field('state_bad_purchase_lead_text', 19003); ?></p>
          </div>
        </div>

        <div class="colBox colBox__col04 sp__col03">
          <?php
          if (have_rows('state_bad_purchase_repeat', 19003)) :
            while (have_rows('state_bad_purchase_repeat', 19003)) : the_row(); ?>

              <div class="col">
                <div class="img">
                  <p class="is-pc"><img src="<?php the_sub_field('state_bad_purchase_repeat_img'); ?>" alt=<?php the_sub_field('state_bad_purchase_repeat_text'); ?>></p>
                  <p class="is-sp"><img src="<?php the_sub_field('state_bad_purchase_repeat_img'); ?>" alt=<?php the_sub_field('state_bad_purchase_repeat_text'); ?>></p>
                </div>
                <p class="text text--center"><?php the_sub_field('state_bad_purchase_repeat_text'); ?></p>
              </div>
          <?php
            endwhile;
          endif;
          ?>
        </div>
      </section>