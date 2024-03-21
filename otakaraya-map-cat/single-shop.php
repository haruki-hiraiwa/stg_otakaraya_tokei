<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

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
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span itemprop="name">買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の買取</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/shop/"><span itemprop="name">お近くの店舗を探す</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/shop/<?php echo $parent_term->slug; ?>/"><span itemprop="name"><?php echo $parent_term->name; ?>の店舗一覧</span></a>
      </li>
      <li class="topic__path--item"><span><?php echo $term_obj->post_title; ?></span></li>
    </ol>
  </div>


  <?php
  if (have_posts()) :
    while (have_posts()) : the_post();
      $addrGrp = get_field('n_address');
      if ($addrGrp) :
        $from_station = array();
        $addrGrp_station = $addrGrp['n_address_station'];
        if ($addrGrp_station) :
          foreach ($addrGrp_station as $station) :
            $from_station[] = $station['n_address_from_station'];
          endforeach;
        endif;
      endif;
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

          <!--     ▼▼▼臨時休業▼▼▼     -->
          <section>
            <?php
            if (!empty(get_field('temporary_closed_text', $post_id))) {
              $current_date = date_i18n('Y-m-d H:i:s');
              $temporary_closed__start_time = get_post_meta($post_id, 'temporary_closed_start', true);
              $temporary_closed__end_time = get_post_meta($post_id, 'temporary_closed_end', true);

              if (strtotime($current_date) >= strtotime($temporary_closed__start_time) && strtotime($current_date) <= strtotime($temporary_closed__end_time)) {
            ?>
                <div class="temporary_closed">
                  <?php echo get_field('temporary_closed_text', $post_id); ?>
                  <div>
                <?php
              }
            }
                ?>
          </section>
          <style>
            .temporary_closed {
              border: solid 2px #060;
              text-align: center;
              padding: 10px;
              font-size: 14px;
              color: #060;
              width: 80%;
              margin-left: auto;
              margin-right: auto;
              margin-bottom: 2rem;
            }
          </style>
          <!--     ▲▲▲臨時休業▲▲▲     -->




          <!--     ▼▼▼店舗情報▼▼▼     -->

          <section class="shop__detail" style="margin-top: 0;">

            <?php
            $page_top_slider_repeat = get_field('page_top_slider_repeat', $post_id);
            //if (!empty($page_top_slider_repeat)) :
            ?>

            <h3 class="titleSub"><?php
                                  if (empty(get_field('n_shop_name_info'))) {
                                    echo "ブランド時計の買取価格No1！<br>おたからや " . get_the_title();
                                  } else {
                                    echo get_field('n_shop_name_info');
                                  } ?>
            </h3>

            <?php //endif; 
            ?>

            <?php if (!empty(get_field('n_shop_leadtext'))) : ?>
              <div class="shop__detail--leadTxt titleMain--lead">
                <?php echo nl2br(get_field('n_shop_leadtext')); ?>
              </div>
            <?php endif; ?>


            <table>
              <tr>
                <th>住所/駅/徒歩</th>
                <td>
                  <p>〒<?php echo $addrGrp['n_zip_a_text']; ?>　<?php echo $addrGrp['n_address_text']; ?><br><?php echo implode("<br>", $from_station); ?></p>
                </td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>
                  <?php
                  if (!empty(get_field('n_tel1_text'))) {
                    $tel1 = get_field('n_tel1_text');
                  ?>
                    <a href="tel:" . <?php echo $tel1 ?> class="phone-number is-sp"> <?php echo $tel1 ?></a>
                    <p class="is-pc"> <?php echo $tel1 ?> </p>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <th>定休日</th>
                <td><?php the_field('n_close_text'); ?></td>
              </tr>
              <tr>
                <th>営業時間</th>
                <td><?php the_field('n_open_text'); ?>
                  <?php
                  $view_flg = get_field('new_shop_open');
                  if ($view_flg[0] == 'open') :
                  ?>
                    <span><?php echo get_field('new_shop_open_date'); ?>オープン!</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th>近隣エリア</th>
                <td><?php the_field('n_kinrin_area'); ?></td>
              </tr>
            </table>

            <?php
            $map_position = get_field('map_position');
            if ($map_position) {
              $lat = $map_position['lat'];
              $lng = $map_position['lng'];
            }
            ?>
            <?php
            if (!empty(get_field('shop_navi_img')) || !empty($lat)) :
            ?>
              <div class="flex">
                <!-- タブメニュー -->
                <ul class="flex__tab">

                  <?php
                  if (!empty(get_field('shop_navi_img'))) :
                  ?>
                    <li class="tab__item active"><a><?php the_title(); ?><br class="is-sp">案内図</a></li>
                  <?php
                    $img_active = "active";
                  else :
                    $img_active = "";
                    $map_active = "active";
                  endif;
                  if (!empty($lat)) :
                  ?>
                    <li class="tab__item <?php echo $map_active; ?>"><a>Google Map<br class="is-sp">で見る</a></li>
                  <?php endif; ?>
                </ul>
                <!-- タブコンテンツ -->
                <div class="flex__tabContents">
                  <?php
                  // プロフィールページで設定した画像を取得
                  $access_img = get_field('shop_navi_img');
                  // if (!empty($access_img)) :
                  ?>
                  <div class="flex__content tab_img <?php echo $img_active; ?>">
                    <?php if (empty($access_img)) : ?>
                      <img src="/brand-tokei/wp-content/uploads/2023/04/IMG_0288.jpg" alt="">
                    <?php else : ?>

                      <?php
                      //echo wp_get_attachment_image($access_img, 'full');
                      $attr = strip_tags(get_the_title());
                      $default_attr = array(
                        'alt'   => $attr,
                      );
                      $icon = false;
                      echo wp_get_attachment_image($access_img, 'full', $icon, $default_attr);
                      ?>


                    <?php endif; ?>
                  </div>
                  <?php //endif;
                  ?>
                  <?php
                  if (!empty($lat)) :
                  ?>
                    <div class="p-map-search" id="google_map">
                      <div id="map-search" class="p-map-search__inner">
                        <div class="p-map-search__click" id="click-mode">出発地をクリックして下さい</div>
                        <div class="p-map-search__mode" id="route-mode"></div>
                        <div class="p-map-search__distance" id="route-distance">
                          <div class="p-map-search__distance-minute"><span id="route-distance-minute">12</span></div>
                          <div class="p-map-search__distance-km"><span id="route-distance-km">0.2</span></div>
                        </div>
                        <div class="p-map-search__select">
                          <select id="start-point">
                            <option value="">出発地をお選びください</option>
                            <option value="click">地図をクリック...</option>
                            <option value="gps">現在地から</option>
                            <?php
                            $near_stations = get_field('near_stations');

                            if ($near_stations) {
                            ?>
                              <optgroup label="近くの駅から">
                                <?php
                                foreach ($near_stations as $near_station) {
                                ?>
                                  <option value="" data-lat="<?php echo $near_station['position']['lat'] ?>" data-lng="<?php echo $near_station['position']['lng'] ?>"><?php echo $near_station['name'] ?></option>
                                <?php
                                }
                                ?>
                              </optgroup>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div id="map-frame" class="flex__content <?php echo $map_active; ?>" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>"></div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

          </section>

          <!--     ▲▲▲店舗情報▲▲▲     -->




          <!--     ▼▼▼店舗別取扱サービス▼▼▼     -->

          <?php
          // 選択したチェックボックスの情報を取得
          $service_types_obj = get_field_object('service_types');
          $service_types = $service_types_obj['value'];
          if (!empty($service_types)) :
          ?>
            <section class="shop__detail--services">

              <h3 class="titleSub">
                <?php
                if (empty(get_field('n_shop_name_service'))) {
                  echo "おたからや" . get_the_title() . "の" . "<br class=is-sp>取扱サービス";
                } else {
                  echo get_field('n_shop_name_service');
                } ?>
              </h3>

              <div class="colBox colBox__col06 sp__col04">

                <?php
                // 選択したチェックボックスの情報を取得
                $service_types_obj = get_field_object('service_types');
                $service_types = $service_types_obj['value'];

                foreach ($service_types as $service_type) :

                  if ($service_type === 'free_appraisal') :
                    $service_type_no = '001';
                  elseif ($service_type === 'parking') :
                    $service_type_no = '002';
                  elseif ($service_type === 'reserve') :
                    $service_type_no = '003';
                  elseif ($service_type === 'private_room') :
                    $service_type_no = '004';
                  elseif ($service_type === 'holidays') :
                    $service_type_no = '005';
                  elseif ($service_type === 'toilet') :
                    $service_type_no = '006';
                  elseif ($service_type === 'gold') :
                    $service_type_no = '007';
                  elseif ($service_type === 'jewelry') :
                    $service_type_no = '008';
                  elseif ($service_type === 'watch') :
                    $service_type_no = '009';
                  elseif ($service_type === 'brand') :
                    $service_type_no = '010';
                  endif; ?>
                  <div class="col">
                    <div class="img"><img src="<?php echo THEME_URL; ?>assets/img/shop/area/detail/shop_detail-icon<?php echo $service_type_no; ?>.png" alt=<?php
                                                                                                                                                            echo strip_tags($service_types_obj['choices'][$service_type]);
                                                                                                                                                            ?>></div>
                    <p class="text text--center"><?php echo $service_types_obj['choices'][$service_type] ?></p>
                  </div>
                <?php endforeach; ?>

              </div>
            </section>
          <?php endif; ?>

          <!--     ▲▲▲店舗別取扱サービス▲▲▲     -->



          <?php get_template_part('/template-parts/cta/cta01'); ?>
          <?php get_template_part('/template-parts/cta/cta02'); ?>





          <!--     ▼▼▼駐車場▼▼▼     -->

          <?php
          if (have_rows('parking_info_repeat')) :
          ?>
            <section class="shop__detail shop__detail--parking">
              <div class="titleMain titleMain--wrapper">
                <h2 class="titleMain--main">
                  駐車場
                </h2>
              </div>
              <?php
              $s_cnt = 1;
              while (have_rows('parking_info_repeat')) : the_row();
              ?>
                <table>
                  <caption><?php echo get_sub_field('parking_info_repeat_name') ?></caption>
                  <tr>
                    <th>住所</th>
                    <td><?php echo get_sub_field('parking_info_repeat_address') ?></td>
                  </tr>
                  <tr>
                    <th>収容台数</th>
                    <td><?php echo get_sub_field('parking_info_repeat_address_capacity') ?></td>
                  </tr>
                  <tr>
                    <th>営業時間・料金</th>
                    <td><?php echo get_sub_field('parking_info_repeat_price') ?></td>
                  </tr>
                </table>
              <?php
                $s_cnt++;
              endwhile;
              ?>

            </section>
          <?php
          endif;
          ?>

          <!--     ▲▲▲駐車場▲▲▲     -->



          <!--     ▼▼▼アクセス▼▼▼     -->

          <?php
          if (have_rows('n_store2access_rf')) :

            $rp_cnt =  count(get_field('n_store2access_rf'));

          ?>
            <section class="shop__detail--access">
              <div class="titleMain titleMain--wrapper">
                <h2 class="titleMain--main">
                  アクセス
                </h2>
              </div>

              <div class="flex flex--hasItem<?php echo $rp_cnt; ?>"> <!-- タブメニュー -->
                <ul class="flex__tab">
                  <?php
                  $s_cnt = 1;
                  while (have_rows('n_store2access_rf')) : the_row();
                  ?>
                    <li class="tab__item <?php if ($s_cnt == 1) : ?>active<?php endif; ?>"><a><?php echo get_sub_field('n_store2access_station') ?></a></li>
                  <?php
                    $s_cnt++;
                  endwhile;
                  ?>

                </ul>
                <!-- タブコンテンツ -->
                <div class="flex__tabContents">
                  <?php
                  $s_cnt = 1;
                  while (have_rows('n_store2access_rf')) : the_row();
                  ?>
                    <div class="flex__content <?php if ($s_cnt == 1) : ?>active<?php endif; ?>">
                      <div class="numbox">
                        <div id="numbox-slider-sp<?php echo $s_cnt ?>" class="numbox__slide onlysp">


                          <?php
                          if (have_rows('n_store2access_station_repeat')) :
                            $a_cnt = 1;
                            while (have_rows('n_store2access_station_repeat')) : the_row();
                              $shop_navi_img = get_sub_field('n_store2access_rf__img');
                              $size = 'medium';
                          ?>

                              <div>
                                <div class="numbox__slide--inner">
                                  <p class="numbox__slide--img"><span><?php echo str_pad($a_cnt, 2, 0, STR_PAD_LEFT); ?></span>
                                    <?php
                                    $attr = get_sub_field('n_store2access_rf__contents');
                                    $default_attr = array(
                                      'alt'   => $attr,
                                    );
                                    $icon = false;
                                    echo wp_get_attachment_image($shop_navi_img, $size, $icon, $default_attr);
                                    ?></p>
                                  <p class="numbox__slide--text"><?php the_sub_field('n_store2access_rf__contents'); ?></p>
                                </div>
                              </div>
                          <?php
                              $a_cnt++;
                            endwhile;
                          endif;
                          ?>
                        </div>
                        <!-- pagenation -->
                        <div class="flex--slide__pagenation">
                          <div class="pagenation--arrows numbox-slider-sp<?php echo $s_cnt ?>--arrow"></div>
                          <div class="pagenation--dots numbox-slider-sp<?php echo $s_cnt ?>--dot"></div>
                        </div>
                      </div>
                    </div>
                  <?php
                    $s_cnt++;
                  endwhile;
                  ?>
                </div>
              </div>
            </section>
          <?php
          endif;
          ?>

          <!--     ▲▲▲アクセス▲▲▲     -->


          <!--     ▼▼▼店内イメージ▼▼▼     -->

          <?php
          if (have_rows('shop_inside', $post_id)) :
            $rp_cnt =  count(get_field('shop_inside'));
          ?>
            <section class="shop__detail--access">
              <div class="titleMain titleMain--wrapper">
                <h2 class="titleMain--main">
                  店内の<span>紹介</span>
                </h2>
              </div>

              <div class="flex flex--hasItem<?php echo $rp_cnt; ?>"> <!-- タブメニュー -->
                <!-- タブコンテンツ -->
                <div class="flex__content active">
                  <div class="numbox">
                    <div id="numbox-slider-shop_inside" class="numbox__slide onlysp">
                      <?php
                      $s_cnt = 1;
                      while (have_rows('shop_inside', $post_id)) : the_row();
                        $shop_inside_img = get_sub_field('shop_inside_img', $post_id);
                      ?>
                        <div>
                          <div class="numbox__slide--inner">
                            <div class="numbox__slide--img inside_shop">
                              <img src="<?php echo esc_url($shop_inside_img); ?>" alt="">
                            </div>
                            <p class="numbox__slide--text"><?php the_sub_field('shop_inside_text', $post_id); ?></p>
                          </div>
                        </div>
                      <?php
                        $s_cnt++;
                      endwhile;
                      ?>
                    </div>
                    <!-- pagenation -->
                    <div class="flex--slide__pagenation is-sp">
                      <div class="pagenation--arrows numbox-slider-shop_inside--arrow"></div>
                      <div class="pagenation--dots numbox-slider-shop_inside--dot"></div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </section>
          <?php
          endif;
          ?>

          <style>
            .inside_shop {
              position: relative;
              width: 100%;
              padding-top: calc(2 / 3 * 100%);
              overflow: hidden;
            }

            .inside_shop img {
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              object-fit: cover;
            }
          </style>
          <!--     ▲▲▲店内イメージ▲▲▲     -->

          <section>
          </section>

          <!--     ▼▼▼店長コメント▼▼▼     -->
          <?php get_template_part('/template-parts/common/manager_comment'); ?>
          <!--     ▲▲▲店長コメント▲▲▲     -->

          <!--     ▼▼▼近隣店舗▼▼▼     -->

          <?php
          $terms = get_the_terms($post->ID, 'area');

          foreach ($terms as $term) {
            if ($term->parent == 0) {
              $term_parent = $term->name;
              $term_parent_slug = $term->slug;
            } else {
              $term_child = $term->name;
              $term_child_slug = $term->slug;
            }
          }
          ?>

          <section class="shop__detail--shoplist">


            <?php
            $mode = "";
            if ($_GET["mode"]) {
              $mode = $_GET["mode"];
            }
            ?>
            <?php if (!$mode == "test") { ?>

              <div class="shopAcod">
                <div class="titleMain titleMain--wrapper">
                  <h2 class="titleMain--main">
                    近隣店舗の<span>紹介</span>
                  </h2>
                  <div class="titleMain--lead">
                    <p>おたからやは業界最多・買取店舗数<br>全国1000店舗以上！</p>
                  </div>
                </div>
                <?php
                $the_query = new WP_Query(array(
                  'post_status' => 'publish',
                  'post_type' => 'shop',
                  'tax_query' => array(
                    'relation' => 'AND',
                    array(
                      'taxonomy' => 'area',
                      'field' => 'slug',
                      'terms' => $term_child_slug,
                    )
                  ),
                  'posts_per_page' => -1,
                  'orderby' => 'id',
                  'order' => 'DESC',
                ));



                if ($the_query->have_posts()) :
                ?>

                  <dl class="shopAcod__city js-acod01">
                    <dt class="acod__switch">近隣店舗一覧</dt>
                    <dd class="acod__contents">
                      <ul>
                        <?php
                        $current_slug = get_post_field('post_name', get_the_ID());
                        $icinity_post_num = 0;

                        while ($the_query->have_posts()) :
                          $slug = get_post(get_the_ID())->post_name;
                          $the_query->the_post();
                          $addrGrp = get_field('n_address');
                          if ($addrGrp) :
                            $from_station = array();
                            $addrGrp_station = $addrGrp['n_address_station'];
                            if ($addrGrp_station) :
                              foreach ($addrGrp_station as $station) :
                                $from_station[] = $station['n_address_from_station'];
                              endforeach;
                            endif;
                          endif;
                          $slug = get_post_field('post_name', get_the_ID());

                          $icinity_post_num = ++$icinity_post_num;
                        ?>


                          <?php if ($current_slug == $slug) : ?>



                          <?php else : ?>
                            <li>
                              <table>
                                <caption class="text--bold text--colorRed02"><?php the_title() ?></caption>
                                <tr>
                                  <th>住所/駅/徒歩</th>
                                  <td>
                                    <p>〒<?php echo $addrGrp['n_zip_a_text']; ?>　<?php echo $addrGrp['n_address_text']; ?><br><?php echo implode("<br>", $from_station); ?></p>

                                    <?php if (have_rows('n_way_text_rf')) :
                                      while (have_rows('n_way_text_rf')) : the_row(); ?>
                                        <p><?php the_field('n_way_text_rf__contents'); ?></p>
                                  </td>
                              <?php endwhile;
                                    endif; ?>
                                </tr>
                                <tr>
                                  <th>電話番号</th>
                                  <td><?php the_field('n_tel1_text'); ?></td>
                                </tr>
                                <tr>
                                  <th>定休日</th>
                                  <td><?php the_field('n_close_text'); ?></td>
                                </tr>
                                <tr>
                                  <th>営業時間</th>
                                  <td><?php the_field('n_open_text'); ?></td>
                                </tr>
                              </table>
                              <div class="shopAcod--btn">
                                <div class="btn__wrap btn__red">
                                  <a href="<?php echo get_permalink(get_page_by_path(get_post_field('post_name', get_the_ID()))->ID); ?>">詳細を見る</a>
                                </div>
                              </div>
                            </li>
                          <?php endif; ?>



                        <?php
                        endwhile;
                        ?>
                      </ul>
                    </dd>
                  </dl>
                <?php
                endif;
                ?>


                <div class="btn__wrap btn__red">
                  <a href="<?php echo "https://www.otakaraya.jp/brand-tokei/shop/"; ?>"> <?php echo "ブランド時計買取の店舗ページ一覧"; ?> </a>
                </div>
                <?php
                if ($icinity_post_num <= 1) : ?>

                  <style>
                    .shopAcod {
                      display: none;
                    }
                  </style>

                <?php endif; ?>

              </div>

              <section class="is-pc">
                <h3 class="titleSub"><?php echo $term_parent; ?>のおたからや直営店</h3>
                <!-- 背景枠あり要素内通常ボタン -->
                <div class="shop__detail--shopBtnList" style="justify-content: space-between;padding: 16px 45px;">
                  <?php
                  $the_query = new WP_Query(array(
                    'post_status' => 'publish',
                    'post_type' => 'shop',
                    'tax_query' => array(
                      'relation' => 'AND',
                      array(
                        'taxonomy' => 'area',
                        'field' => 'slug',
                        'terms' => $term_parent_slug,
                      )
                    ),
                    'posts_per_page' => -1,
                    'orderby' => 'id',
                    'order' => 'DESC',
                  ));
                  $current_post_id = get_the_ID();

                  $prefecture_post_num = 0;

                  if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) :
                      $prefecture_post_num = ++$prefecture_post_num;

                      $the_query->the_post();
                      $addrGrp = get_field('n_address');
                      $post_id = get_the_ID();
                      $prefecture_slug = get_post(get_the_ID())->post_name;
                  ?>
                      <?php if ($current_slug == $prefecture_slug) { ?>


                      <?php } else { ?>
                        <div class="btn__wrap btn__normal--back">
                          <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title() ?></a>
                        </div>
                      <?php  }; ?>

                  <?php
                    endwhile;
                  endif;
                  ?>


                  <?php
                  if ($prefecture_post_num <= 1) : ?>

                    <style>
                      .shop__detail--shoplist section {
                        display: none;
                      }
                    </style>

                  <?php endif; ?>


                </div>
              </section>


              <section class="is-sp">
                <dl class="shopAcod__city js-acod01">
                  <dt class="acod__switch"><?php echo $term_parent; ?>のおたからや店舗</dt>
                  <dd class="acod__contents">
                    <?php
                    $the_query = new WP_Query(array(
                      'post_status' => 'publish',
                      'post_type' => 'shop',
                      'tax_query' => array(
                        'relation' => 'AND',
                        array(
                          'taxonomy' => 'area',
                          'field' => 'slug',
                          'terms' => $term_parent_slug,
                        )
                      ),
                      'posts_per_page' => -1,
                      'orderby' => 'id',
                      'order' => 'DESC',
                    ));
                    $current_post_id = get_the_ID();

                    $prefecture_post_num = 0;

                    if ($the_query->have_posts()) :
                      while ($the_query->have_posts()) :
                        $prefecture_post_num = ++$prefecture_post_num;

                        $the_query->the_post();
                        $addrGrp = get_field('n_address');
                        $post_id = get_the_ID();
                        $prefecture_slug = get_post(get_the_ID())->post_name;
                    ?>
                        <?php if ($current_slug == $prefecture_slug) { ?>


                        <?php } else { ?>
                          <div class="btn__wrap btn__normal--back" style="margin:1rem auto 0;">
                            <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title() ?></a>
                          </div>
                        <?php  }; ?>

                    <?php
                      endwhile;
                    endif;
                    ?>


                    <?php
                    if ($prefecture_post_num <= 1) : ?>

                      <style>
                        .shop__detail--shoplist section {
                          display: none;
                        }
                      </style>

                    <?php endif; ?>
                  </dd>

                </dl>

              </section>

            <?php  } else {; ?>

              <div class="shopAcod">
                <div class="titleMain titleMain--wrapper">
                  <h2 class="titleMain--main">
                    近隣店舗の<span>紹介</span>
                  </h2>
                  <div class="titleMain--lead">
                    <p>おたからやは業界最多・買取店舗数<br>全国1000店舗以上！</p>
                  </div>
                </div>
                <?php
                $the_query = new WP_Query(array(
                  'post_status' => 'publish',
                  'post_type' => 'shop',
                  'tax_query' => array(
                    'relation' => 'AND',
                    array(
                      'taxonomy' => 'area',
                      'field' => 'slug',
                      'terms' => $term_child_slug,
                    )
                  ),
                  'posts_per_page' => -1,
                  'orderby' => 'id',
                  'order' => 'DESC',
                ));

                if ($the_query->have_posts()) :
                ?>

                  <dl class="shopAcod__city js-acod01">
                    <dt class="acod__switch">近隣店舗一覧</dt>
                    <dd class="acod__contents">
                      <ul>
                        <?php
                        while ($the_query->have_posts()) :
                          $the_query->the_post();
                          $addrGrp = get_field('n_address');
                          if ($addrGrp) :
                            $from_station = array();
                            $addrGrp_station = $addrGrp['n_address_station'];
                            if ($addrGrp_station) :
                              foreach ($addrGrp_station as $station) :
                                $from_station[] = $station['n_address_from_station'];
                              endforeach;
                            endif;
                          endif;
                        ?>
                          <li>
                            <table>
                              <caption class="text--bold text--colorRed02"><?php the_title() ?></caption>
                              <tr>
                                <th>住所/駅/徒歩</th>
                                <td>
                                  <p>〒<?php echo $addrGrp['n_zip_a_text']; ?>　<?php echo $addrGrp['n_address_text']; ?><br><?php echo implode("<br>", $from_station); ?></p>

                                  <?php if (have_rows('n_way_text_rf')) :
                                    while (have_rows('n_way_text_rf')) : the_row(); ?>
                                      <p><?php the_field('n_way_text_rf__contents'); ?></p>
                                </td>
                            <?php endwhile;
                                  endif; ?>
                              </tr>
                              <tr>
                                <th>電話番号</th>
                                <td><?php the_field('n_tel1_text'); ?></td>
                              </tr>
                              <tr>
                                <th>定休日</th>
                                <td><?php the_field('n_close_text'); ?></td>
                              </tr>
                              <tr>
                                <th>営業時間</th>
                                <td><?php the_field('n_open_text'); ?></td>
                              </tr>
                            </table>
                            <div class="shopAcod--btn">
                              <div class="btn__wrap btn__red">
                                <a href="<?php echo get_permalink(get_page_by_path(get_post_field('post_name', get_the_ID()))->ID); ?>">詳細を見る</a>



                              </div>
                            </div>
                          </li>

                        <?php
                        endwhile;
                        ?>
                      </ul>
                    </dd>
                  </dl>
                <?php
                endif;
                ?>
              </div>

              <div class="btn__wrap btn__red">
                <a href="<?php echo "https://www.otakaraya.jp/brand-tokei/shop/"; ?>"> <?php echo "ブランド時計買取の店舗ページ一覧"; ?> </a>
              </div>
              <section>
                <h3 class="titleSub">近隣のおたからや直営店</h3>
                <!-- 背景枠あり要素内通常ボタン -->
                <div class="shop__detail--shopBtnList">
                  <?php
                  $the_query = new WP_Query(array(
                    'post_status' => 'publish',
                    'post_type' => 'shop',
                    'tax_query' => array(
                      'relation' => 'AND',
                      array(
                        'taxonomy' => 'area',
                        'field' => 'slug',
                        'terms' => $term_parent_slug,
                      )
                    ),
                    'posts_per_page' => -1,
                    'orderby' => 'id',
                    'order' => 'DESC',
                  ));

                  if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) :
                      $the_query->the_post();
                      $addrGrp = get_field('n_address');
                  ?>
                      <div class="btn__wrap btn__normal--back">
                        <a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title() ?></a>
                      </div>
                  <?php
                    endwhile;
                  endif;
                  ?>


                </div>
              </section>
            <?php  }; ?>




          </section>

          <!--     ▲▲▲近隣店舗▲▲▲     -->



          <!--     ▼▼▼買取実績▼▼▼     -->
          <section>
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php echo get_the_title(); ?>
                の<span>買取実績</span>
              </h2>
              <div class="titleMain--lead">
                <p>買取価格に関しては時期や相場により<br>変動致しますので、お問合せ下さい</p>
              </div>
            </div>
            <div class="flex">
              <div class="flex__content active flex_content_wrap">
                <?php if (is_single('sendai-honten')) { ?>
                  <ul id="flex-slider1" class="content__list flex--slide">
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/audemarspiguet/royal-oak/15680/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/251.webp" alt="ロイヤルオーク 15400ST.OO.1220ST.01 SS ブラック">
                          </p>
                          <p class="content--name">ロイヤルオーク<br>15400ST.<br>OO.1220ST.01 SS ブラック</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">6,200,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/vacheronconstantin/14641/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/03100.webp" alt="オーヴァーシーズ クロノグラフ 5500V/110A-B148 SS">
                          </p>
                          <p class="content--name">オーヴァーシーズ クロノグラフ 5500V/110A-B148 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">5,300,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/lange-soehne/15516/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/979d1267b272b6f2ded09258ec4fe61c.webp" alt="グランド ランゲ1 117.028/LS1173AD WG">
                          </p>
                          <p class="content--name">グランド ランゲ1 117.028/LS1173AD WG</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,700,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/breguet/14575/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/28-1.webp" alt="マリーンII クロノグラフ 5827BR/Z2/5ZU PG">
                          </p>
                          <p class="content--name">マリーンII クロノグラフ 5827BR/Z2/5ZU PG</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,200,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/iwc/portugieser/11077/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2021/12/17be1e49e257775620abc88145d2d6a9.webp" alt="ポルトギーゼ オートマティック 7デイズ  IW500705 SS">
                          </p>
                          <p class="content--name">ポルトギーゼ オートマティック 7デイズ IW500705 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">750,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/breitling/navitimer/12545/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2021/12/18501.webp" alt="ナビタイマー クロノグラフ 41 U13324211B1A1 SS">
                          </p>
                          <p class="content--name">ナビタイマー クロノグラフ 41 U13324211B1A1 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">450,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/hublot/bigbang/15496/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/d46acc76b849a62fd51ace8af44038ac.webp" alt="ビッグ・バン フェラーリ キングゴールド 401.OX.0123.VR">
                          </p>
                          <p class="content--name">ビッグ・バン フェラーリ キングゴールド 401.OX.0123.VR</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,200,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/jaeger-lecoultre/17377/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/08/1660.webp" alt="ジャガー・ルクルト レベルソ デュエット クラシック 256.2.75 PG/レザー ブラック/ホワイト">
                          </p>
                          <p class="content--name">ジャガー・ルクルト レベルソ デュエット クラシック 256.2.75 PG/レザー ブラック/ホワイト</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">1,000,000<span>円</span></p>
                      </div>
                    </li>
                  </ul>

                <?php } elseif (is_single(array('tsuyama', 'yonago'))) { ?>
                  <ul id="flex-slider1" class="content__list flex--slide">
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/audemarspiguet/royal-oak/15680/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/251.webp" alt="ロイヤルオーク15400ST.OO.1220ST.01 SS ブラック">
                          </p>
                          <p class="content--name">ロイヤルオーク15400ST.OO.1220ST.01 SS ブラック</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">6,200,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/patekphilippe/nautilus/14637/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/91c4b9d029b66b31af750c4113c1805e.webp" alt="パテックフィリップ ノーチラス SS ブラックブルー 5711/1A-001(010)">
                          </p>
                          <p class="content--name">パテックフィリップ ノーチラス SS ブラックブルー 5711/1A-001(010)</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">22,000,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/vacheronconstantin/14641/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/03100.webp" alt="オーヴァーシーズ クロノグラフ 5500V/110A-B148 SS">
                          </p>
                          <p class="content--name">オーヴァーシーズ クロノグラフ 5500V/110A-B148 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">5,300,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/lange-soehne/15516/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/979d1267b272b6f2ded09258ec4fe61c.webp" alt="グランド ランゲ1 117.028/LS1173AD WG">
                          </p>
                          <p class="content--name">グランド ランゲ1 117.028/LS1173AD WG</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,700,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/breguet/14575/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/28-1.webp" alt="マリーンII クロノグラフ 5827BR/Z2/5ZU PG">
                          </p>
                          <p class="content--name">マリーンII クロノグラフ 5827BR/Z2/5ZU PG</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,200,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/iwc/portugieser/11077/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2021/12/17be1e49e257775620abc88145d2d6a9.webp" alt="ポルトギーゼ オートマティック 7デイズ  IW500705 SS">
                          </p>
                          <p class="content--name">ポルトギーゼ オートマティック 7デイズ IW500705 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">750,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/breitling/navitimer/12545/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2021/12/18501.webp" alt="ナビタイマー クロノグラフ 41 U13324211B1A1 SS">
                          </p>
                          <p class="content--name">ナビタイマー クロノグラフ 41 U13324211B1A1 SS</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">450,000<span>円</span></p>
                      </div>
                    </li>
                    <li class="content__item">
                      <a href="https://www.otakaraya.jp/brand-tokei/result/hublot/bigbang/15496/" class="img__link">
                        <div class="content_item_wrap">
                          <p class="content__image img">
                            <img src="https://www.otakaraya.jp/brand-tokei/wp-content/uploads/2022/03/d46acc76b849a62fd51ace8af44038ac.webp" alt="ビッグ・バン フェラーリ キングゴールド 401.OX.0123.VR">
                          </p>
                          <p class="content--name">ビッグ・バン フェラーリ キングゴールド 401.OX.0123.VR</p>

                        </div>
                      </a>
                      <div class="content__text">
                        <p class="content--title">買取実績</p>
                        <p class="content--price">2,200,000<span>円</span></p>
                      </div>
                    </li>
                  </ul>

                <?php } else { ?>
                  <ul id="flex-slider1" class="content__list flex--slide">


                    <?php
                    $args = array(
                      'posts_per_page' => 16, // 表示する投稿数
                      'post_type' => 'result', // 取得する投稿タイプのスラッグ
                      'meta_key' => 'display_order_field_key',
                      'orderby' => 'meta_value_num',
                      'order' => 'ASC', // 降順 or 昇順
                      'suppress_filters' => false,
                      'custom_orderby' => true
                    );

                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()) :
                      while ($the_query->have_posts()) : $the_query->the_post();

                        $model_img = get_field('img_path');
                        $size = 'thumbnail';
                        // medium, large, fullなども指定可能
                    ?>
                        <li class="content__item">
                          <a href="<?php echo get_permalink() ?>" class="img__link">
                            <div class="content_item_wrap">
                              <p class="content__image img">
                                <?php if (!empty($model_img)) : ?>
                                  <?php

                                  //echo wp_get_attachment_image($model_img, $size); 
                                  $attr = get_the_title();
                                  $default_attr = array(
                                    'alt'   => $attr,
                                  );
                                  $icon = false;
                                  echo wp_get_attachment_image($model_img, $size, $icon, $default_attr);

                                  ?>
                                <?php else : ?>
                                  <img src="<?php echo THEME_URL; ?>assets/img/parts/parts_flex_img.png" alt="">
                                <?php endif; ?>
                              </p>
                              <p class="content--name"><?php the_title(); ?></p>
                            </div>
                          </a>
                          <div class="content__text">
                            <p class="content--title">買取実績</p>
                            <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                          </div>
                        </li>
                      <?php endwhile; ?>
                      <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                  </ul>
                <?php } ?>

                <!-- pagenation -->
                <div class="flex--slide__pagenation">
                  <div class="pagenation--arrows flex-slider1--arrow"></div>
                  <div class="pagenation--dots flex-slider1--dot"></div>
                </div>
              </div>
            </div>

          </section>



      <?php
    endwhile;
  endif;
      ?>


      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta02'); ?>


      <!--     ▼▼▼よくある質問▼▼▼     -->

      <?php get_template_part('/template-parts/faq/faq'); ?>

      <!--     ▲▲▲よくある質問▲▲▲     -->




      <!--     高価買取できる8つの理由     -->


      <?php
      if (have_rows('purchase_reason_repeat', 19594)) :
      ?>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main"><?php the_field('purchase_reason_headline', 19594); ?></h2>
          </div>

          <div class="horizonlist is-pc">
            <?php while (have_rows('purchase_reason_repeat', 19594)) : the_row(); ?>
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
            if (have_rows('purchase_reason_repeat', 19594)) :
              $cnt = 1;
              while (have_rows('purchase_reason_repeat', 19594)) : the_row(); ?>
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




      <!--     高価買取できる8つの理由     -->




      <!--     ▼▼▼お客様の口コミ▼▼▼     -->

      <?php get_template_part('/template-parts/voice/shop_voice'); ?>

      <!--     ▲▲▲お客様の口コミ▲▲▲     -->





      <!--     ▼▼▼ジャンル別買取情報▼▼▼     -->

      <?php
      if (have_rows('genre_purchase_goods_repeat')) :
      ?>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              <?php echo get_field('genre_purchase_goods_headline'); ?>
            </h2>
          </div>
          <div class="colBox colBox__col04 sp__col02">
            <?php
            while (have_rows('genre_purchase_goods_repeat')) : the_row();
            ?>
              <div class="col">
                <a href="<?php the_sub_field('genre_purchase_goods_repeat_url'); ?>" class="img__link">
                  <div class="img">
                    <p class="is-pc"><img src="<?php the_sub_field('genre_purchase_goods_repeat_img'); ?>" alt=<?php the_sub_field('genre_purchase_goods_repeat_name'); ?>></p>
                    <p class="is-sp"><img src="<?php the_sub_field('genre_purchase_goods_repeat_img'); ?>" alt=<?php the_sub_field('genre_purchase_goods_repeat_name'); ?>></p>
                  </div>
                  <p class="text text--center"><?php the_sub_field('genre_purchase_goods_repeat_name'); ?></p>
                </a>
              </div>
            <?php
            endwhile;
            ?>
          </div>
        </section>
      <?php
      endif;
      ?>

      <!--     ▲▲▲ジャンル別買取情報▲▲▲     -->

      <!-- 店舗導線追加 -->
      <section class="shop__detail--shoplist">
        <?php
        $url = $_SERVER['REQUEST_URI'];
        $last_segment = basename(parse_url($url, PHP_URL_PATH));
        $categories = ['brand', 'gold', 'brand-tokei', 'daiya', 'app'];
        $base_url = 'https://www.otakaraya.jp/';
        echo '<div class="shop__detail--shopBtnList" style="justify-content: space-between;padding: 16px 45px;">';
        foreach ($categories as $category) {
          $link_url = $base_url . $category . '/shop/' . $last_segment . '/';
          $url_segments = '/' . $category . '/shop/' . $last_segment . '/';

          switch ($category) {
            case 'brand':
              $category = "ブランド";
              break;
            case 'gold':
              $category = "金";
              break;
            case 'daiya':
              $category = "宝石";
              break;
            case 'brand-tokei':
              $category = "ブランド時計";
              break;
            case 'app':
              $link_url = $base_url  . 'shop/' . $last_segment . '/';
              $category = "総合";
              break;
          }
          // 現在のURLと一致しない場合
          if ($url_segments !== $url) {
            echo '<div class="btn__wrap btn__normal--back">';
            echo '<a style="margin:1rem auto 0;" href="' . $link_url . '">';
            echo $category . 'の' . get_the_title(); // 店舗名
            echo '</a>';
            echo '</div>';
          }
        }
        echo '</div>';
        ?>

      </section>

      <!-- 店舗導線追加 -->


      <!--     ▼▼▼コラム▼▼▼     -->

      <?php get_template_part('/template-parts/common/column_from_sougou'); ?>

      <!--     ▲▲▲コラム▲▲▲     -->





        </article>





        <!--     ▼▼▼サイドメニュー▼▼▼     -->

        <?php get_template_part('/template-parts/navigation/side_menu'); ?>

        <!--     ▲▲▲サイドメニュー▲▲▲     -->


        <style>
          #shopdetail .cta .cta__btns {
            display: flex;
          }

          @media (max-width: 767px) {
            .titleSub {
              font-size: 20px;
            }

            #shopdetail .cta .cta__btns {
              flex-direction: column;
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

          /* スライダーした揃え */
          .flex_content_wrap .content__item {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
          }

          .flex_content_wrap .content__list {
            align-items: stretch !important;
          }

          .flex_content_wrap .slick-slider .slick-track,
          .flex_content_wrap .slick-slider .slick-list {
            display: -webkit-box;
          }

          .flex_content_wrap .content--title {
            margin-top: 0rem !important;
          }

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

            .numbox {
              margin: 2rem 0rem 0;
            }
          }

          /* スライダーした揃え */
        </style>


      </main>
      <?php
      get_footer();
