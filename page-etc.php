<?php
/* Template Name: その他ページテンプレート */

get_template_part('head');

?>

<body id="etc">

  <?php
  get_header();
  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の買取</span></a>
      </li>
      <li class="topic__path--item"><span>その他の買取商品</span></li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('etc_purchase_goods_headline'); ?>
          </h2>
          <div class="titleMain--lead">
            <p><?php echo get_field('etc_purchase_goods_lead_text'); ?></p>
          </div>
        </div>

        <section class="titleBox01">
          <div class="titleBox01__title">
            <h3><?php echo get_field('etc_purchase_goods_title'); ?></h3>
          </div>
          <div class="titleBox01__body">
            <div class="textBox">
              <p class="textBox--center"><?php echo get_field('etc_purchase_goods_sub_title'); ?></p>
            </div>
            <div class="colBox colBox__col04 sp__col03">


              <?php
              if (have_rows('etc_purchase_goods_repeat')) :
                while (have_rows('etc_purchase_goods_repeat')) : the_row();
              ?>
                  <div class="col">
                    <a href="<?php the_sub_field('etc_purchase_goods_repeat_url'); ?>" class="img__link">
                      <div class="img">
                        <p class="is-pc"><img src="<?php the_sub_field('etc_purchase_goods_repeat_img'); ?>" alt=""></p>
                        <p class="is-sp"><img src="<?php the_sub_field('etc_purchase_goods_repeat_img'); ?>" alt=""></p>
                      </div>
                      <p class="text text--center"><?php the_sub_field('etc_purchase_goods_repeat_name'); ?></p>
                    </a>
                  </div>
              <?php
                endwhile;
              endif;
              ?>

            </div>
          </div>
        </section>

        <?php
        if (have_rows('etc_purchase_goods_detail_repeat')) :
          while (have_rows('etc_purchase_goods_detail_repeat')) : the_row();
        ?>
            <section>
              <h3 class="titleSub"><?php the_sub_field('etc_purchase_goods_detail_repeat_title'); ?></h3>
              <div class="colBox colBox__col04 sp__col02">


                <?php
                if (have_rows('etc_purchase_goods_model_repeat')) :
                  while (have_rows('etc_purchase_goods_model_repeat')) : the_row();
                ?>
                    <div class="col">
                      <a href="<?php the_sub_field('etc_purchase_goods_model_repeat_url'); ?>" class="img__link">
                        <div class="img">
                          <p class="is-pc"><img src="<?php the_sub_field('etc_purchase_goods_model_repeat_img'); ?>" alt=""></p>
                          <p class="is-sp"><img src="<?php the_sub_field('etc_purchase_goods_model_repeat_img'); ?>" alt=""></p>
                        </div>
                        <p class="text text--center"><?php the_sub_field('etc_purchase_goods_model_repeat_name'); ?></p>
                      </a>
                    </div>
                <?php
                  endwhile;
                endif;
                ?>



              </div>
            </section>
        <?php
          endwhile;
        endif;
        ?>





        <section>
          <h3 class="titleSub"><?php echo get_field('etc_other_goods_title'); ?></h3>
          <div class="textBox">
            <p class="textBox--center">
              <?php
              if (have_rows('etc_other_goods_repeat')) :
                $o_cnt = 1;
                while (have_rows('etc_other_goods_repeat')) : the_row();
                  if ($o_cnt == 1) :
              ?>
                    <a href="<?php echo get_sub_field('etc_other_goods_repeat_brand_url'); ?>"><?php echo get_sub_field('etc_other_goods_repeat_brand'); ?></a>
                  <?php else : echo " / "; ?>
                    <a href="<?php echo get_sub_field('etc_other_goods_repeat_brand_url'); ?>"><?php echo get_sub_field('etc_other_goods_repeat_brand'); ?></a>
              <?php
                  endif;
                  $o_cnt++;
                endwhile;
              endif;
              ?>
            </p>
          </div>
        </section>
        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>

      </section>
    </article>





    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->


  </main>



  <?php
  get_footer();
