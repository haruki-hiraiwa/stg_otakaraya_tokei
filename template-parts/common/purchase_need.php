      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php the_field('purchase_need_item_headline', 18955); ?>
          </h2>
          <div class="titleMain--lead">
            <p><?php the_field('purchase_need_item_lead_text', 18955); ?></p>
          </div>
        </div>


        <section>
          <?php the_field('purchase_need_item_text', 18955); ?>

          <div class="colBox colBox__col04 sp__col03">

            <?php if (have_rows('purchase_need_item_repeat', 18955)) : ?>
              <?php while (have_rows('purchase_need_item_repeat', 18955)) : the_row();
              ?>
                <div class="col">
                  <div class="img">
                    <p class="is-pc"><img src="<?php the_sub_field('purchase_need_item_repeat_img'); ?>" alt=<?php
                                                                                                              $pattern = '/\(\d+\)/';
                                                                                                              $outputString = preg_replace($pattern, '', get_sub_field('purchase_need_item_repeat_text'));
                                                                                                              echo $outputString;
                                                                                                              ?>></p>
                    <p class="is-sp"><img src="<?php the_sub_field('purchase_need_item_repeat_img'); ?>" alt=<?php
                                                                                                              $pattern = '/\(\d+\)/';
                                                                                                              $outputString = preg_replace($pattern, '', get_sub_field('purchase_need_item_repeat_text'));
                                                                                                              echo $outputString;
                                                                                                              ?>></p>
                  </div>
                  <p class="text text--center"><?php the_sub_field('purchase_need_item_repeat_text'); ?></p>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>

          </div>
          <?php if (have_rows('purchase_need_item_caution_text_repeat', 18955)) : ?>
            <div class="attendList">
              <ul class="attendList__list">
                <?php while (have_rows('purchase_need_item_caution_text_repeat', 18955)) : the_row(); ?>
                  <li class="attendList__item">
                    <?php the_sub_field('purchase_need_item_caution_text', 18955); ?>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </section>
      </section>