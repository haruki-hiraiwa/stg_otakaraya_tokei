      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('otakaraya_purchase_goods_headline', 19091); ?>
          </h2>
        </div>
        <div class="colBox colBox__col04 sp__col03">
          <?php
          if (have_rows('otakaraya_purchase_goods_repeat', 19091)) :
            while (have_rows('otakaraya_purchase_goods_repeat', 19091)) : the_row();

          ?>
              <div class="col">
                <a href="<?php the_sub_field('otakaraya_purchase_goods_repeat_url'); ?>" class="img__link">
                  <div class="img">
                    <p class="is-pc"><img src="<?php the_sub_field('otakaraya_purchase_goods_repeat_img'); ?>" alt=　<?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?>></p>
                    <p class="is-sp"><img src="<?php the_sub_field('otakaraya_purchase_goods_repeat_img'); ?>" alt=　<?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?>></p>
                  </div>
                  <p class="text text--center"><?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?></p>
                </a>
              </div>
          <?php
            endwhile;
          endif;
          ?>

        </div>
      </section>