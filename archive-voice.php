<?php
/* Template Name: よくある質問ページテンプレート */

get_template_part('head');

?>

<body id="brand-tokei">

  <?php
  get_header();
  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の買取</span></a>
      </li>
      <li class="topic__path--item"><span>お客様の声</span></li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('customer_reviews_repeat_headline', 19608); ?>
          </h2>
          <?php
          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
          $args = array(
            'posts_per_page' => 10, // 表示する投稿数
            'post_type' => array('voice'), // 取得する投稿タイプのスラッグ
            'paged' => $paged, // 現在のページ
            'orderby' => 'date', //日付で並び替え
            'order' => 'DESC' // 降順 or 昇順
          );

          $the_query = new WP_Query($args);
          $cnt_all = $the_query->found_posts;
          $page_all = $the_query->max_num_pages;

          $per_page = get_query_var('posts_per_page');
          $count = $the_query->post_count;
          $from  = 0;
          if (0 < $per_page) {
            if (1 < $paged) {
              $from  = ($paged - 1) * $per_page;
            }
          }

          $first_number = $from + 1;
          $last_number = $from + $count;

          ?>
          <div class="titleMain--lead">
            <p>全<?php echo $cnt_all ?> 件中 <?php echo $first_number; ?>〜<?php echo $last_number; ?>件目を表示</p>
          </div>

          <?php if ($the_query->have_posts()) : ?>

            <div class="voicelist">

              <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <?php
                $rating_tmp = get_field('customer_reviews_repeat_rating');
                if ($rating_tmp == '★') {
                  $rating = '<span>★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
                } elseif ($rating_tmp == '★★') {
                  $rating = '<span>★</span><span>★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
                } elseif ($rating_tmp == '★★★') {
                  $rating = '<span>★</span><span>★</span><span>★</span><span class="star--white">★</span><span class="star--white">★</span>';
                } elseif ($rating_tmp == '★★★★') {
                  $rating = '<span>★</span><span>★</span><span>★</span><span>★</span><span class="star--white">★</span>';
                } elseif ($rating_tmp == '★★★★★') {
                  $rating = '<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>';
                } else {
                  $rating = '<span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span><span class="star--white">★</span>';
                }


                $uname_tmp = get_field('customer_reviews_repeat_name');
                if (!empty($uname_tmp)) {
                  $uname = $uname_tmp . '様';
                } else {
                  $uname = '';
                }

                $sex = get_field('customer_reviews_repeat_sex');
                if ($sex == '不明') {
                  $sex = '';
                }

                $kind_name = 'ブランド時計';
                $voice_data = str_replace('[kind-name]', $kind_name, get_the_content());

                ?>
                <div class="voicelist__article">
                  <div class="voicelist__header">
                    <p class="voicelist__header--name"><?php the_field('customer_reviews_repeat_pref') ?>　<?php the_field('customer_reviews_repeat_city') ?>　<?php echo $uname; ?>　<?php echo $sex; ?></p>
                    <p class="voicelist__header--title"><?php the_title(); ?></p>
                    <div>
                      <p class="voicelist__header--star"><?php echo $rating; ?></p>
                      <p class="voicelist__header--date"><?php the_field('customer_reviews_repeat_date'); ?></p>
                    </div>
                  </div>
                  <div class="voicelist--text">
                    <p><?php echo nl2br($voice_data); ?></p>
                  </div>
                </div>
              <?php endwhile; ?>


              <!-- pagenation -->
              <?php if (function_exists("pagination")) {
                pagination($page_all);
              } ?>
              <!--▲cpagination▲-->

            </div>

          <?php endif; ?>

          <script>
            template_cta02();
          </script>
      </section>

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
