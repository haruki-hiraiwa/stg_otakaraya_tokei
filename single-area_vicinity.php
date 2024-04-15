<?php
/* ブランドページ（カテゴリページ）テンプレート */
get_template_part('head');

$shop_name = get_the_title();
$shop_name = str_replace('店', '', $shop_name);
?>

<body id="shopdetail">

  <?php
  get_header();

  // 	/***** カテゴリ情報取得 *****/
  $term_obj = get_queried_object(); // タームオブジェクトを取得
  //   $term_id = $term_obj->term_id;
  //   $term_slug = $term_obj->slug;
  //   $term_name = $term_obj->name;
  //   $term_parent = $term_obj->parent;
  //   $term_description = $term_obj->description;
  //   $term_taxonomy = $term_obj->taxonomy;

  // echo "<pre>";
  // var_dump($term_obj);
  // echo "</pre>";

  $terms = get_the_terms($term_obj->ID, 'area');

  foreach ($terms as $term) {
    if ($term->parent == 0) {
      $parent_term = $term;
    } else {
      $child_term = $term;
    }
  }


  $post_id = get_the_ID();
  ?>



  <div id="topic__path" class="topic__path">
    <div id="topic__path" class="topic__path">
      <ol class="topic__path--list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a itemprop="item" href="https://www.otakaraya.jp/"><span itemprop="name">買取専門店・おたからやTOP</span></a>
          <meta itemprop="position" content="1">
        </li>
        <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a itemprop="item" href="/brand-tokei/"><span itemprop="name">ブランド時計買取</span></a>
          <meta itemprop="position" content="2">
        </li>
        <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a itemprop="item" href="/brand-tokei/shop/"><span itemprop="name">お近くの店舗を探す</span></a>
          <meta itemprop="position" content="3">
        </li>
        <li class="topic__path--item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a itemprop="item" href="/brand-tokei/shop/<?php echo $parent_term->slug; ?>/"><span itemprop="name"><?php echo $parent_term->name; ?>の店舗一覧</span></a>
          <meta itemprop="position" content="4">
        </li>
        <li class="topic__path--item">
          <span><?php echo $term_obj->post_title; ?>のブランド時計買取店舗一覧</span>
          <meta itemprop="position" content="5">
        </li>
      </ol>
    </div>
  </div>

  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
  ?>

      <section class="top_content_section">
        <div class="titleMain titleMain--wrapper">
          <?php
          $view_flg = get_field('new_shop_open');
          if ($view_flg[0] == 'open') :
          ?>
            <p class="new_shop_open_date"><?php echo get_field('new_shop_open_date'); ?>オープン!</p>
          <?php endif; ?>
          <h2 class="titleMain--main"><?php //echo get_field('n_shop_title'); 
                                      ?></h2>
        </div>

        <!--     ▼▼▼ページトップスライダー▼▼▼     -->
        <?php get_template_part('/template-parts/common/page_top_slider'); ?>
        <!--     ▲▲▲ページトップスライダー▲▲▲     -->


        <style>
          @media (min-width: 768px) {
            #shopdetail .slide__wrap01 {
              max-width: 100%;
            }
          }
        </style>

      </section>

      <main class="contents">
        <article class="contents__left">

          <!--     ▼▼▼おたからやセールスポイント▼▼▼     -->

          <section>
            <h1 class="titleHeading">
              <?php the_field('h1title'); ?>
            </h1>
            <div class="titleMain--lead">

            </div>
          </section>

          <!--     ▲▲▲おたからやがセールスポイント▲▲▲     -->

              <!--     ▼▼▼店舗情報▼▼▼     -->

          <section class="shop__detail">

            <?php
            $page_top_slider_repeat = get_field('page_top_slider_repeat', $post_id);
            //if (!empty($page_top_slider_repeat)) :
            ?>


            <h2 class="titleSub"><?php
                                  if (empty(get_field('n_shop_name_info'))) {
                                    echo "ブランド時計の買取価格No1！<br>" . $shop_name . "でのブランド時計買取ならおたからや！";
                                  } else {
                                    echo get_field('n_shop_name_info');
                                  } ?>
            </h2>


            <?php //endif; 
            ?>

            <?php if (!empty(get_field('n_shop_leadtext'))) : ?>
              <div class="shop__detail--leadTxt titleMain--lead">
                <?php echo nl2br(get_field('n_shop_leadtext')); ?>
              </div>
            <?php endif; ?>

            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php echo $shop_name;?>エリアでブランド時計の買取査定額<span style="color:#444444; white-space: nowrap;">アップキャンペーン中の</span><br>おたからや店舗
              </h2>
            </div>

            <?php 
            if (have_rows('honten_name')) :
              $a_cnt = 1;
              while (have_rows('honten_name')) : the_row();
                $honten_slug = get_sub_field('honten_slug');
                $shop_id = get_page_by_path($honten_slug, 'OBJECT', 'shop');

                $addrGrp = get_field('n_address', $shop_id);
                if ($addrGrp) :
                  $from_station = array();
                  $addrGrp_station = $addrGrp['n_address_station'];
                  if ($addrGrp_station) :
                    foreach ($addrGrp_station as $station) :
                      $from_station[] = $station['n_address_from_station'];
                    endforeach;
                  endif;
                endif;

                $accesses = get_field('shop_inside', $shop_id);
                $first_img = '';
                if(!empty($accesses)){
                  $first_access = reset($accesses);
                  $first_img = $first_access['shop_inside_img'];
                }
                
                $first_img = attachment_url_to_postid($first_img);
                $size = 'medium';
                $attr = strip_tags(get_sub_field('n_store2access_rf__contents', $shop_id));
                $default_attr = array(
                  'alt'   => $attr,
                );
                $icon = false;
                

                ?>
                <h3 style="font-weight:normal; margin-top:4rem;">おたからや　<?php echo get_the_title($shop_id); ?></h3>
                <div class="honten_shop">
                  <div>
                    <?php echo wp_get_attachment_image($first_img, $size, $icon, $default_attr);?>
                  </div>
                  
                  <table style="margin-top:0px; margin-left:1rem;">
                    <tr>
                      <th>住所</th>
                      <td>
                        <p><?php echo $addrGrp['n_address_text']; ?></p>
                      </td>
                    </tr>
                    <tr>
                      <th>電話番号</th>
                      <td>
                        <?php
                        if (!empty(get_field('n_tel1_text', $shop_id))) {
                          $tel1 = get_field('n_tel1_text', $shop_id);
                        ?>
                          <a href="tel:" . <?php echo $tel1 ?> class="phone-number is-sp"> <?php echo $tel1 ?></a>
                          <p class="is-pc"> <?php echo $tel1 ?> </p>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <th>最寄り駅</th>
                      <td>
                        <p><?php echo implode("<br>", $from_station); ?></p>
                      </td>
                    </tr>
                    <tr>
                      <th>営業時間</th>
                      <td><?php the_field('n_open_text', $shop_id); ?>
                        <?php
                        $view_flg = get_field('new_shop_open', $shop_id);
                        if ($view_flg[0] == 'open') :
                        ?>
                          <span><?php echo get_field('new_shop_open_date', $shop_id); ?>オープン!</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th>定休日</th>
                      <td><?php the_field('n_close_text', $shop_id); ?></td>
                    </tr>
                    <?php the_field('parking_info_repeat_name', $shop_id); ?>
                    <tr>

                    <tr>
                      <th>駐車場</th>
                      <td>
                      <?php 
                        $parking = get_field('parking_info_repeat', $shop_id);
                        // $park_array = array();
                        // foreach($parking as $park){
                        //   $park_array[] = $park['parking_info_repeat_name'];
                        // }
                        if (!empty($parking)){
                          echo '有り';
                          // echo implode("、", $park_array);
                        }else{
                          echo '無し';
                        }
                      ?>
                      </td>
                    </tr>
                    <?php if(!empty(get_field('n_kinrin_area', $shop_id))):?>
                    <tr>
                      <th>近隣エリア</th>
                      <td><?php the_field('n_kinrin_area', $shop_id); ?></td>
                    </tr>
                    <?php endif; ?>
                  </table>
                  
                </div>
                <div class="btn__wrap btn__red" style="margin-right:0; margin-bottom:3rem; margin-top:1rem;">
                  <a href="/brand-tokei/shop/<?php echo get_post_field('post_name', $shop_id); ?>">詳細はこちら</a>
                </div>
            <?php
              endwhile;
            endif;
            ?>
            <style>
              @media (min-width: 768px) {
                .honten_shop {
                  display: flex;
                } 
              }
              @media (max-width: 767px) {
                .honten_shop div {
                  text-align: center;
                }
              }
            </style>

          </section>

          <!--     ▲▲▲店舗情報▲▲▲     -->


      <?php
    endwhile;
  endif;
      ?>
      

      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta02'); ?>


      <!--     ▼▼▼よくある質問▼▼▼     -->

      <?php get_template_part('/template-parts/faq/faq'); ?>

      <!--     ▲▲▲よくある質問▲▲▲     -->




      <!--     ▼▼▼高価買取できる8つの理由▼▼▼     -->
      <?php
      $get_page_id = get_page_by_path('reason_purchase');
      $get_page_id = $get_page_id->ID;
      if (have_rows('purchase_reason_repeat', $get_page_id)) :
      ?>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main"><?php the_field('purchase_reason_headline', $get_page_id); ?></h2>
          </div>

          <div class="horizonlist is-pc">
            <?php while (have_rows('purchase_reason_repeat', $get_page_id)) : the_row(); ?>
              <div class="horizonlist--link">
                <div class="horizonlist--img"><img src="<?php the_sub_field('purchase_reason_repeat_img'); ?>" alt=<?php echo strip_tags(get_sub_field('purchase_reason_repeat_title')); ?>></div>
                <div class="horizonlist--text">
                  <h4 class="titleH4 title--left"><?php the_sub_field('purchase_reason_repeat_title'); ?></h4>
                  <p><?php the_sub_field('purchase_reason_repeat_explanation'); ?></p>
                </div>
              </div>
            <?php endwhile; ?>
          </div>

        </section>
      <?php
      endif;
      ?>
      <!-- pagenation -->
      <div class="is-sp flex--slide__pagenation">
        <div class="pagenation--arrows purchase_reason_slider--arrow"></div>
        <div class="pagenation--dots purchase_reason_slider--dot"></div>
      </div>
      <div class="numbox is-sp">
        <div class="numbox--inner sel_slider_sp" style="margin-bottom:0%">
          <div id="purchase_reason_slider" class="numbox__slide onlysp " style="margin-bottom:0%">
            <?php
            if (have_rows('purchase_reason_repeat', $get_page_id)) :
              $cnt = 1;
              while (have_rows('purchase_reason_repeat', $get_page_id)) : the_row(); ?>
                <div>
                  <div class="numbox__slide--link">
                    <div class="numbox__slide--img"><span><?php echo sprintf('%02d', $cnt);  ?></span>
                      <img src="<?php the_sub_field('purchase_reason_repeat_img'); ?>" alt=<?php echo strip_tags(get_sub_field('purchase_reason_repeat_title')); ?>>
                    </div>
                    <dl>
                      <dt class="numbox__slide--title"><?php the_sub_field('purchase_reason_repeat_title'); ?></dt>
                      <dd class="numbox__slide--text"><?php echo nl2br(get_sub_field('purchase_reason_repeat_explanation')); ?></dd>
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
      <!--     ▲▲▲高価買取できる8つの理由▲▲▲     -->



      <!--     ▼▼▼ジャンル別買取情報▼▼▼     -->

      <?php get_template_part('/template-parts/common/flex_open'); ?>

      <!--     ▲▲▲ジャンル別買取情報▲▲▲     -->


        </article>



        <!--     ▼▼▼サイドメニュー▼▼▼     -->

        <?php get_template_part('/template-parts/navigation/side_menu'); ?>

        <!--     ▲▲▲サイドメニュー▲▲▲     -->


        <style>
          @media (max-width: 767px) {
            .titleSub {
              font-size: 20px;
            }

            #shopdetail .colBox.sp__col02 {
              gap: 10px 10px;
              padding: 0;
            }
          }

          .new_shop_open_date {
            background-color: #d82400;
            color: #fff;
            width: fit-content;
            margin: auto;
            padding: 10px;
            border-radius: 30px;
            font-weight: bold;
          }

          .top_content_section .titleMain::before {
            content: none;
          }

          .top_content_section .titleMain--wrapper {
            margin-top: 0rem;
          }

          @media (min-width: 768px) {
            #shopdetail .shop__detail table tr {
              font-size: 17px;
            }
          }

          .phone-number {
            color: #007BFF;
            /* リンクの色を設定 */
            text-decoration: none;
            /* リンクの下線を削除 */
          }

          @media (max-width: 767px) {
            .sel_slider_sp {
              width: 60%;
              margin: 0 auto 10px;
              margin-left: auto;
              margin-right: auto;
            }
          }
        </style>



      </main>
      <?php
      get_footer();
