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
                <?php $thisbrand = get_field('purchase_record_headline'); ?>
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






        <!--     ▼▼▼買取強化型番と買取相場▼▼▼     -->
        <?php
        if (have_rows('watch_enchancedno4_repeater', $page_id)){
          $watch_enchancedno4_repeater = "" ;
          while (have_rows('watch_enchancedno4_repeater', $page_id)) : the_row();
            $watch_enchancedno4_repeater .= get_sub_field('pid', $page_id) . "," ;
          endwhile;

if( strlen( $watch_enchancedno4_repeater) > 0 ){

          $query = array(
            'post_type' => 'result' ,
            'numberposts' => '-1' ,
            'include' => $watch_enchancedno4_repeater ,
            'orderby' => 'post__in' 
          );
          
          $postwatchs = get_posts( $query );
          if( $postwatchs ){
            echo '<section style="margin-top:4rem;">' ;
            echo '<div class="titleMain titleMain--wrapper">' ;
            echo '<h2 class="titleMain--main watch_enchancedno4_h2">' ;

            $thisbrand = str_replace( "買取実績" , "" , $thisbrand ) ;
            $thisbrand = strip_tags( $thisbrand ) ;
            $thisbrand = str_replace( " " , ' <br class="is-sp">' , $thisbrand ) ;


            echo str_replace( "買取実績" , "" , $thisbrand );
            echo 'の<br class="is-sp">買取強化型番' ;
            echo '</h2>' ;
            echo '</div>' ;
            echo '<div class="watch_enhancedno4_flex">' ;
            $loopcounter = 0 ;
            foreach( $postwatchs as $postwatch ){
              echo '<div class="watch_enhancedno4_item_wrap">' ;
              $tempurl = get_permalink( $postwatch->ID ) ;
              $tempurl = str_replace( "NULL" , "" , $tempurl );
              echo '<a href="' . $tempurl . '" class="img__link">' ;
              echo '<div class="watch_enhancedno4_item">' ;
              echo '<p class="watch_enhancedno4_item_imagebox img">' ;
              $w_image = wp_get_attachment_image_src(get_field('img_path' , $postwatch->ID ) , "full" ) ;
              echo '<img class="watch_enhancedno4_item_image" src="' .$w_image[0] . '">' ;
              echo '</p>' ;
              echo '<div class="watch_enhancedno4_itemname">';
              echo get_the_title( $postwatch->ID ) ;
              echo '</div>' ;
              echo '<div class="watch_enhancedno4_itemprice">';
              echo '<span>買取実績</span> ' . number_format( get_field( 'price' , $postwatch->ID ) ) . "<span>円</span>";
              echo '</div>' ;
              echo '</div>' ;
              echo '</a>' ;
              echo '</div>' ;
              unset( $w_image );
              unset( $tempurl ) ;
              $loopcounter++ ;
            }
            
            echo '</section>' ;
          }
}
        }
        ?>
<style>
.watch_enchancedno4_h2{
  word-break: auto-phrase ;
}
.watch_enhancedno4_flex{
  position: relative ;
  display: flex ;
  box-sizing : border-box ;
  flex-wrap: wrap ;
  justify-content: center ;
  margin : 2rem auto 2rem ;
}
.watch_enhancedno4_item_wrap{
  position: relative;
  display: block ;
  box-sizing: border-box ;
  width : 240px ;
  margin : 0px 10px 20px ;
}
.watch_enhancedno4_item{
  width: 100% ;
}
.watch_enhancedno4_item_imagebox{
  width : 100% ;
  aspect-ratio: 1 / 1 ;
}
.watch_enhancedno4_item_image{
  width: 100% ;
  height: 100% ;
  object-fit: contain ;
}
.watch_enhancedno4_itemname{
  position: relative;
  display: block ;
  width: 100% ;
  text-align: center ;
  font-size : 18px ;
  font-weight: 700 ;
  margin-top : 1rem ;
}
.watch_enhancedno4_itemprice{
  color: #cc1d2c ;
  position: relative;
  display: block ;
  width: 100% ;
  text-align: center ;
  font-size : 20px ;
  font-weight: 700 ;
}
.watch_enhancedno4_itemprice span{
  font-size: 14px ;
}

@media (max-width: 767px) {

.watch_enhancedno4_item_wrap{
  width : 40% ;
  max-width: 200px;
  margin : 0px 5% 20px ;
}


}
</style>
        <!--     ▲▲▲買取強化型番と買取相場▲▲▲     -->








        <!--     ▼▼▼価格上昇中の型番▼▼▼     -->
        <?php
          if (have_rows('watch_pricerising_repeater', $page_id)){
            $watch_pricerising_id = "" ;
            $watch_pricerising_oldyear = array() ;
            $watch_pricerising_oldprice = array() ;
            while (have_rows('watch_pricerising_repeater', $page_id)) : the_row();
              $watch_pricerising_id .= get_sub_field('pid', $page_id) . "," ;
              $watch_pricerising_oldyear[] = get_sub_field('oldyear', $page_id) ;
              $watch_pricerising_oldprice[] = get_sub_field('oldprice', $page_id) ;
            endwhile;
          }
          $watch_modelname = get_field( 'tokei_item_name' , $page_id ) ;
// echo "<!-- " . strlen( $watch_pricerising_id ) . " -->" ;
if( strlen( $watch_pricerising_id ) > 0 ){

          $query = array(
            'post_type' => 'result' ,
            'numberposts' => '-1' ,
            'include' => $watch_pricerising_id ,
            'orderby' => 'post__in' 
          );

          $loopcounter = 0 ;
          $postwatchs = get_posts( $query );
          if( $postwatchs ){
            echo '<section style="margin-top:4rem;">' ;
            echo '<div class="titleMain titleMain--wrapper">' ;
            echo '<h2 class="titleMain--main watch_pricerizing_h2">' ;
            echo "価格上昇中の" . $watch_modelname . 'の型番' ;
            echo '</h2>' ;
            echo '</div>' ;
            echo '<div class="watch_pricerizing_flex">' ;
            
            foreach( $postwatchs as $postwatch ){
              $tempurl = get_permalink( $postwatch->ID ) ;
              $tempurl = str_replace( "NULL" , "" , $tempurl );
              echo '<div class="watch_pricerising_box_wrap">' ;
              echo '<a href="' . $tempurl . '" class="img__link">' ;
              echo '<div class="watch_pricerising_box">' ;
              
              echo '<div class="watch_pricerising_img">' ;
              echo '<p class="watch_pricerising_img_p img">' ;
              $w_image = wp_get_attachment_image_src(get_field('img_path' , $postwatch->ID ) , "full" ) ;
              echo '<img class="watch_pricerising_images" src="' .$w_image[0] . '">' ;
              echo '</p>' ;
              echo '</div>' ;

              echo '<div class="watch_pricerising_right_wrap">' ;
              echo '<div class="watch_pricerising_model">' ;
              echo get_the_title( $postwatch->ID ) ;
              echo '</div>' ;
              echo '<div class="watch_pricerising_before">' ;
              echo '販売年代 ' ;
              echo $watch_pricerising_oldyear[$loopcounter] ;
              echo '<br>' ;
              echo '参考定価 ' ;
              echo $watch_pricerising_oldprice[$loopcounter] ;
              echo '</div>' ;
              echo '<div class="watch_pricerising_now">';
              echo '<span>買取実績</span><br>' . number_format( get_field( 'price' , $postwatch->ID ) ) . "<span>円</span>";
              echo '</div>' ;
              echo '</div>' ;
              echo '</div> <!-- watch_pricerising_box -->' ;
              echo '</a>' ;
              echo '</div>' ;

              $loopcounter++ ;
              unset( $tempurl ) ;
              unset( $w_image ) ;
            }

            echo '</div>' ;
            echo '</section>' ;
          }
}

        ?>
<style>
.watch_pricerizing_h2{
  word-break: auto-phrase ;
}
.watch_pricerizing_flex{
  width: 100% ;
  position: relative;
  display: flex ;
  flex-wrap: wrap ;
  box-sizing: border-box ;
  margin : 2rem auto 2rem ;
  justify-content: center ;
}

.watch_pricerising_box_wrap{
  position: relative;
  display: block ;
  box-sizing: border-box ;
  width : 240px ;
  margin : 0px 10px 20px ;
}
.watch_pricerising_box{
  width: 100% ;
}
.watch_pricerising_img{
  position: relative;
  display: block ;
  width: 100% ;
  aspect-ratio: 1 / 1 ;
  border-radius: 24px ;
  overflow: hidden ;
}
.watch_pricerising_img_p{
  width: 100% ;
  aspect-ratio: 1 / 1 ;
}
.watch_pricerising_images{
  width: 100%;
  height: 100% ;
  object-fit: contain ;
}
.watch_pricerising_right_wrap{
  position: relative;
  display: block ;
  box-sizing: border-box ;
  width: 100%;
}

.watch_pricerising_model{
  margin-top : 1rem ;
  font-size: 18px ;
  font-weight: 700 ;
  text-align: center ;
  word-break: auto-phrase ;
}
.watch_pricerising_before{
  position: relative ;
  display: block ;
  color : gray ;
  font-weight: 700 ;
  box-sizing: border-box;
  font-size: 14px ;
  text-align: center ;
}
.watch_pricerising_now{
  color: #cc1d2c ;
  position: relative;
  display: block ;
  width: 100% ;
  font-size : 20px ;
  font-weight: 700 ;
  text-align: center ;
  line-height: 1.2;
}
.watch_pricerising_now span{
  font-size: 14px ;
}


@media (max-width: 767px) {

.watch_pricerising_box_wrap{
  width : 40% ;
  max-width: 200px;
  margin : 0px 5% 20px ;
}

}

</style>

        <!--     ▲▲▲価格上昇中の型番▲▲▲     -->































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
