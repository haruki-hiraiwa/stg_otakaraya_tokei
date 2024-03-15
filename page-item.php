<?php
/* Template Name: 買取可能な商品ページテンプレート */

get_template_part('head');

?>

<body id="app_item">

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
      <li class="topic__path--item"><span>買取可能な商品</span></li>
    </ol>
  </div>


  <main class="contents">
    <article class="contents__left">
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('item_purchase_goods_headline'); ?>
          </h2>
          <div class="titleMain--lead">
            <p><?php echo get_field('item_purchase_goods_lead_text'); ?></p>
          </div>
        </div>
        <div class="colBox colBox__col03 sp__col03">
          <?php
          if (have_rows('item_purchase_goods_repeat')) :
            while (have_rows('item_purchase_goods_repeat')) : the_row();
          ?>
              <div class="col">
                <a href="<?php the_sub_field('item_purchase_goods_repeat_url'); ?>" class="img__link">
                  <div class="img">
                    <p class="is-pc"><img src="<?php the_sub_field('item_purchase_goods_repeat_img'); ?>" alt=""></p>
                    <p class="is-sp"><img src="<?php the_sub_field('item_purchase_goods_repeat_img'); ?>" alt=""></p>
                  </div>
                  <h3 class="titleH4 title--center"><?php the_sub_field('item_purchase_goods_repeat_name'); ?></h3>
                </a>
              </div>
          <?php
            endwhile;
          endif;
          ?>
        </div>
      </section>

      <section>
        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>
      </section>



      <!--       <section>
        <div class="titleMain titleMain--wrapper">
            <h2 class="titleMain--main">
              おたからや<span>新店情報</span>
            </h2>
            <div class="titleMain--lead">
              <p>新規店舗続々オープン！</p>
            </div>
        </div>
        <div class="news__wrap newsList">
            <a href="#" class="newsList__item news-item">
                <div class="news-item__meta">
                    <time class="news-item__time" datetime="2023-01-01">2023.01.01</time>
                    <span class="news-item__category">新店舗オープン</span>
                </div>
                <p class="news-item__title">◯◯◯◯◯◯◯◯店 1月1日オープン!</p>
            </a>
            <a href="#" class="newsList__item news-item">
                <div class="news-item__meta">
                    <time class="news-item__time" datetime="2023-01-01">2023.01.01</time>
                    <span class="news-item__category">新店舗オープン</span>
                </div>
                <p class="news-item__title">◯◯◯◯◯◯◯◯店 1月1日オープン!</p>
            </a>
            <a href="#" class="newsList__item news-item">
                <div class="news-item__meta">
                    <time class="news-item__time" datetime="2023-01-01">2023.01.01</time>
                    <span class="news-item__category">新店舗オープン</span>
                </div>
                <p class="news-item__title">◯◯◯◯◯◯◯◯店 1月1日オープン!</p>
            </a>
            <a href="#" class="newsList__item news-item">
                <div class="news-item__meta">
                    <time class="news-item__time" datetime="2023-01-01">2023.01.01</time>
                    <span class="news-item__category">新店舗オープン</span>
                </div>
                <p class="news-item__title">◯◯◯◯◯◯◯◯店 1月1日オープン!</p>
            </a>
            <a href="#" class="newsList__item news-item">
                <div class="news-item__meta">
                    <time class="news-item__time" datetime="2023-01-01">2023.01.01</time>
                    <span class="news-item__category">新店舗オープン</span>
                </div>
                <p class="news-item__title">◯◯◯◯◯◯◯◯店 1月1日オープン!</p>
            </a>
        </div>
        <div class="btn__wrap btn__red">
            <a href="#">ニュース一覧はこちら</a>
        </div>
      </section>
 -->
    </article>







    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->


  </main>



  <?php
  get_footer();
