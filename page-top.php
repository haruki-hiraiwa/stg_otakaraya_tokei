<?php
/* Template Name: トップページテンプレート */

get_template_part('head');

?>

<body id="brand-tokei">

  <?php
  get_header();
  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="https://www.otakaraya.jp"><span itemprop="name">買取専門店・おたからやTOP</span></a>
        <meta itemprop="position" content="1">
      </li>
      <?php if (have_rows('top_breadcrumbs')) :
        // <!-- 1つ目のみ取得 -->
        $bradcrumbs = get_field('top_breadcrumbs');
        $breadcrumb_list = $bradcrumbs[0];
        $texts = $breadcrumb_list['top_breadcrumb_text'];
        if (!empty($texts)) :
      ?>
          <?php
          $num = count(get_field('top_breadcrumbs')) + 1;
          while (have_rows('top_breadcrumbs')) : the_row(); ?>
            <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <?php if (!empty(get_sub_field('top_breadcrumb_url'))) : ?>
                <a itemprop="item" href="<?php the_sub_field('top_breadcrumb_url'); ?>">
                <?php endif; ?>
                <span itemprop="name"><?php the_sub_field('top_breadcrumb_text'); ?></span>
                <?php if (!empty(get_sub_field('top_breadcrumb_url'))) : ?>
                </a>
              <?php endif; ?>
              <meta itemprop="position" content="<?php echo $num; ?>">
            </li>
          <?php endwhile; ?>
        <?php else : ?>
          <li class="topic__path--item">
            <span itemprop="name">ブランド時計の高価買取</span>
            <meta itemprop="position" content="2">
          </li>
        <?php endif;
      else : ?>
        <li class="topic__path--item">
          <span itemprop="name">ブランド時計の高価買取</span>
          <meta itemprop="position" content="2">
        </li>
      <?php endif; ?>
    </ol>
  </div>



  <!--     ▼▼▼ページトップスライダー▼▼▼     -->
  <?php get_template_part('/template-parts/common/page_top_slider'); ?>
  <!--     ▲▲▲ページトップスライダー▲▲▲     -->





  <main class="contents">
    <article class="contents__left">





      <!--     ▼▼▼人気買取ブランド▼▼▼     -->
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('popular_brand_headline'); ?>
          </h2>
          <div class="titleMain--lead">
            <?php echo get_field('popular_brand_lead_text'); ?>
          </div>
        </div>



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


        <div class="colBox colBox__col04 sp__col03">

          <?php
          if (have_rows('popular_brand_repeat')) :
            while (have_rows('popular_brand_repeat')) : the_row();
              if (get_sub_field('popular_brand_cate')) :
                $term = get_sub_field('popular_brand_cate');

                //※altテキストは空白以降の文字列が消える
                $stringsToRemove = array(" ", "・");
                $outputString = str_replace($stringsToRemove, '', $term->name);
          ?>
                <div class="col">
                  <a href="<?php echo esc_url(home_url('/' . $term->slug)); ?>" class="img__link">
                    <div class="img">
                      <p class="is-pc"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $outputString ?>></p>
                      <p class="is-sp"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $outputString ?>></p>
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


        <?php
        $link_url = "https://www.otakaraya.jp/brand-tokei/brand_list/";

        echo '<div class="btn__wrap btn__red">';
        echo '<a href="' . $link_url . '"> ' . "<center>その他の買取可能な時計ブランド一覧</center></a>";
        echo '</div>';
        ?>

        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta02'); ?>


      </section>
      <!--     ▲▲▲人気買取ブランド▲▲▲     -->


      <!--     ▼▼▼キャンペーン▼▼▼     -->
      <?php
      $view_flg = get_field('campaign_view');
      if ($view_flg == 1) :
      ?>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main"> <?php echo get_field('campaign_headline'); ?> </h2>
            <div class="titleMain--lead">
              <p><?php echo get_field('campaign_lead_text'); ?></p>
            </div>
          </div>
          <figure class="picture__wrap">
            <p class="picture__img"><img src="<?php echo get_field('campaign_img'); ?>" alt=""></p>
          </figure>
        </section>
      <?php endif; ?>

      <!--     ▲▲▲キャンペーン▲▲▲     -->





      <!--     ▼▼▼買取相場▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_market_price'); ?>

      <!--     ▲▲▲買取相場▲▲▲     -->



      <!--     ▼▼▼買取実績▼▼▼     -->
      <section></section>
      <?php get_template_part('/template-parts/common/flex_open'); ?>

      <!--     ▲▲▲買取実績▲▲▲     -->


      <!--     ▼▼▼買取実績▼▼▼     -->
      <section></section>
      <?php
      // get_template_part('/template-parts/common/flex'); 
      ?>

      <!--     ▲▲▲買取実績▲▲▲     -->

      <!--     ▲▲▲買取強化▲▲▲     -->
      <section></section>
      <?php get_template_part('/template-parts/common/purchase_reinforcement'); ?>

      <!--     ▲▲▲買取強化▲▲▲     -->


      <!--     ▲▲▲こんな時計も買取できます▲▲▲     -->

      <?php get_template_part('/template-parts/common/can_be_purchased'); ?>

      <!--     ▲▲▲こんな時計も買取できます▲▲▲     -->


      <!--     ▼▼▼状態が悪いものでも買取▼▼▼     -->

      <?php get_template_part('/template-parts/common/state_bad_purchase'); ?>

      <!--     ▲▲▲状態が悪いものでも買取▲▲▲     -->





      <!--     ▲▲▲最新買取実績▲▲▲     -->
      <section></section>
      <?php get_template_part('/template-parts/common/latest_results'); ?>

      <!--     ▲▲▲最新買取実績▲▲▲     -->


      <section>

        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta02'); ?>

      </section>



      <!--     ▼▼▼おたからやが選ばれる理由▼▼▼     -->

      <?php get_template_part('/template-parts/common/otakaraya_sel'); ?>

      <!--     ▲▲▲おたからやが選ばれる理由▲▲▲     -->





      <!--     ▼▼▼今が売り時の理由▼▼▼     -->

      <?php get_template_part('/template-parts/common/brand_sall_now'); ?>

      <!--     ▲▲▲今が売り時の理由▲▲▲     -->


      <!--     ▼▼▼テキストエリア▼▼▼     -->
      <?php if (!empty(get_field('repeat_text_area_headline'))) : ?>
        <section>
          <div class="brandinfo">
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php the_field('repeat_text_area_headline'); ?>
              </h2>
              <div class="titleMain--lead">
                <p><?php echo get_field('repeat_text_area_lead_text'); ?></p>
              </div>
            </div>
          </div>

          <?php if (have_rows('repeat_text_area_child')) : ?>
            <?php while (have_rows('repeat_text_area_child')) : the_row(); ?>
              <h3 class="titleSub titleSub--mtPc64"><?php the_sub_field('repeat_text_area_child_headline'); ?></h3>
              <p class="titleSub--lead" style="color: #545454; font-size: 1rem; line-height: 1.5; margin-top: 8px; text-align: center;"><?php the_sub_field('repeat_text_area_child_lead_text'); ?></p>
              <div class="horizonlist horizonnumblist">

                <?php if (have_rows('repeat_text_area_grandchild')) : ?>
                  <?php $barc_cnt = 1; ?>
                  <?php while (have_rows('repeat_text_area_grandchild')) : the_row(); ?>
                    <div class="horizonlist--link">
                      <div class="horizonlist--img"><span><?php echo str_pad($barc_cnt, 2, 0, STR_PAD_LEFT); ?></span><img src="<?php the_sub_field('repeat_text_area_grandchild_img'); ?>" alt=<?php
                                                                                                                                                                                                // the_sub_field('repeat_text_area_grandchild_headline'); 
                                                                                                                                                                                                echo strip_tags(get_sub_field('repeat_text_area_grandchild_headline'));
                                                                                                                                                                                                ?>></div>
                      <div class="horizonlist--text">
                        <h4 class="titleH4 title--left"><?php the_sub_field('repeat_text_area_grandchild_headline'); ?></h4>
                        <p><?php the_sub_field('repeat_text_area_grandchild_lead_text'); ?></p>
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







      <!--     ▼▼▼よくある質問▼▼▼     -->

      <?php get_template_part('/template-parts/faq/faq'); ?>

      <!--     ▲▲▲よくある質問▲▲▲     -->





      <!--     ▼▼▼お客様の口コミ▼▼▼     -->

      <?php get_template_part('/template-parts/voice/voice'); ?>

      <!--     ▲▲▲お客様の口コミ▲▲▲     -->





      <!--     ▼▼▼買取に必要なもの▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_need'); ?>

      <!--     ▲▲▲買取に必要なもの▲▲▲     -->






      <!--     ▼▼▼高く買い取ってもらう方法▼▼▼     -->

      <?php get_template_part('/template-parts/common/high_price'); ?>

      <!--     ▲▲▲高く買い取ってもらう方法▲▲▲     -->



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





  </main>



  <?php
  get_footer();
