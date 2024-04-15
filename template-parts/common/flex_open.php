<?php
if (is_category()) {
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
} else {
  $post_id = get_the_ID();
}
if(is_singular('area_vicinity')){
  $post_id = get_page_by_path('brand-tokei');
  $post_id = $post_id->ID;
}
?>
<?php
$rp_cnt =  count(get_field('purchase_achieve_brand_repeat', $post_id));
if ($rp_cnt > 0) :
?>

  <style>
    .tabContents_open .flex__content .content__item {
      width: 24.2%;
      max-width: max-content;
    }

    @media (max-width: 1024px) {
      .tabContents_open .flex__content .content__item {
        width: 32.6%;
        max-width: 200px;
      }
    }

    @media (max-width: 767px) {
      .tabContents_open .flex__content {
        margin: 0 0rem;
      }

      .tabContents_open .flex__content .content__item {
        width: 43.6%;
      }
    }

    .tabContents_open .flex__content .content__list {
      flex-wrap: wrap;
      gap: 20px 1%;
      justify-content: left;

    }

    .tabContents_open .flex__content:not(:first-child) {
      width: 100%;
    }

    .tabContents_open .flex__tab .tab__item {
      width: 33%;
    }


    .tabContents_open .flex__tab {
      justify-content: space-between;
      gap: 2px 0px;
      flex-wrap: wrap;
    }

    .tabContents_open .flex__tab .tab__item:nth-child(3) a {
      border-top-right-radius: 24px;
    }

    .tabContents_open .flex__tab .tab__item:not(:first-child) {
      border-left: 0px solid #f2f2f2;
    }

    .tabContents_open .flex__content .content__item .content--name {
      word-break: break-all;
    }

    .tabContents_open .btn__more {
      width: 80%;
    }

    .tabContents_open .btn__more>* {
      background-color: white;
    }

    .tabContents_open .flex__content.active {
      border-radius: 24px;
    }

    .tabContents_open .flex__tab .tab__item a {
      border-radius: 24px;
      position: relative;
    }

    .tabContents_open .flex__tabContents {
      margin-top: 20px;
    }

    .tabContents_open .tab__item>a::after {
      position: absolute;
      top: 50%;
      right: 16px;
      width: 16px;
      height: 16px;
      margin-top: -8px;
      vertical-align: middle;
      content: "";
      background-image: url(/brand-tokei/wp-content/themes/otakaraya/assets/img/common/icon_arrow_red01.png);
      background-size: contain;
    }

    .btn__wrap.btn__red.flex_tab_others_btn {
      max-width: 100%;
      text-align: center;
      margin: 1rem 0 0 0;
    }


    @media (max-width: 769px) {
      .tabContents_open .tab__item>a::after {
        top: 85%;
        left: 45%;
        transform: rotate(90deg);
      }

      .tabContents_open .tab__item>a::after {
        width: 13px;
        height: 13px;
        margin-top: -5px;
        background-repeat: no-repeat;
      }

      .tabContents_open .flex__tab .tab__item a {
        padding-bottom: 15px;
      }

      .flex_tab_contents_open .btn__wrap {
        width: 95%;
      }

    }

    ul,
    ol,
    li {
      list-style: none;
    }


    .tab__item.tab__item_others {
      width: 100% !important;
    }
  </style>

  <style>
    .tabContents_open .flex__content .content__item {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .tabContents_open .flex__content .content__list {
      align-items: stretch;
    }

    .tabContents_open .content--title {
      margin-top: 0rem !important;
    }
  </style>

  <script>
    //もっと見るボタン28個表示
    $(window).on('load', function() {
      const moreNum28 = 28;
      $('.js__more--item28:nth-child(n + ' + (moreNum28 + 1) + ')').addClass('is-hidden').hide();
      $('.js__more--28th').each(function() {
        $('.js__more--btn28').on('click', function() {
          $(this).prev('.js__more--28th').children('.js__more--item28.is-hidden').slice(0, moreNum28).removeClass('is-hidden').show();
          if ($(this).prev().children(".is-hidden").length == 0) {
            $(this).fadeOut();
          }
        });
      });
    });
  </script>

  <section class="tabContents_open">
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php if(is_singular('area_vicinity')) { ?>
          <?php echo get_field('genre_purchase_goods_headline'); ?>
        <?php } else{ ?>
          <?php the_field('purchase_achieve_headline', $post_id); ?>
        <?php } ?>
      </h2>
      <div class="titleMain--lead">
        <p><?php the_field('purchase_achieve_lead_text', $post_id); ?></p>
      </div>
    </div>

    <div class="flex flex--hasItem<?php echo $rp_cnt; ?>">


      <!-- スライダー部分 -->
      <div class="flex flex--hasItem4">
        <!-- タブメニュー -->
        <ul class="flex__tab">
          <!-- タブ部分 -->
          <li class="tab__item tab__item_ro active"><a>ロレックス</a></li>
          <li class="tab__item tab__item_pt"><a>パテック <br class="is-sp">フィリップ</a></li>
          <li class="tab__item tab__item_od"><a>オーデマ ピゲ</a></li>
          <li class="tab__item tab__item_va"><a>ヴァシュロン<br>コンスタンタン</a></li>
          <li class="tab__item tab__item_la"><a>A.ランゲ＆ゾーネ</a></li>
          <li class="tab__item tab__item_br"><a>ブレゲ</a></li>
          <li class="tab__item tab__item_others"><a>その他の買取実績</a></li>

        </ul>






        <!-- スライダー部分 -->
        <div class="flex__tabContents flex_tab_contents_open">

          <div class="flex__content active">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "rolex",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);

              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">

                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>
                  </a>

                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>

              <?php
              }
              ?>

            </div>




            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/rolex/" class="flex_link flex_link_ro">ロレックス買取実績一覧はこちら</a>
            </div>


          </div>
          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "patekphilippe",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);
              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>

                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>

            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/patekphilippe/" class="flex_link flex_link_pt">パテック <br class="is-sp">フィリップ買取実績一覧はこちら</a>
            </div>

          </div>
          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "audemarspiguet",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);
              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>

                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>

            <!-- <div class="btn__wrap btn__more js__more--btn28">
                <span>もっと実績を見る</span>
              </div> -->
            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/audemarspiguet/" class="flex_link flex_link_od">オーデマ ピゲ買取実績一覧はこちら</a>
            </div>

          </div>
          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "vacheronconstantin",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);
              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>

                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>

            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/vacheronconstantin/" class="flex_link flex_link_va">ヴァシュロン コンスタンタン<br>買取実績一覧はこちら</a>
            </div>

          </div>
          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "lange-soehne",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);


              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>

                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>
            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/lange-soehne/" class="flex_link flex_link_la">A.ランゲ＆ゾーネ買取実績一覧はこちら</a>
            </div>


          </div>
          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'result',
                'meta_key' => 'display_order_field_key',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'custom_orderby' => true,
                'suppress_filters' => false,
                'tax_query'      => array(
                  array(
                    'taxonomy' => 'result_cat',  // カスタムタクソノミー名
                    'field'    => 'slug',  // タームの指定方法。term_id / slug / name のいずれかで指定
                    'terms'    => "breguet",  // 上で指定したタクソノミーに属するタームを指定
                  )
                ),
              );

              $myposts = get_posts($args);
              $p_cnt = count($myposts);
              foreach ($myposts as $post) {
                setup_postdata($post);

                $model_img = get_field('img_path');
                $size = 'thumbnail';

              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php the_permalink(); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo wp_get_attachment_url($model_img); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>

                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('price', $post->ID)); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>
            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/breguet/" class="flex_link flex_link_br">ブレゲ買取実績一覧はこちら</a>
            </div>


          </div>


          <div class="flex__content">
            <div id="flex-slider" class="content__list flex--slide js__more--28th">


              <?php
              $args = array(
                'posts_per_page' => 28,
                'post_type'      => 'pick_up_result',
                'order' => 'ASC',
              );

              $pick_up_result_posts = get_posts($args);

              foreach ($pick_up_result_posts as $post) {
                setup_postdata($post);


              ?>
                <li class="content__item js__more--item28">
                  <a href="<?php echo get_field('pick_up_result_url'); ?>" class="img__link">
                    <div class="content_image_wrap">
                      <p class="content__image img">
                        <img width="150" height="150" src="<?php echo get_field('pick_up_result_img'); ?>" class="attachment-thumbnail size-thumbnail" alt="" sizes="100vw">
                      </p>
                      <p class="content--name"><?php echo get_the_title(); ?></p>
                    </div>
                  </a>
                  <div class="content__text">
                    <p class="content--title">買取実績</p>
                    <p class="content--price"><?php echo number_format(get_field('pick_up_result_price')); ?><span>円</span></p>
                  </div>

                </li>
              <?php
              }


              ?>


            </div>
            <?php if ($p_cnt > 28) { ?>
              <!-- <div class="btn__wrap btn__more js__more--btn28">
                  <span>もっと実績を見る</span>
                </div> -->
            <?php  } ?>

            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/brand-tokei/result/" class="flex_link flex_link_br">その他買取実績一覧はこちら</a>
            </div>


          </div>

        </div>
      </div>

    </div>

  </section>


<?php endif; ?>