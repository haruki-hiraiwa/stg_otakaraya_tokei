<?php
/* ブランドページ（カテゴリページ）テンプレート */



$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//よくある質問、お客様の声をリダイレクト
if (strpos($current_url, "/faq/")) {
  wp_redirect("https://www.otakaraya.jp/brand-tokei/faq/", 301);
  exit;
} else if (strpos($current_url, "/voice/")) {
  wp_redirect("https://www.otakaraya.jp/brand-tokei/voice/", 301);
  exit;
}

get_template_part('head');


?>

<body id="brand_model">

  <?php
  get_header();

  the_post();
  $post_id = $post->ID;

  $category = get_the_category();
  $cat_name = $category[0]->name;
  $cat_slug = $category[0]->slug;



  //カテゴリー名の取得
  $cat = $category[0];
  $cat_id = $cat->cat_ID;
  $parent_id = 'category_' . $cat_id;
  $cat_name = get_field('tokei_category_name', $parent_id);
  //カテゴリー名称に何も入力されていなければカタカナ名を取得
  if (empty($cat_name))
    $cat_name = get_field('brand_ruby', $parent_id); //カテゴリー名



  $model_name = get_field("tokei_item_name", get_the_ID());
  if (empty($model_name)) {
    require_once("/home/www_ebs/stg.otakaraya.jp/htdocs/app/wp-content/themes/otakaraya/page_commons.php");
    $model_str =  page_commons\name_extract(get_the_title());
    $model_name = str_replace($cat_name, "", $model_str);
  }



  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/brand-tokei/"><span>ブランド時計の買取</span></a>
      </li>
      <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/brand-tokei/<?php echo $cat_slug; ?>/"><span><?php echo $cat_name . "の高価買取"; ?></span></a>
      </li>
      <li class="topic__path--item"><span><?php echo $cat_name . " " . $model_name . "の高価買取・相場"; ?></span></li>
    </ol>
  </div>





  <!--     ▼▼▼ページトップスライダー▼▼▼     -->
  <?php get_template_part('/template-parts/common/page_top_slider'); ?>
  <!--     ▲▲▲ページトップスライダー▲▲▲     -->





  <main class="contents">
    <article class="contents__left">



      <?php
      //if ($cat_name == "ロレックス ") {
      ?>
      <!-- バナー付CTA -->
      <section class="simple_cta_top">
        <div class="kv_area">
          <p class="is-pc"><img src=<?php echo get_field("cta_banner_image_pc", 19025); ?> alt="ブランド時計が高く売れる"></p>
          <p class="is-sp"><img src=<?php echo get_field("cta_banner_image_sp", 19025); ?> alt="ブランド時計が高く売れる"></p>
        </div>
        <?php include '/home/www_ebs/stg.otakaraya.jp/htdocs/assets/simple_cta.php'; ?>
        <style>
          .kv_area img {
            max-width: 100%;
            margin-top: 1rem;
          }
        </style>
      </section>
      <!-- バナー付CTA -->
      <?php
      //}
      ?>

      <!--     ▼▼▼買取対象モデル▼▼▼     -->

      <?php //get_template_part('/template-parts/common/purchase_target_model'); 
      ?>

      <!--     ▲▲▲買取対象モデル▲▲▲     -->




      <!--     ▼▼▼買取実績▼▼▼     -->

      <?php
      $args = array(
        'post_type' => 'result',
        'posts_per_page' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => 'result_cat',
            'field'    => 'slug',
            'terms'    => $post->post_name,
          ),
        ),
        'meta_key' => 'display_order_field_key',
        'orderby' => 'meta_value_num',
        'order' => 'ASC', // 降順 or 昇順
        'custom_orderby' => true
      );
      $the_query = new WP_Query($args);
      ?>
      <!-- ターム名 end -->
      <?php if ($the_query->have_posts()) : ?>
        <section></section>
        <section>
          <?php if (get_field('purchase_record_headline')) : ?>
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php the_field('purchase_record_headline'); ?>
              </h2>
              <div class="titleMain--lead">
                <p><?php the_field('purchase_record_lead_text'); ?></p>
              </div>
            </div>
          <?php endif; ?>
          <div class="result-model__flex flex">
            <div class="flex__content active">
              <ul id="flex-slider-sp5" class="content__list onlysp">
                <?php
                while ($the_query->have_posts()) : $the_query->the_post();

                  $model_img = get_field('img_path');
                  $size = 'thumbnail';
                ?>

                  <li class="content__item content_item_wrap align_items_stretch_parent">
                    <a href="<?php echo get_permalink() ?>" class="img__link">
                      <div class="content_image_wrap">


                        <p class="content__image img">
                          <?php

                          $attr = get_the_title() . "の買取実績";
                          $default_attr = array(
                            'alt'   => $attr,
                          );
                          $icon = false;
                          echo wp_get_attachment_image($model_img, $size, $icon, $default_attr);
                          ?>

                        <p class="content--name">
                          <?php
                          the_title();
                          ?>
                        </p>

                        </p>
                      </div>
                    </a>

                    <div class="content__text">
                      <p class="content--title" style="margin-top: 0px;">買取実績</p>
                      <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                    </div>



                  </li>


                <?php endwhile; ?>
              </ul>

              <div class="flex--slide__pagenation">
                <div class="pagenation--arrows flex-slider-sp5--arrow"></div>
                <div class="pagenation--dots flex-slider-sp5--dot"></div>
              </div>


              <?php
              //買取実績一覧ボタン
              $post_slug =  get_post_field('post_name', $post_id); //投稿ページのスラッグ
              $result_url = "https://www.otakaraya.jp/brand-tokei/result/" . $cat_slug . "/" . $post_slug  . "/";

              $get_header = @get_headers($result_url);
              if ($get_header[0] != "HTTP/1.1 404 Not Found") {
                $buttonText = $cat_name . " " . $model_name . "<br class=is-sp>買取実績一覧はこちら";
                $output = '<a href="' . $result_url . '">' .  "<center>" . $buttonText . "</center>" . '</a> ';
              } else {
                $buttonText = "ブランド時計買取実績一覧はこちら";
                $output = '<a href="' . "https://www.otakaraya.jp/brand-tokei/result/" . '">' .  "<center>" . $buttonText . "</center>" . '</a> ';
              }
              ?>
              <div class="btn__wrap btn__red">
                <?php echo $output; ?>
              </div>
            </div>

            <!-- <div class="btn__wrap btn__red">
              <a href="/brand-tokei/result/">ブランド時計買取実績一覧はこちら</a>
            </div> -->


          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
          </div>

        </section>

        <style>
          .content_item_wrap {
            display: flex !important;
            flex-direction: column;
            justify-content: space-between;
          }

          #brand_model .flex__content .content__list {
            align-items: stretch;
          }

          #flex-slider-sp5 .slick-track {
            display: flex;
            align-items: stretch;
          }
        </style>

        <!--     ▲▲▲買取実績▲▲▲     -->




        <?php
        $post_id = get_the_ID();
        $purchase_market_price_transition_repeat = get_field('purchase_market_price_transition_repeat');


        if (!empty(get_field('pmc_headline', $post_id)) &&  !empty($purchase_market_price_transition_repeat)) :
        ?>

          <?php get_template_part('/template-parts/cta/cta01'); ?>
          <?php get_template_part('/template-parts/cta/cta02'); ?>

        <?php endif; ?>


        <?php
        $mode = "";
        if ($_GET["mode"]) {
          $mode = $_GET["mode"];
        }
        ?>
        <?php if (!$mode == "test") { ?>
          <section></section>

          <?php get_template_part('/template-parts/common/otakaraya_redline_desc_2'); ?>

          <section></section>

          <?php get_template_part('/template-parts/common/otakaraya_tokei_common_desc'); ?>

          <section></section>

          <?php get_template_part('/template-parts/common/otakaraya_tokei_desc'); ?>

          <section></section>
        <?php } ?>





        <!--     ▼▼▼状態が悪いものでも買取▼▼▼     -->

        <?php get_template_part('/template-parts/common/state_bad_purchase'); ?>

        <!--     ▲▲▲状態が悪いものでも買取▲▲▲     -->

        <!--     ▼▼▼買取相場▼▼▼     -->

        <?php get_template_part('/template-parts/common/purchase_market_price'); ?>

        <!--     ▲▲▲買取相場▲▲▲     -->






        <!--     ▼▼▼買取価格相場推移▼▼▼     -->

        <?php get_template_part('/template-parts/common/purchase_market_price_transition'); ?>

        <!--     ▲▲▲買取価格相場推移▲▲▲     -->







        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta02'); ?>




        <!--     ▼▼▼テキストエリア▼▼▼     -->

        <?php if (!empty(get_field('repeat_text_area_headline', $post_id))) : ?>
          <section>
            <div class="brandinfo">
              <div class="titleMain titleMain--wrapper">
                <h2 class="titleMain--main">
                  <?php the_field('repeat_text_area_headline', $post_id); ?>
                </h2>
                <div class="titleMain--lead">
                  <p><?php echo get_field('repeat_text_area_lead_text'); ?></p>
                </div>
              </div>
            </div>
            <?php if (have_rows('repeat_text_area_child', $post_id)) : ?>
              <?php while (have_rows('repeat_text_area_child', $post_id)) : the_row(); ?>
                <h3 class="titleSub titleSub--mtPc64"><?php the_sub_field('repeat_text_area_child_headline', $post_id); ?></h3>
                <p class="titleSub--lead" style="color: #545454; font-size: 1rem; line-height: 1.5; margin-top: 8px; text-align: center;"><?php the_sub_field('repeat_text_area_child_lead_text'); ?></p>

                <div class=" horizonlist horizonnumblist">

                  <?php if (have_rows('repeat_text_area_grandchild', $post_id)) : ?>
                    <?php $barc_cnt = 1; ?>
                    <?php while (have_rows('repeat_text_area_grandchild', $post_id)) : the_row(); ?>
                      <div class="horizonlist--link">
                        <div class="horizonlist--img"><span><?php echo str_pad($barc_cnt, 2, 0, STR_PAD_LEFT); ?></span><img src="<?php the_sub_field('repeat_text_area_grandchild_img', $post_id); ?>" alt=<?php echo strip_tags(get_sub_field('repeat_text_area_grandchild_headline', $post_id)); ?>></div>
                        <div class="horizonlist--text">
                          <h4 class="titleH4 title--left"><?php the_sub_field('repeat_text_area_grandchild_headline', $post_id); ?></h4>
                          <p><?php the_sub_field('repeat_text_area_grandchild_lead_text', $post_id); ?></p>
                        </div>
                      </div>
                      <?php $barc_cnt++; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>

                </div>
              <?php endwhile; ?>
            <?php endif; ?>

          </section>
        <?php endif; ?>

        <!--     ▲▲▲テキストエリア▲▲▲     -->

        <!--     ▼▼▼おたからやが選ばれる理由▼▼▼     -->

        <?php get_template_part('/template-parts/common/otakaraya_sel'); ?>

        <!--     ▲▲▲おたからやが選ばれる理由▲▲▲     -->









        <!--     ▼▼▼よくある質問▼▼▼     -->

        <?php get_template_part('/template-parts/faq/faq'); ?>

        <!--     ▲▲▲よくある質問▲▲▲     -->





        <!--     ▼▼▼お客様の口コミ▼▼▼     -->

        <?php get_template_part('/template-parts/voice/voice_from_sougou2'); ?>

        <!--     ▲▲▲お客様の口コミ▲▲▲     -->




        <!--     ▼▼▼モデル型番一覧▼▼▼     -->

        <?php if (have_rows('model_info_repeat_parent')) : ?>
          <section>
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main"><?php the_field('model_list_headlin'); ?></h2>
              <div class="titleMain--lead"><?php the_field('model_list_lead_text'); ?></div>
            </div>

            <?php while (have_rows('model_info_repeat_parent')) : the_row(); ?>
              <section>
                <h3 class="titleSub"><?php the_sub_field('model_info_repeat_parent_headline'); ?></h3>

                <?php if (have_rows('model_info_repeat_child')) : ?>
                  <?php while (have_rows('model_info_repeat_child')) : the_row(); ?>

                    <section class="modelNumber container--gy01">
                      <div class="modelNumber__acod js-modelNumber__acod">
                        <div class="modelNumber__acod--switch">
                          <h4 class="titleH4"><?php the_sub_field('model_info_repeat_child_hadline'); ?></h4>
                        </div>
                        <div class="modelNumber__acod--contents">
                          <ul class="modelNumber__wrap">

                            <?php if (have_rows('model_info_repeat_grandchild')) : ?>
                              <?php while (have_rows('model_info_repeat_grandchild')) : the_row(); ?>

                                <li class="modelNumber__item">
                                  <dl class="modelNumber__item--inner">
                                    <dt class="title"><?php the_sub_field('model_info_repeat_grandchild_headline'); ?></dt>
                                    <dd class="detail">
                                      <dl>
                                        <dt class="detail--ttl"><?php the_sub_field('model_info_repeat_grandchild_headline_01'); ?><?php the_sub_field('model_info_repeat_grandchild_headline_02'); ?><?php the_sub_field('model_info_repeat_grandchild_headline_03'); ?></dt>
                                        <dd class="detail--txt"><?php the_sub_field('model_info_repeat_grandchild_detail'); ?></dd>
                                      </dl>
                                    </dd>
                                  </dl>
                                </li>

                              <?php endwhile; ?>
                            <?php endif; ?>

                          </ul>
                        </div>
                      </div>
                    </section>

                  <?php endwhile; ?>
                <?php endif; ?>

              </section>

            <?php endwhile; ?>


          </section>
        <?php endif; ?>

        <!--     ▲▲▲モデル型番一覧▲▲▲     -->





        <!--     ▼▼▼コラム▼▼▼     -->

        <?php get_template_part('/template-parts/common/column_from_sougou'); ?>

        <!--     ▲▲▲コラム▲▲▲     -->





        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>




        <!--     ▼▼▼店舗案内▼▼▼     -->
        <section></section>
        <?php get_template_part('/template-parts/shop/shop_guide'); ?>

        <!--     ▲▲▲店舗案内▲▲▲     -->





        <!--     ▼▼▼買取対象モデル▼▼▼     -->

        <!-- <?php get_template_part('/template-parts/common/purchase_target_model'); ?> -->

        <!--     ▲▲▲買取対象モデル▲▲▲     -->





        <!--     ▼▼▼人気買取ブランド▼▼▼     -->
        <section>
          <div class="titleMain--wrapper">
            <h2 class="titleMain">
              <span class="titleMain--main">
                <?php echo get_field('popular_brand_headline', 18897); ?>
              </span>
            </h2>
            <span class="titleMain--sub" style="text-align: center;">
              <?php echo get_field('popular_brand_lead_text', 18897); ?>
            </span>
          </div>
          <div class="colBox colBox__col04 sp__col03">

            <?php
            if (have_rows('popular_brand_repeat', 18897)) :
              while (have_rows('popular_brand_repeat', 18897)) : the_row();
                if (get_sub_field('popular_brand_cate')) :
                  $term = get_sub_field('popular_brand_cate');
            ?>
                  <div class="col">
                    <a href="<?php echo esc_url(home_url('/' . $term->slug)); ?>" class="img__link">
                      <div class="img">
                                               <p class="is-pc"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt="<?php echo $term->name; ?>"></p>
                                               <p class="is-sp"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt="<?php echo $term->name; ?>"></p>
                      </div>
                      <p class="text text--center"><?php echo $term->name; ?></p>
                    </a>
                  </div>
            <?php
                endif;
              endwhile;
            endif;
            ?>

          </div>
        </section>
        <!--     ▲▲▲人気買取ブランド▲▲▲     -->





    </article>





    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->





  </main>

  <style>
    .flex__content .content__item .content--name {
      word-break: break-word;
    }
  </style>


  <?php
  get_footer();
