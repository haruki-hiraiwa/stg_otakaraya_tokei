<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

?>

<body id="brand">

  <?php
  get_header();

  /***** カテゴリ情報取得 *****/
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;

  $cat_name = get_queried_object()->name;
  // $catimg = get_field('catimg',$post_id);
  if (WP_Filesystem()) {
    global $wp_filesystem;
    $sample_file = $wp_filesystem->get_contents($path_name);
  }

  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の高価買取</span></a>
      </li>
      <li class="topic__path--item"><span>
          <?php
          require_once("/home/www_ebs/stg.otakaraya.jp/htdocs/app/wp-content/themes/otakaraya/page_commons.php");
          echo page_commons\name_extract($cat_name) . "の高価買取";
          ?></span></li>
    </ol>
  </div>





  <!--     ▼▼▼ページトップスライダー▼▼▼     -->
  <?php get_template_part('/template-parts/common/page_top_slider'); ?>
  <!--     ▲▲▲ページトップスライダー▲▲▲     -->





  <main class="contents">
    <article class="contents__left">



      <?php
      //if ($cat_name == "ロレックス高価買取") {
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

      <?php get_template_part('/template-parts/common/purchase_target_model'); ?>

      <!--     ▲▲▲買取対象モデル▲▲▲     -->







      <?php
      $cat_id = get_queried_object()->cat_ID;
      $post_id = 'category_' . $cat_id;

      $purchase_market_price_transition_repeat = get_field('purchase_market_price_transition_repeat', $post_id);

      $rp_cnt =  count(get_field('purchase_achieve_model_repeat', $post_id));

      if ($rp_cnt == 1) {
        $rp_data = get_field('purchase_achieve_model_repeat', $post_id);
        if (empty($rp_data[0]['purchase_achieve_model_repeat_category']) && empty($rp_data[0]['purchase_achieve_model_repeat_name'])) {
          $rp_cnt = 0;
        }
      }


      if (!empty(get_field('pmc_headline', $post_id)) && !empty($purchase_market_price_transition_repeat) && $rp_cnt > 0) :
      ?>

        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta02'); ?>

      <?php endif; ?>




      <!--     ▼▼▼買取相場▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_market_price'); ?>

      <!--     ▲▲▲買取相場▲▲▲     -->





      <!--     ▼▼▼買取価格相場推移▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_market_price_transition'); ?>

      <!--     ▲▲▲買取価格相場推移▲▲▲     -->





      <!--     ▼▼▼買取実績▼▼▼     -->
      <section></section>
      <?php get_template_part('/template-parts/common/flex_model'); ?>

      <!--     ▲▲▲買取実績▲▲▲     -->



      <!-- ▼▼▼買取相場価格一覧 -->
      <section></section>
      <?php get_template_part('/template-parts/common/purchase_market_price_list'); ?>
      <!-- ▲▲▲買取相場価格一覧 -->


      <!--     ▼▼▼状態が悪いものでも買取▼▼▼     -->
      <section></section>
      <?php get_template_part('/template-parts/common/state_bad_purchase'); ?>

      <!--     ▲▲▲状態が悪いものでも買取▲▲▲     -->



      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta02'); ?>

      <?php
      $mode = "";
      if ($_GET["mode"]) {
        $mode = $_GET["mode"];
      }
      ?>
      <?php if (!$mode == "test") { ?>
        <!--     ▼▼▼ブランドについて2▼▼▼     -->
        <section></section>
        <?php get_template_part('/template-parts/common/otakaraya_redline_desc_2');
        ?>
        <!--     ▲▲▲カテゴリについて▲▲▲     -->

      <?php } else { ?>

        <!--     ▼▼▼ブランドについて▼▼▼     -->

        <?php if (!empty(get_field('brand_about_headline', $post_id))) : ?>
          <section>
            <div class="brandinfo">
              <div class="titleMain titleMain--wrapper">
                <h2 class="titleMain--main">
                  <?php the_field('brand_about_headline', $post_id); ?>
                </h2>
              </div>
              <?php if (!empty(get_field('brand_about_lead_text', $post_id)) || !empty(get_field('brand_about_top_img', $post_id)) || !empty(get_field('brand_about_text', $post_id))) : ?>
                <div class="brandinfo__main">
                  <div class="brandinfo__header">
                    <h3 class="brandinfo__header__title"><?php the_field('brand_about_lead_text', $post_id); ?></h3>
                  </div>
                  <div class="brandinfo__body">
                    <?php if (!empty(get_field('brand_about_top_img', $post_id))) : ?>
                      <figure class="brandinfo__body__img">
                        <picture>
                          <source srcset="<?php the_field('brand_about_top_img', $post_id); ?>" media="(min-width: 768px)" type="image/svg+xml" width="248" height="248">
                          <img src="<?php the_field('brand_about_top_img', $post_id); ?>" alt="ロレックス">
                        </picture>
                      </figure>
                    <?php endif; ?>
                    <div class="brandinfo__body__text">
                      <?php the_field('brand_about_text', $post_id); ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <div>

              <?php if (have_rows('brand_about_repeat_parent', $post_id)) : ?>
                <?php while (have_rows('brand_about_repeat_parent', $post_id)) : the_row(); ?>
                  <h3 class="titleSub <?php if (empty(get_field('brand_about_lead_text', $post_id))) : ?>titleSub--mtPc26<?php else : ?>titleSub--mtPc64<?php endif; ?> titleSub--mtSp32">
                    <?php $parent_title = get_sub_field('brand_about_repeat_parent_headline', $post_id);
                    echo $parent_title; ?>
                  </h3>

                  <div class="horizonlist horizonnumblist">

                    <?php if (have_rows('brand_about_repeat_child', $post_id)) : ?>
                      <?php $barc_cnt = 1; ?>
                      <?php while (have_rows('brand_about_repeat_child', $post_id)) : the_row(); ?>
                        <div class="horizonlist--link">
                          <div class="horizonlist--img"><span><?php echo str_pad($barc_cnt, 2, 0, STR_PAD_LEFT); ?></span>
                            <?php
                            //タイトルテキストがないため親のタイトルから取得する
                            if (empty(get_sub_field('brand_about_repeat_child_headline', $post_id))) :
                              $alt_text = $parent_title;
                            else :
                              $alt_text = get_sub_field('brand_about_repeat_child_headline', $post_id);
                            endif;
                            ?>
                            <img src="<?php the_sub_field('brand_about_repeat_child_img', $post_id); ?>" alt=　<?php echo strip_tags($alt_text); ?>>
                          </div>
                          <div class="horizonlist--text">
                            <h4 class="titleH4 title--left"><?php the_sub_field('brand_about_repeat_child_headline', $post_id); ?></h4>
                            <p><?php the_sub_field('brand_about_repeat_child_lead_text', $post_id); ?></p>
                          </div>
                        </div>
                        <?php $barc_cnt++; ?>
                      <?php endwhile; ?>
                    <?php endif; ?>

                  </div>
                <?php endwhile; ?>
              <?php endif; ?>

            </div>
          </section>
        <?php endif; ?>

        <!--     ▲▲▲ブランドについて▲▲▲     -->
      <?php } ?>










      <!--     ▼▼▼おたからやが選ばれる理由▼▼▼     -->

      <section></section>
      <?php get_template_part('/template-parts/common/otakaraya_sel'); ?>

      <!--     ▲▲▲おたからやが選ばれる理由▲▲▲     -->





      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta02'); ?>





      <!--     ▼▼▼よくある質問▼▼▼     -->

      <?php get_template_part('/template-parts/faq/faq'); ?>

      <!--     ▲▲▲よくある質問▲▲▲     -->



      <!--     ▼▼▼お客様の口コミ▼▼▼     -->

      <?php get_template_part('/template-parts/voice/voice'); ?>

      <!--     ▲▲▲お客様の口コミ▲▲▲     -->





      <!--     ▼▼▼高く買い取ってもらう方法▼▼▼     -->

      <?php get_template_part('/template-parts/common/high_price'); ?>

      <!--     ▲▲▲高く買い取ってもらう方法▲▲▲     -->





      <!--     ▼▼▼コラム▼▼▼     -->

      <?php get_template_part('/template-parts/common/column_from_sougou'); ?>

      <!--     ▲▲▲コラム▲▲▲     -->





      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta03'); ?>






      <!--     ▼▼▼店舗案内▼▼▼     -->
      <section></section>
      <?php get_template_part('/template-parts/shop/shop_guide'); ?>

      <!--     ▲▲▲店舗案内▲▲▲     -->





    </article>





    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->


    <!-- 実績レイアウト -->
    <style>
      .flex__content .content__list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        gap: 21px;
      }

      .flex__content .content__item {
        width: 22.6% !important;
      }


      @media (min-width: 768px) and (max-width: 1100px) {
        .flex__content .content__item {
          width: 30.1% !important;
          max-width: 200px;
          margin: 0 1.6%;
          margin-bottom: 15px;
        }

        .flex__content .content__list {
          gap: 0px;
        }
      }

      @media (max-width: 767px) {
        .flex__content .content__item {
          width: 41.8% !important
        }
      }
    </style>



  </main>




  <?php
  get_footer();
