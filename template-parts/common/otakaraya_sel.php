<section>
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">
      <?php echo get_field('otakaraya_sel_headline', 19001); ?>
    </h2>
    <div class="titleMain--lead">
      <p><?php echo get_field('otakaraya_sel_lead_text', 19001); ?></p>
    </div>
  </div>


  <figure class="picture__wrap">
    <?php if (!empty(get_field('otakaraya_sel_main_img', 19001))) : ?>
      <p class="picture__img"><img src="<?php the_field('otakaraya_sel_main_img', 19001); ?>" width="720" height="360" alt=""></p>
    <?php endif; ?>
    <figcaption class="picture__caption"><?php echo get_field('otakaraya_sel_sales_point', 19001); ?></figcaption>
  </figure>

  <!-- pagenation -->
  <div class="is-sp flex--slide__pagenation">
    <div class="pagenation--arrows flex-slider-sp1--arrow"></div>
    <div class="pagenation--dots flex-slider-sp1--dot"></div>
  </div>
  <div class="numbox">
    <div class=" numbox--inner sel_slider_sp" style="margin-bottom: 0%;">
      <div id="flex-slider-sp1" class="numbox__slide onlysp" style="margin-bottom: 0%;">
        <?php
        if (have_rows('otakaraya_sel_repeat', 19001)) :
          $cnt = 1;
          while (have_rows('otakaraya_sel_repeat', 19001)) : the_row(); ?>
            <div>
              <!-- <a href="#" class="numbox__slide--link"> -->
              <div class="numbox__slide--link">
                <div class="numbox__slide--img"><span><?php echo sprintf('%02d', $cnt);  ?></span><img src="
                <?php
                $alt_text = strip_tags(get_sub_field('otakaraya_sel_repeat_headline'));
                the_sub_field('otakaraya_sel_repeat_img'); ?>" alt=<?php echo $alt_text; ?>></div>
                <dl>
                  <dt class="numbox__slide--title"><?php the_sub_field('otakaraya_sel_repeat_headline'); ?></dt>
                  <dd class="numbox__slide--text"><?php echo nl2br(get_sub_field('otakaraya_sel_repeat_text')); ?></dd>
                </dl>
                <!-- </a> -->
              </div>
            </div>
        <?php
            $cnt++;
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>

  <style>
    @media (max-width: 767px) {
      .sel_slider_sp {
        width: 100%;
        margin: 0 auto 10px;
        margin-left: auto;
        margin-right: auto;
      }

      .numbox .numbox__slide--link {
        width: 100vw;
        max-width: 100%;
      }
    }
  </style>

</section>