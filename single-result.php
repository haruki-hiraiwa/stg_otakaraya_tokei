<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

?>

<body id="result">

  <?php
  get_header();

  // 	/***** カテゴリ情報取得 *****/
  //   $term_obj = get_queried_object(); // タームオブジェクトを取得
  //   $term_id = $term_obj->term_id;
  //   $term_child_slug = $term_obj->slug;
  //   $term_name = $term_obj->name;
  //   $term_parent = $term_obj->parent;
  //   $term_description = $term_obj->description;
  //   $term_taxonomy = $term_obj->taxonomy;

  // echo "<pre>";
  // var_dump($term_obj);
  // echo "</pre>";
  ?>




  <?php
  if (have_posts()) : the_post();
    $post_id = $post->ID;
    $terms = get_the_terms($post_id, 'result_cat');
    if ($terms) :
      foreach ($terms as $term) {
        if ($term->parent == 0) {
          $term_parent_name = $term->name;
          $term_parent_slug = $term->slug;
        } else {
          $term_child_name = $term->name;
          $term_child_slug = $term->slug;
        }
      }

    endif;
  endif;
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
      $url = "https://www.otakaraya.jp/brand-tokei/" . $term_parent_slug;
      $get_header = @get_headers($url);
      if ($get_header[0] != "HTTP/1.1 404 Not Found") :
      ?>
        <li class="topic__path--item">
          <a href="/brand-tokei/<?php echo $term_parent_slug; ?>/"><span><?php echo $term_parent_name; ?>の高価買取</span></a>
        </li>
      <?php else : ?>
        <li class="topic__path--item">
          <a href="/brand-tokei/result/"><span>ブランド時計の買取実績一覧</span></a>
        </li>
      <?php endif; ?>

      <?php
      if (!empty($term_child_slug)) {
        $url = "https://www.otakaraya.jp/brand-tokei/" . $term_parent_slug . "/" . $term_child_slug;
        $get_header = @get_headers($url);
        if ($get_header[0] != "HTTP/1.1 404 Not Found") {
      ?>
          <li class="topic__path--item">
            <a href="/brand-tokei/<?php echo $term_parent_slug; ?>/<?php echo $term_child_slug; ?>/"><span><?php echo $term_parent_name; ?><?php echo $term_child_name; ?>の高価買取</span></a>
          </li>
      <?php }
      }
      ?>

      <li class="topic__path--item">
        <a href="/brand-tokei/result/<?php echo $term_parent_slug; ?>/<?php echo $term_child_slug; ?>/"><span><?php echo $term_parent_name; ?><?php echo $term_child_name; ?>買取実績・価格</span></a>
      </li>

      <li class="topic__path--item"><span><?php the_title(); ?>の買取実績・価格</span></li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">
      <!-- Header -->

      <!--     ▼▼▼買取実績(詳細)▼▼▼     -->

      <?php

      $model_img = get_field('img_path');
      $size = array(220, 111);
      ?>
      <section>
        <h2 class="titleHeading"><?php the_title(); ?>の買取実績</h2>
        <div class="kaitoriDetail">
          <div class="kaitoriDetail__inner">
            <figure class="kaitoriDetail__image"><?php echo wp_get_attachment_image($model_img, 'full'); ?></figure>
            <dl class="kaitoriDetail__definition">

              <dt class="title">ブランド名</dt>
              <dd class="text"><?php echo $term_parent_name; ?></dd>
              <dt class="title">モデル名</dt>
              <dd class="text"><?php echo $term_child_name; ?></dd>
              <dt class="title">型番</dt>
              <dd class="text"><?php the_field('kaitori_detail_model_number'); ?></dd>
              <dt class="title price">価格</dt>
              <dd class="text price"><?php echo number_format(get_field('price')); ?>円</dd>
              <!-- その他の情報　入力なかったら非表示 -->

              <?php if (!empty(get_field('kaitori_detail_size'))) : ?>
                <dt class="title">サイズ</dt>
                <dd class="text"><?php the_field('kaitori_detail_size'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_case'))) :
              ?>
                <dt class="title">ケース径</dt>
                <dd class="text"><?php the_field('kaitori_detail_case'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_movement'))) :
              ?>
                <dt class="title">ムーブメント</dt>
                <dd class="text"><?php the_field('kaitori_detail_movement'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_waterproof'))) :
              ?>
                <dt class="title">防水性能</dt>
                <dd class="text"><?php the_field('kaitori_detail_waterproof'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_specification'))) :
              ?>
                <dt class="title">仕様</dt>
                <dd class="text"><?php the_field('kaitori_detail_specification'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_material'))) :
              ?>
                <dt class="title">ケース素材</dt>
                <dd class="text"><?php the_field('kaitori_detail_material'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_bezelmaterial'))) :
              ?>
                <dt class="title">ベゼル素材</dt>
                <dd class="text"><?php the_field('kaitori_detail_bezelmaterial'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_bezeltype'))) :
              ?>
                <dt class="title">ベルトタイプ</dt>
                <dd class="text"><?php the_field('kaitori_detail_bezeltype'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_dialcolor'))) :
              ?>
                <dt class="title">文字盤カラー</dt>
                <dd class="text"><?php the_field('kaitori_detail_dialcolor'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_dialtype'))) :
              ?>
                <dt class="title">文字盤タイプ</dt>
                <dd class="text"><?php the_field('kaitori_detail_dialtype'); ?></dd>
              <?php
              endif;
              if (!empty(get_field('kaitori_detail_detailtext'))) :
              ?>
                <dt class="title">詳細説明</dt>
                <dd class="text"><?php the_field('kaitori_detail_detailtext'); ?></dd>
              <?php endif; ?>
            </dl>
          </div>
        </div>
        <p class="kaitoriDetail__note"> <?php the_field('kaitori_pr_tet'); ?> </p>
      </section>

      <!--     ▲▲▲買取実績(詳細)▲▲▲     -->




      <!--     ▼▼▼所属モデルの買取実績▼▼▼     -->
      <?php
      $args = array(
        'post_type' => 'result',
        'posts_per_page' => 16,
        'tax_query' => array(
          array(
            'taxonomy' => 'result_cat',
            'field'    => 'slug',
            'terms'    => $term_child_slug,
          ),
        ),
        'meta_key' => 'display_order_field_key',
        'orderby' => 'meta_value_num',
        'order' => 'ASC', // 降順 or 昇順
        'custom_orderby' => true
      );
      $the_query = new WP_Query($args);
      $cnt_all = $the_query->found_posts;
      if ($cnt_all > 1) :
      ?>

        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              <?php echo $term_parent_name; ?> <?php echo $term_child_name; ?><span>買取実績</span>
            </h2>
          </div>
          <div class="flex">

            <!-- ターム名 end -->
            <?php if ($the_query->have_posts()) : ?>
              <div class="flex__content active">




                <?php if ($cnt_all < 3) {
                ?>
                  <ul class="content__list flex--slide">
                  <?php } else { ?>
                    <ul id="flex-slider1" class="content__list flex--slide">
                    <?php } ?>

                    <?php
                    while ($the_query->have_posts()) : $the_query->the_post();

                      $model_img = get_field('img_path');
                      $size = 'thumbnail';
                    ?>
                      <li class="content__item"><a href="<?php echo get_permalink() ?>" class="img__link">
                          <p class="content__image img"><?php echo wp_get_attachment_image($model_img, $size); ?></p>
                          <div class="content__text">
                            <p class="content--name"><?php
                                                      the_title();
                                                      ?></p>
                            <p class="content--title">買取実績</p>
                            <p class="content--price"><?php echo number_format(get_field('price')); ?><span>円</span></p>
                          </div>
                        </a></li>

                    <?php endwhile; ?>
                    <?php
                    if ($cnt_all < 4) {
                      $no_cnt = 4 - $cnt_all;
                      for ($i = 0; $i < $no_cnt; $i++) {
                    ?>
                        <!-- <li class="content__item">
                        <p class="content__image img"></p>
                        <div class="content__text">
                          <p class="content--name"></p>
                          <p class="content--title"></p>
                          <p class="content--price"></p>
                        </div>
                      </li> -->
                    <?php
                      }
                    }
                    ?>
                    </ul>
                    <!-- pagenation -->
                    <?php if ($cnt_all > 4) : ?>
                      <div class="flex--slide__pagenation">
                        <div class="pagenation--arrows flex-slider1--arrow"></div>
                        <div class="pagenation--dots flex-slider1--dot"></div>
                      </div>
                    <?php endif; ?>

                    <div class="btn__wrap btn__red">
                      <?php echo '<a href="' . "https://www.otakaraya.jp/brand-tokei/result/" . $term_parent_slug . "/" . $term_child_slug . '">' .  "<center>" . strip_tags($term_parent_name . $term_child_name) . "の<br>買取実績一覧はこちら</center>" . '</a>' ?>
                    </div>
              </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
          </div>

          <?php get_template_part('/template-parts/cta/cta01'); ?>
          <?php get_template_part('/template-parts/cta/cta02'); ?>

        </section>
      <?php endif; ?>

      <!--     ▲▲▲所属モデルの買取実績▲▲▲     -->





      <!--     ▼▼▼買取相場推移▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_market_price_transition'); ?>

      <!--     ▲▲▲買取相場推移▲▲▲     -->





      <!-- about -->
      <?php if (get_field('goods_about_headline')) : ?>
        <section>
          <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              <?php the_field('goods_about_headline'); ?>
            </h2>
          </div>

          <div class="horizonlist">
            <a href="#" class="horizonlist--link">
              <div class="horizonlist--img"><img src="<?php the_field('goods_about_img'); ?>" alt=""></div>
              <div class="horizonlist--text">
                <?php the_field('goods_about_text'); ?>
              </div>
            </a>
          </div>

        </section>
      <?php endif; ?>




      <!--     ▼▼▼買取対象モデル▼▼▼     -->

      <?php get_template_part('/template-parts/common/purchase_target_model'); ?>

      <!--     ▲▲▲買取対象モデル▲▲▲     -->




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
