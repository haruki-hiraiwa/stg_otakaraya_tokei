<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');


?>

<body id="shop" class="shop_area">

  <?php
  get_header();

  /***** カテゴリ情報取得 *****/
  $term_obj = get_queried_object(); // タームオブジェクトを取得
  $term_id = $term_obj->term_id;
  $term_slug = $term_obj->slug;
  $term_name = $term_obj->name;
  $term_parent = $term_obj->parent;
  $term_description = $term_obj->description;
  $term_taxonomy = $term_obj->taxonomy;

  ?>


  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item"><a href="https://www.otakaraya.jp/">買取専門店・おたからやTOP</a></li>
      <li class="topic__path--item"><a href="/brand-tokei/">ブランド時計の買取</a></li>
      <li class="topic__path--item"><a href="/brand-tokei/shop/">お近くの店舗を探す</a></li>
      <li class="topic__path--item"><span><?php echo $term_name; ?>の店舗一覧</span></li>
    </ol>
  </div>


  <main class="contents">
    <article class="contents__left">

      <section>
        <div class="shopAcod">
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              <?php echo $term_name; ?>の<span>店舗一覧</span>
            </h2>
          </div>

          <?php
          $city_terms = get_terms('area', ['parent' => $term_id, 'orderby' => 'id']);
          foreach ($city_terms as $city_term) :

            $the_query = new WP_Query(array(
              'post_status' => 'publish',
              'post_type' => $post_type,
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'area',
                  'field' => 'slug',
                  'terms' => $city_term->slug,
                )
              ),
              'posts_per_page' => -1,
              'orderby' => 'menu_order',
              'order' => 'ASC',
            ));

            if ($the_query->have_posts()) :
          ?>
              <dl class="shopAcod__city js-acod01">
                <dt class="acod__switch"><?php echo $city_term->name ?></dt>
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
                            <a href="/brand-tokei/shop/<?php echo $post->post_name ?>/">詳細を見る</a>
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
          endforeach;
          ?>

        </div>
      </section>



      <!--     ▼▼▼ショップエリア▼▼▼     -->

      <?php get_template_part('/template-parts/shop/shop_area'); ?>

      <!--     ▲▲▲ショップエリア▲▲▲     -->



      <section>
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
