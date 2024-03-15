<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

?>

<body id="result">

  <?php
  get_header();

  /***** カテゴリ情報取得 *****/
  // $cat_id = get_queried_object()->cat_ID;
  // $post_id = 'result_cat_'.$cat_id;
  // $catimg = get_field('catimg',$post_id);
  ?>



  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の高価買取</span></a>
      </li>
      <li class="topic__path--item"><span>ブランド別買取実績一覧</span></li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">

      <!--     ▼▼▼よく検索されるブランド▼▼▼     -->
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('popular_brand_headline', 25329); ?>
          </h2>
          <div class="titleMain--lead">
            <?php echo get_field('popular_brand_lead_text', 25329); ?>
          </div>
        </div>

        <div class="colBox colBox__col04 sp__col03">

          <?php
          if (have_rows('popular_brand_repeat', 25329)) :
            while (have_rows('popular_brand_repeat', 25329)) : the_row();
              if (get_sub_field('popular_brand_cate')) :
                $term = get_sub_field('popular_brand_cate');
                $term_name = str_replace('買取', '', $term->name);
                $term_name = str_replace('高価', '', $term->name);

          ?>

                <?php
                $mode = "";
                if ($_GET["mode"]) {
                  $mode = $_GET["mode"];
                }

                // 削除したい文字列の配列
                $strings_to_remove = array(" ", "・");
                $output_string = str_replace($strings_to_remove, '', $term->name);

                ?>
                <?php if (!$mode == "test") { ?>
                  <div class="col">
                    <a href="/brand-tokei/result/<?php echo $term->slug; ?>" class="img__link">
                      <div class="img">
                        <p class="is-pc"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $output_string; ?>></p>
                        <p class="is-sp"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $output_string; ?>></p>
                      </div>
                      <p class="text text--center"><?php the_sub_field('popular_brand_cate_text'); ?></p>
                    </a>
                  </div>
                <?php } else { ?> <div class="col">
                    <a href="<?php echo esc_url(home_url('/' . $term->slug)); ?>" class="img__link">
                      <div class="img">
                        <p class="is-pc"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $output_string; ?>></p>
                        <p class="is-sp"><img src="<?php the_sub_field('popular_brand_img'); ?>" alt=<?php echo $output_string; ?>></p>
                      </div>
                      <p class="text text--center"><?php the_sub_field('popular_brand_cate_text'); ?></p>
                    </a>
                  </div>
                <?php }  ?>

          <?php
              endif;
            endwhile;
          endif;
          ?>

        </div>
      </section>
      <!--     ▲▲▲よく検索されるブランド▲▲▲     -->


      <!--     ▼▼▼ブランド名から探す▼▼▼     -->

      <?php
      $jp_agyo = "アイウエオヴ";
      $jp_kagyo = "カキクケコガギグゲゴ";
      $jp_sagyo = "サシスセソザジズゼゾジャジュジョ";
      $jp_tagyo = "タチツテトダヂヅデド";
      $jp_nagyo = "ナニヌネノ";
      $jp_hagyo = "ハヒフヘホバビブベボパピプペポビャビュビョピャピュピョ";
      $jp_magyo = "マミムメモ";
      $jp_yagyo = "ヤユヨ";
      $jp_ragyo = "ラリルレロ";
      $jp_wagyo = "ワヲン";
      $mojilist = array($jp_agyo, $jp_kagyo, $jp_sagyo, $jp_tagyo, $jp_nagyo, $jp_hagyo, $jp_magyo, $jp_yagyo, $jp_ragyo, $jp_wagyo);
      $mojilabel = array("ア行", "カ行", "サ行", "タ行", "ナ行", "ハ行", "マ行", "ヤ行", "ラ行", "ワ行");
      $mojilabel2 = array("ア", "カ", "サ", "タ", "ナ", "ハ", "マ", "ヤ", "ラ", "ワ");
      $mojianchor = array("a", "ka", "sa", "ta", "na", "ha", "ma", "ya", "ra", "wa");
      $initials = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

      $args = array(
        'taxonomy' => array('result_cat'),
        'hide_empty' => true,
        'orderby' => 'meta_value', //meta_valueの値で並べる
        'order' => 'ASC', //昇順で順序付け
        'meta_query' => array(
          array(
            'key' => 'brand_rubi',
          )
        ),
      );

      $term_query = new WP_Term_Query($args);

      ?>

      <section>
        <div class="SearchBrandKana">
          <h3 class="titleSub text--center">時計ブランド名から探す</h3>
          <ul>
            <?php
            $i = 0;
            foreach ($term_query->get_terms() as $term) :
              $brand_rubi = get_field('brand_rubi', 'result_cat_' . $term->term_id);

              if (!empty($brand_rubi)) :

                $first_word = mb_substr($brand_rubi, 0, 1);

                foreach ($mojilist as $index => $value) :
                  $pos = strpos($value, $first_word);
                  if ($pos !== false) :
                    $initials[$index] = 1;
                  endif;
                endforeach;
              endif;

            endforeach;

            foreach ($initials as $idx => $val) :
              if ($val == 1) :
            ?>
                <li><a class="scroll" href="#brand-<?php echo $mojianchor[$idx] ?>"><?php echo $mojilabel2[$idx] ?></a></li>
              <?php
              else :
              ?>
                <li>
                  <p><?php echo $mojilabel2[$idx] ?></p>
                </li>
            <?php
              endif;
            endforeach;
            ?>
          </ul>
        </div>
      </section>

      <section>

        <?php
        $i = 0;

        $args = array(
          'taxonomy' => array('result_cat'),
          // 'hide_empty' => true,
          'hide_empty' => false,
          'orderby' => 'meta_value', //meta_valueの値で並べる
          'order' => 'ASC', //昇順で順序付け
          'meta_query' => array(
            array(
              'key' => 'brand_rubi',
            )
          ),
        );

        $term_query = new WP_Term_Query($args);

        foreach ($term_query->get_terms() as $term) :

          $brand_rubi = get_field('brand_rubi', 'result_cat_' . $term->term_id);

          if (!empty($brand_rubi)) :

            $first_word = $brand_rubi;
            $first_word = mb_substr($first_word, 0, 1);

            foreach ($mojilist as $index => $value) :
              $pos = strpos($value, $first_word);
              if ($pos !== false) :
                if ($num != $index) {
                  $i = 0;
                  $num = $index;
        ?>
                  </ul>
                  </div>
                  </div>
                <?php
                }


                if ($i == 0) {
                ?>

                  <div id="brand-<?php echo $mojianchor[$index]; ?>">
                    <div class="titleMain titleMain--wrapper">
                      <h2 class="titleMain--main">
                        おたからや買取ブランド名<br class="is-sp"><span>（<?php echo $mojilabel[$index]; ?>） </span>
                      </h2>
                    </div>
                    <div class="SearchBrandName">
                      <ul class="SearchBrandName__list">
                        <li class="SearchBrandName__list--item btn__wh01--wrap">
                          <?php
                          $mode = "";
                          if ($_GET["mode"]) {
                            $mode = $_GET["mode"];
                          }
                          ?>
                          <?php if (!$mode == "test") { ?>
                            <a href="/brand-tokei/result/<?php echo $term->slug; ?>"><?php echo $term->name; ?><span><?php echo $term->slug; ?></span></a>
                          <?php } else { ?>
                            <a href="<?php echo get_term_link($term->slug, 'result_cat'); ?>"><?php echo $term->name; ?><span><?php echo $term->slug; ?></span></a>
                          <?php }  ?>
                        </li>
                      <?php
                      $i++;
                    } else {
                      ?>
                        <li class="SearchBrandName__list--item btn__wh01--wrap">
                          <?php
                          $mode = "";
                          if ($_GET["mode"]) {
                            $mode = $_GET["mode"];
                          }
                          ?>
                          <?php if (!$mode == "test") { ?>
                            <a href="/brand-tokei/result/<?php echo $term->slug; ?>"><?php echo $term->name; ?><span><?php echo $term->slug; ?></span></a>
                          <?php } else { ?>
                            <a href="<?php echo get_term_link($term->slug, 'result_cat'); ?>"><?php echo $term->name; ?><span><?php echo $term->slug; ?></span></a>
                          <?php }  ?>
                        </li>
              <?php
                      $i++;
                    }
                  endif;
                endforeach;
              endif;

            endforeach;
              ?>
                      </ul>
                    </div>
                  </div>

      </section>

      <?php get_template_part('/template-parts/cta/cta01'); ?>
      <?php get_template_part('/template-parts/cta/cta03'); ?>


      <!--     ▲▲▲ブランド名から探す▲▲▲     -->





      <!--     ▼▼▼おたからやの買取商品から探す▼▼▼     -->
      <section></section>
      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            <?php echo get_field('otakaraya_purchase_goods_headline', 19091); ?>
          </h2>
        </div>
        <div class="colBox colBox__col04 sp__col03">
          <?php
          if (have_rows('otakaraya_purchase_goods_repeat', 19091)) :
            while (have_rows('otakaraya_purchase_goods_repeat', 19091)) : the_row();

          ?>
              <div class="col">
                <a href="<?php the_sub_field('otakaraya_purchase_goods_repeat_url'); ?>" class="img__link">
                  <div class="img">
                    <p class="is-pc"><img src="<?php the_sub_field('otakaraya_purchase_goods_repeat_img'); ?>" alt=<?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?>></p>
                    <p class="is-sp"><img src="<?php the_sub_field('otakaraya_purchase_goods_repeat_img'); ?>" alt=<?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?>></p>
                  </div>
                  <p class="text text--center"><?php the_sub_field('otakaraya_purchase_goods_repeat_name'); ?></p>
                </a>
              </div>
          <?php
            endwhile;
          endif;
          ?>

        </div>
      </section>

      <!--     ▲▲▲おたからやの買取商品から探す▲▲▲     -->






    </article>


    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->





  </main>




  <?php
  get_footer();
