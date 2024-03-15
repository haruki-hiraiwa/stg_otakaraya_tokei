<?php
/* ブランドページ（カテゴリページ）テンプレート */


/***** カテゴリ情報取得 *****/
$term_obj = get_queried_object(); // タームオブジェクトを取得
$term_id = $term_obj->term_id;
$term_slug = $term_obj->slug;
$term_name = $term_obj->name;
$term_parent = $term_obj->parent;
$term_description = $term_obj->description;
$term_taxonomy = $term_obj->taxonomy;

// echo "<pre>";
// var_dump($term_obj);
// echo "</pre>";
if ($term_parent != 0) :
  $parent_term = get_term($term_parent);
endif;

//result_cat/brand-watchが含まれていたらリダイレクト
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($current_url, "/result_cat/")) {

  if (empty($parent_term))
    wp_redirect("https://www.otakaraya.jp/brand-tokei/result/" . $term_slug, 301);
  else
    wp_redirect("https://www.otakaraya.jp/brand-tokei/result/" . $parent_term->slug . "/" . $term_slug, 301);
  exit;
}

get_template_part('head');



?>

<body id="<?php if ($term_parent == 0) : ?>result_brand<?php else : ?>result<?php endif; ?>">

  <?php
  $parent_term_name = $parent_term->name;
  if (strpos($term_name, $parent_term_name) !== false) {
    $str_name = str_replace($parent_term_name, '', $term_name);
    $str_name = $parent_term_name . " " . $str_name;
  } else {
    $str_name = $parent_term_name . " " . $term_name;
  };
  ?>

  <?php
  get_header();
  ?>


  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の高価買取</span></a>
      </li>

      <?php
      if ($term_parent == 0) :
      ?>


        <?php
        $url = "https://www.otakaraya.jp/brand-tokei/" . $term_slug;
        $get_header = @get_headers($url);
        if ($get_header[0] != "HTTP/1.1 404 Not Found") : ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/<?php echo $term_slug; ?>/"><span><?php echo $term_name; ?>の高価買取</span></a>
          </li>
        <?php else : ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/result/"><span>ブランド時計の買取実績一覧</span></a>
          </li>
        <?php endif; ?>



        <li class="topic__path--item"><span><?php echo $term_name; ?>買取実績・価格</span></li>

        <?php
      else :

        $url = "https://www.otakaraya.jp/brand-tokei/" . $parent_term->slug;
        $get_header = @get_headers($url);

        if ($get_header[0] != "HTTP/1.1 404 Not Found") {
        ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/<?php echo $parent_term->slug; ?>/"><span><?php echo $parent_term->name; ?>の高価買取</span></a>
          </li>
        <?php
        } else {
        ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/result/"><span>ブランド時計の買取実績一覧</span></a>
          </li>
        <?php
        }

        $url = "https://www.otakaraya.jp/brand-tokei/" . $parent_term->slug . "/" . $term_slug;
        $get_header = @get_headers($url);

        if ($get_header[0] != "HTTP/1.1 404 Not Found") {
        ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/<?php echo $parent_term->slug; ?>/<?php echo $term_slug; ?>/"><span><?php echo $str_name; ?>の高価買取</span></a>
          </li>
        <?php } ?>


        <li class="topic__path--item"><span><?php echo $str_name; ?>買取実績・価格</span></li>

      <?php
      endif;
      ?>
    </ol>
  </div>







  <main class="contents">
    <article class="contents__left">



      <?php
      if ($term_parent == 0) :

        // echo "parent";

      ?>

        <!--     ▼▼▼ブランド　モデル名　から探す▼▼▼     -->

        <section class="model_search_section">

          <?php
          $tax = get_queried_object();
          $tax_name = $tax->taxonomy;
          $my_term_id = $tax->term_id;
          $term_slug = $tax->slug;
          $check = get_term_children($my_term_id, $tax_name);

          if ($check) : //子タームがある場合
          ?>


            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php echo $term_name; ?><br class="is-sp">のモデル名から<br><span>買取実績を探す</span>
              </h2>
            </div>
            <div class="result-brand__wrap">

              <?php
              $ordered_term_ids = array(230, 235, 238, 237, 231, 234, 360, 239, 241, 233, 359, 240, 242, 354, 236, 229, 232, 226, 224, 286, 225, 227, 228, 264, 266, 267, 268, 265, 257, 272, 258, 259, 363, 262, 274, 261, 281, 280, 282, 352, 275, 277, 276, 288, 290, 289, 291, 400, 293, 295, 296, 294, 299, 303, 302, 300, 406, 304, 301, 346, 347, 244, 250);   // ここでIDの順序を指定

              $termchildren = get_term_children($my_term_id, $tax_name);

              // 指定したIDの中で実際に現在の親タームに属している子タームのIDのみを取得
              $valid_ordered_ids = array_intersect($ordered_term_ids, $termchildren);

              // 指定されていないIDのリストを取得
              $unspecified_term_ids = array_diff($termchildren, $valid_ordered_ids);

              // 指定したIDの配列と指定されていないIDのリストを結合
              $all_term_ids = array_merge($valid_ordered_ids, $unspecified_term_ids);

              foreach ($all_term_ids as $child) {
                $term = get_term_by('id', $child, $tax_name);
                $my_term_id = $term->term_id;
                $term_link = get_term_link($term);
                $my_term_name = $term->name;
                $termchild_description = strip_tags(term_description($my_term_id));
                $termchild_description = wp_html_excerpt($termchild_description, 60);
                if (mb_strlen($termchild_description) < 60) {
                  $description_excerpt = $termchild_description;
                } else {
                  $description_excerpt = $termchild_description . '…';
                }
              ?>


                <?php



                $custom_post_type_name = get_post_type();

                $args = array(
                  'post_type' => $custom_post_type_name,
                  'posts_per_page' => 1,
                  'tax_query' => array(
                    array(
                      'taxonomy' => $term_taxonomy,
                      'field'    => 'slug',
                      'terms'    => $term->slug,
                    ),
                  ),
                );

                $the_query = new WP_Query($args);
                $cnt_all = $the_query->found_posts;

                $args_category = array(
                  'post_type' => $custom_post_type_name,
                  'posts_per_page' => 1,
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'category',
                      'field'    => 'slug',
                      'terms'    => $term->slug,
                    ),
                  ),
                );

                $the_query_category = new WP_Query($args_category);

                while ($the_query->have_posts()) : $the_query->the_post();
                  $model_img = get_field('img_path');
                  $size = 'thumbnail';
                ?>

                  <div class="btn__wrap btn__more">
                    <a href="<?php echo $term_link; ?>">
                      <div class="icon_img" style="text-align: center;"><img src="<?php echo $model_img; ?>" alt=<?php echo $my_term_name; ?>></div>
                      <div class="model_link model_icon_tex">
                        <span>
                          <?php echo $my_term_name; ?>
                        </span>
                        <span>
                          <?php echo $term->slug; ?>
                        </span>
                      </div>
                    </a>
                  </div>
              <?php
                endwhile;
              }
              ?>
            </div>

            <style>
              @media (max-width: 767px) {
                .result-brand__wrap .btn__more a {
                  display: flex;
                  align-items: center;
                }

                .icon_img img {
                  width: 60px;
                  height: 60px;
                  margin-right: 10px;
                }

                .model_icon_tex {}
              }

              @media (min-width: 768px) {
                .result-brand__wrap .btn__more a {
                  /*display: flex;*/

                  align-items: center;
                }

                .icon_img img {
                  width: 100px;
                  height: 100px;
                }

                .model_icon_tex {
                  text-align: center;
                }
              }
            </style>

            <?php get_template_part('/template-parts/cta/cta01'); ?>
            <?php get_template_part('/template-parts/cta/cta03'); ?>


          <?php
          else : //子タームがない場合

          ?>
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php echo $term_name; ?>一覧から<br><span>買取実績を探す</span>
              </h2>
            </div>
            <div class="result-model__flex flex flex_content_wrap">
              <div class="flex__content active">
                <?php if ($cnt_all < 3) {
                ?>
                  <ul id="flex-slider-sp5" class="content__list onlysp">
                    <!-- <ul class="content__list onlysp"> -->
                  <?php } else { ?>
                    <ul id="flex-slider-sp5" class="content__list onlysp">
                    <?php } ?>

                    <?php
                    while (have_posts()) : the_post();
                      $child_description = mb_substr(get_the_excerpt(), 0, 60);
                      if (mb_strlen($child_description) < 60) {
                        $child_description_excerpt = $child_description;
                      } else {
                        $child_description_excerpt = $child_description . '…';
                      }

                      $model_img = get_field('img_path');

                      $size = 'thumbnail';

                    ?>


                      <li class="content__item">
                        <a href="<?php echo get_permalink() ?>" class="img__link">
                          <div class="content_image_wrap">
                            <?php if (!empty($model_img)) : ?>
                              <p class="content__image img">
                                <?php
                                //echo wp_get_attachment_image($model_img, $size);
                                $attr = get_the_title() . "の買取実績";
                                $default_attr = array(
                                  'alt'   => $attr,
                                );
                                $icon = false;
                                echo wp_get_attachment_image($model_img, $size, $icon, $default_attr);
                                ?>
                              </p>
                            <?php else : ?>
                              <p class="content__image img"><img src="/brand-tokei/wp-content/themes/otakaraya/assets/img/parts/flex/dummy_img.png"></p>
                            <?php endif; ?>
                            <p class="content--name">
                              <?php
                              the_title();
                              ?>
                            </p>
                          </div>
                        </a>
                        <div class="content__text">
                          <p class="content--title">買取実績</p>
                          <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                        </div>
                      </li>


                    <?php
                    endwhile;
                    ?>

                    </ul>
                    <!-- pagenation -->
                    <div class="flex--slide__pagenation">
                      <div class="pagenation--arrows flex-slider-sp5--arrow"></div>
                      <div class="pagenation--dots flex-slider-sp5--dot"></div>
                    </div>

                    <div class="btn__wrap btn__red">
                      <?php echo '<a href="' . "https://www.otakaraya.jp/brand-tokei/result/" . '">' .  "<center>ブランド時計の買取実績一覧はこちら</center>" . '</a>' ?>
                    </div>
              </div>
            </div>

          <?php
          endif;
          ?>

          <style>
            #flex-slider-sp5 .content__item:nth-child(n+5) {
              display: block;
            }
          </style>


        </section>

        <!--     ▲▲▲ブランド　モデル名　から探す▲▲▲     -->




        <!--     ▼▼▼ブランド　モデル名　買取実績▼▼▼     -->


        <?php
        if ($current_url == "https://www.otakaraya.jp/brand-tokei/result/rolex/") {
          $custom_order = array(
            'term_id_1' => 230,
            'term_id_2' => 235,
            'term_id_3' => 238,
            'term_id_4' => 237,
            'term_id_5' => 231,
            'term_id_6' => 234,
            'term_id_7' => 360,
            'term_id_8' => 239,
            'term_id_9' => 241,
            'term_id_10' => 233,
            'term_id_11' => 359,
            'term_id_12' => 240,
            'term_id_13' => 242,
            'term_id_14' => 354,
            'term_id_15' => 236,
            'term_id_16' => 229
          );
        }

        if (!empty($custom_order)) {
          $args = array(
            'taxonomy'   => $term_taxonomy,
            'orderby'    => 'include',  // includeパラメータを使用して順序を指定
            'order'      => 'ASC',      // 昇順
            'hide_empty' => true,
            'number'     => 1000,
            'child_of'   => $term_id,
            'include'    => array_values($custom_order),  // 指定された順序で表示するタームのIDを配列で指定
          );
        } else {
          $args = array(
            'taxonomy' => $term_taxonomy, // タクソノミースタッグを指定
            //'orderby' => 'term_id', // カテゴリー名のアルファベット順
            'order' => 'DESC', // ASC：昇順（初期値）、DESC：降順
            'hide_empty' => true, // 投稿のないカテゴリーの扱い、true：空カテゴリーを隠す、false：全て表示
            'number' => 1000,
            'child_of' => $term_id
          );
        }

        $the_query = new WP_Term_Query($args);
        $m_cnt = 1;
        foreach ($the_query->get_terms() as $child) : // 繰り返し処理の開始
          $term_info = get_term_by("id", $child->term_id, $term_taxonomy);
          // $term_link .= $term_info->slug;
          // echo "<pre>";
          // var_dump($term_info);
          // echo "</pre>";

          $custom_post_type_name = get_post_type();

          $args = array(
            'post_type' => $custom_post_type_name,
            'posts_per_page' => 16,
            'tax_query' => array(
              array(
                'taxonomy' => $term_taxonomy,
                'field'    => 'slug',
                'terms'    => $term_info->slug,
              ),
            ),
          );

          // echo "<pre>";
          // var_dump($args);
          // echo "</pre>";

          $the_query = new WP_Query($args);
          $cnt_all = $the_query->found_posts;

          $str_term_info = $term_info->name;
          if (strpos($str_term_info, $term_name) !== false) {
            $str_name_info = str_replace($term_name, '', $str_term_info);
            $str_name_info = $term_name . " " . $str_name_info;
          } else {
            $str_name_info = $term_name . " " . $str_term_info;
          };
        ?>

          <section>
            <div class="titleMain titleMain--wrapper">
              <h2 class="titleMain--main">
                <?php echo $str_name_info ?><br class="is-sp"><span>買取実績</span>
              </h2>
              <h3 class="titleMain--lead">
                <p>※買取価格に関しては時期や相場により変動致しますので、お問合せ下さい。</p>
              </h3>
            </div>




            <?php if ($the_query->have_posts()) : ?>
              <div class="flex flex_content_wrap">
                <!-- タブコンテンツ -->
                <div class="flex__content active">




                  <!-- スライダーが２個以下ならスライドしない -->
                  <?php if ($cnt_all < 4) { ?>

                    <?php if ($cnt_all < 2) { ?>
                      <ul class="content__list">

                      <?php } else { ?>

                        <ul id="<?php if (wp_is_mobile()) {
                                  echo "flex-slider" . $m_cnt;
                                } ?>" class="content__list">

                        <?php }  ?>


                      <?php } else { ?>
                        <ul id="flex-slider<?php echo $m_cnt; ?>" class="content__list flex--slide">
                          <?php
                        }
                        while ($the_query->have_posts()) : $the_query->the_post();

                          $model_img = get_field('img_path');
                          $size = 'thumbnail';
                          // medium, large, fullなども指定可能
                          if (wp_is_mobile() && $cnt_all < 3) {
                          ?>
                            <li class="content__item" style="width: 100vw; margin:auto;">
                            <?php
                          } else {
                            ?>
                            <li class="content__item" style="width: 100vw;">
                            <?php } ?>

                            <a href=" <?php echo get_permalink() ?>" class="img__link">
                              <div class="content_image_wrap">
                                <p class="content__image img"><?php echo wp_get_attachment_image($model_img, $size); ?></p>
                                <p class="content--name">
                                  <?php
                                  the_title();
                                  ?>
                                </p>
                              </div>
                            </a>

                            <div class="content__text">
                              <p class="content--title">買取実績</p>
                              <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                            </div>
                            </li>

                          <?php endwhile; ?>


                        </ul>
                        <!-- pagenation -->
                        <?php if ($cnt_all > 2) : ?>
                          <div class="flex--slide__pagenation">
                            <div class="pagenation--arrows flex-slider<?php echo $m_cnt; ?>--arrow"></div>
                            <div class="pagenation--dots flex-slider<?php echo $m_cnt; ?>--dot"></div>
                          </div>
                        <?php endif; ?>
                        <div class="btn__wrap--result-brand btn__wrap btn__red">
                          <a href="/brand-tokei/result/<?php echo $term_slug; ?>/<?php echo $term_info->slug; ?>/">
                            <center><?php echo $str_name_info ?>の買取実績</center>
                          </a>
                        </div>
                </div>
              </div>


            <?php endif; ?>
          </section>
          <?php $m_cnt++; ?>
        <?php endforeach;
        wp_reset_postdata(); ?>

        <style>
          .flex_content_wrap .content__item {
            display: flex !important;
            flex-direction: column;
            justify-content: space-between;
          }

          .flex_content_wrap .content__list {
            align-items: stretch;
            justify-content: center;
          }



          .flex_content_wrap .content--title {
            margin-top: 0rem !important;
          }
        </style>


        <section></section>
        <section>

          <?php get_template_part('/template-parts/cta/cta01'); ?>
          <?php get_template_part('/template-parts/cta/cta03'); ?>

        </section>

        <!--     ▲▲▲ブランド　モデル名　買取実績▲▲▲     -->





        <!--     ▼▼▼おたからやの買取商品から探す▼▼▼     -->

        <?php get_template_part('/template-parts/common/otakaraya_purchase_goods'); ?>

        <!--     ▲▲▲おたからやの買取商品から探す▲▲▲     -->


      <?php
      else :
      ?>

        <!--     ▼▼▼買取実績▼▼▼     -->

        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              <?php echo $str_name; ?>のモデル名から<br><span>買取実績を探す</span>
            </h2>
          </div>
          <div class="result-model__flex flex flex_content_wrap">

            <?php
            $args = array(
              'post_type' => 'result',
              'posts_per_page' => 16,
              'tax_query' => array(
                array(
                  'taxonomy' => $term_taxonomy,
                  'field'    => 'slug',
                  'terms'    => $term_slug,
                ),
              ),
            );
            $the_query = new WP_Query($args);
            $cnt_all = $the_query->found_posts;
            ?>
            <!-- ターム名 end -->
            <?php if ($the_query->have_posts()) : ?>
              <div class="flex__content active">

                <?php if ($cnt_all < 4) { ?>
                  <?php if ($cnt_all < 2) { ?>
                    <ul class="content__list onlysp">
                    <?php } else { ?>
                      <ul id="<?php if (wp_is_mobile()) {
                                echo "flex-slider-sp5";
                              } ?>" class="content__list onlysp">
                      <?php }  ?>

                    <?php } else { ?>
                      <ul id="flex-slider-sp5" class="content__list onlysp">
                      <?php
                    } ?>



                      <?php
                      while ($the_query->have_posts()) : $the_query->the_post();

                        $model_img = get_field('img_path');
                        $size = 'thumbnail';
                      ?>

                        <li class="content__item" style="width: 100vw;"><a href="<?php echo get_permalink() ?>" class="img__link">

                            <div class="content_image_wrap">
                              <p class="content__image img"><?php echo wp_get_attachment_image($model_img, $size); ?></p>
                              <p class="content--name">
                                <?php
                                the_title(); ?>
                              </p>
                            </div>

                          </a>
                          <div class="content__text">
                            <p class="content--title">買取実績</p>
                            <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                          </div>
                        </li>


                      <?php endwhile; ?>
                      </ul>

                      <!-- pagenation -->
                      <?php if ($cnt_all > 2) : ?>
                        <div class="flex--slide__pagenation">
                          <div class="pagenation--arrows flex-slider-sp5--arrow"></div>
                          <div class="pagenation--dots flex-slider-sp5--dot"></div>
                        </div>
                      <?php endif; ?>

                      <div class="btn__wrap btn__red">
                        <?php echo '<a href="' . "https://www.otakaraya.jp/brand-tokei/result/" . $parent_term->slug . '">' .  "<center>" . strip_tags($parent_term->name) . "の買取実績一覧はこちら</center>" . '</a>' ?>
                      </div>
              </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
          </div>

        </section>
        <section></section>

        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>

        <style>
          .result-model__flex .content__list .content__item {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
          }

          .result-model__flex .content__list {
            align-items: stretch !important;
          }

          .result-model__flex .content__list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
          }

          @media (min-width: 768px) and (max-width: 1100px) {
            .result-model__flex .flex__content .content__item {
              width: 30.1% !important;
              max-width: 200px;
              margin: 0 1.6%;
              margin-bottom: 15px;
            }

            .result-model__flex .flex__content .content__list {
              gap: 0px;
            }
          }
        </style>

        <!--     ▲▲▲買取実績▲▲▲     -->





        <!--     ▼▼▼ブランドから探す▼▼▼     -->

        <section></section>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              ブランドから<span>探す</span>
            </h2>
          </div>
          <div class="result-model__btnWrap">

            <?php
            $terms = get_terms($term_taxonomy, ['parent' => 0]);
            foreach ($terms as $term) :
            ?>


              <div class="btn__wrap btn__normal">
                <a href="<?php echo get_term_link($term) ?>"><?php echo $term->name; ?></a>
              </div>

            <?php endforeach; ?>

          </div>
        </section>

        <!--     ▲▲▲ブランドから探す▲▲▲     -->



        <!--     ▼▼▼おたからやの買取商品から探す▼▼▼     -->

        <?php get_template_part('/template-parts/common/otakaraya_purchase_goods'); ?>

        <!--     ▲▲▲おたからやの買取商品から探す▲▲▲     -->



      <?php
      endif;
      ?>



    </article>





    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->


    <style>
      .result-model__flex .flex__content .content__list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;

      }



      .result-model__flex .slick-list {
        display: grid;
      }



      @media (min-width: 768px) and (max-width: 1100px) {
        .result-model__flex .flex__content .content__item {
          width: 30.1% !important;
          max-width: 200px;
          margin: 0 1.6%;
        }

        .result-model__flex .flex__content .content__list {
          gap: 0px;
        }
      }

      @media (min-width: 768px) {
        .btn__wrap--result-brand {
          max-width: 392px;
        }

      }

      @media (max-width: 767px) {
        .slick-track {
          display: flex;
          align-items: stretch;
        }

        .slick-list.draggable {
          display: flex;
          align-items: stretch;
        }

        .flex__content .content__item {
          width: 100vw;
        }

        .flex__content .content__list {
          flex-wrap: nowrap;
        }

      }
    </style>


  </main>




  <?php
  get_footer();
