<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

?>

<body id="shop" class="shop_index">

  <?php
  get_header();

  /***** カテゴリ情報取得 *****/
  // $cat_id = get_queried_object()->cat_ID;
  // $post_id = 'category_'.$cat_id;
  // $catimg = get_field('catimg',$post_id);

  ?>




  <div id="topic__path" class="topic__path">
    <ol class="topic__path--list">
      <li class="topic__path--item">
        <a href="https://www.otakaraya.jp/"><span>買取専門店・おたからやTOP</span></a>
      </li>
      <li class="topic__path--item">
        <a href="/brand-tokei/"><span>ブランド時計の買取</span></a>
      </li>
      <li class="topic__path--item"><span>おたからや直営店一覧</span></li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">

      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            時計買取おたからや<span>直営店一覧</span>
          </h2>
          <div class="titleMain--lead">
            <p>県名クリックで店舗リストへ移動します</p>
          </div>
        </div>
        <div class="map">
          <p class="is-pc"><img src="<?php echo THEME_URL; ?>assets/img/parts/map/map.png" alt=""></p>
          <ul class="map__area">
            <li class="map__area--hokkaido">
              <p>北海道</p>
              <ul>
                <li><a class="scroll" href="#hokkaido">北海道</a></li>
              </ul>
            </li>
            <li class="map__area--tohoku">
              <p>東北</p>
              <ul>
                <li><a class="scroll" href="#aomori">青森県</a></li>
                <li><a class="scroll" href="#iwate">岩手県</a></li>
                <li><a class="scroll" href="#miyagi">宮城県</a></li>
                <li><a class="scroll" href="#akita">秋田県</a></li>
                <li><a class="scroll" href="#yamagata">山形県</a></li>
                <li><a class="scroll" href="#hukushima">福島県</a></li>
              </ul>
            </li>
            <li class="map__area--kanto">
              <p>関東</p>
              <ul>
                <li><a class="scroll" href="#ibaraki">茨城県</a></li>
                <li><a class="scroll" href="#tochigi">栃木県</a></li>
                <li><a class="scroll" href="#gumma">群馬県</a></li>
                <li><a class="scroll" href="#saitama">埼玉県</a></li>
                <li><a class="scroll" href="#chiba">千葉県</a></li>
                <li><a class="scroll" href="#tokyo">東京都</a></li>
                <li><a class="scroll" href="#kanagawa">神奈川県</a></li>
              </ul>
            </li>
          </ul>
          <ul class="map__area">
            <li class="map__area--chubu">
              <p>中部</p>
              <div>
                <ul>
                  <li><a class="scroll" href="#niigata">新潟県</a></li>
                  <li><a class="scroll" href="#toyama">富山県</a></li>
                  <li><a class="scroll" href="#ishikawa">石川県</a></li>
                  <li><a class="scroll" href="#fukui">福井県</a></li>
                  <li><a class="scroll" href="#yamanashi">山梨県</a></li>
                </ul>
                <ul>
                  <li><a class="scroll" href="#nagano">長野県</a></li>
                  <li><a class="scroll" href="#gifu">岐阜県</a></li>
                  <li><a class="scroll" href="#shizuoka">静岡県</a></li>
                  <li><a class="scroll" href="#aichi">愛知県</a></li>
                </ul>
              </div>
            </li>
            <li class="map__area--kinki">
              <p>近畿</p>
              <ul>
                <li><a class="scroll" href="#mide">三重県</a></li>
                <li><a class="scroll" href="#shiga">滋賀県</a></li>
                <li><a class="scroll" href="#kyoto">京都府</a></li>
                <li><a class="scroll" href="#osaka">大阪府</a></li>
                <li><a class="scroll" href="#hyogo">兵庫県</a></li>
                <li><a class="scroll" href="#nara">奈良県</a></li>
                <li><a class="scroll" href="#wakayama">和歌山県</a></li>
              </ul>
            </li>
          </ul>
          <ul class="map__area">
            <li class="map__area--chugoku">
              <p>中国</p>
              <ul>
                <li><a class="scroll" href="#tottori">鳥取県</a></li>
                <li><a class="scroll" href="#shimane">島根県</a></li>
                <li><a class="scroll" href="#okayama">岡山県</a></li>
                <li><a class="scroll" href="#hiroshima">広島県</a></li>
                <li><a class="scroll" href="#yamaguchi">山口県</a></li>
              </ul>
            </li>
            <li class="map__area--shikoku">
              <p>四国</p>
              <ul>
                <li><a class="scroll" href="#tokushima">徳島県</a></li>
                <li><a class="scroll" href="#kagawa">香川県</a></li>
                <li><a class="scroll" href="#ehime">愛媛県</a></li>
                <li><a class="scroll" href="#kochi">高知県</a></li>
              </ul>
            </li>
            <li class="map__area--kyushu">
              <p>九州</p>
              <ul>
                <li><a class="scroll" href="#fukuoka">福岡県</a></li>
                <li><a class="scroll" href="#saga">佐賀県</a></li>
                <li><a class="scroll" href="#nagasaki">長崎県</a></li>
                <li><a class="scroll" href="#kumamoto">熊本県</a></li>
                <li><a class="scroll" href="#oita">大分県</a></li>
                <li><a class="scroll" href="#miyazaki">宮崎県</a></li>
                <li><a class="scroll" href="#kagoshima">鹿児島県</a></li>
              </ul>
            </li>
            <li class="map__area--okinawa">
              <p>沖縄</p>
              <ul>
                <li><a class="scroll" href="#okinawa">沖縄県</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </section>


      <section>
        <div class="shopSearch">
          <h3 class="titleSub">都道府県名で絞り込む</h3>
          <form class="shopSearch__form" method="get" action="<?php echo home_url('/'); ?>shop/">
            <div class="shopSearch__select--pref visble">
              <select class="area_parent" id="shopSearch__select--pref" name="shop_pref">
                <option value="">都道府県を選択</option>
                <?php
                $pref_terms = get_terms('area', ['parent' => 0, 'orderby' => 'id']);
                $get_pref = $_GET['shop_pref'] ?? null;
                if ($get_pref == 'all' || $get_pref == '') {
                  $get_pref = '';
                }

                foreach ($pref_terms as $pref_term) :
                  echo '<option value="' . $pref_term->slug . '" ';
                  if ($get_pref) :
                    if ($get_pref == $pref_term->slug) :
                      echo 'selected="selected" ';
                    endif;
                  endif;
                  echo '>' . $pref_term->name . '</option>';
                endforeach;
                ?>
              </select>
            </div>

            <div class="shopSearch__select--city">
              <select class="area_child" id="shopSearch__select--city" name="shop_city" disabled>
                <option value="" selected="selected">市区町村を選択</option>
                <?php
                $get_city = $_GET['shop_city'] ?? null;
                foreach ($pref_terms as $pref_term) :
                  $child_terms = get_term_children($pref_term->term_id, 'area');
                  foreach ($child_terms as $child_term) :
                    $city_term = get_term_by('id', $child_term, 'area');
                    echo '<option value="' . $city_term->slug . '" ';
                    if ($get_city) :
                      if ($get_city == $city_term->slug) :
                        echo 'selected="selected" ';
                      endif;
                    endif;
                    echo ' data-val="' . $pref_term->slug . '">' . $city_term->name . '</option>';
                  endforeach;
                endforeach; ?>

              </select>
            </div>
            <div class="shopSearch__submit"><a id="serch_btn" class="scroll" href="#01">検索</a></div>
          </form>
        </div>
      </section>


      <?php
      $mode = "";
      if ($_GET["mode"]) {
        $mode = $_GET["mode"];
      }
      ?>
      <?php if (!$mode == "test") { ?>

        <section>
          <div id="search-result">

            <?php
            $post_type = "shop";
            $pref_terms = get_terms('area', ['parent' => 0, 'orderby' => 'id', 'hide_empty' => false]);
            foreach ($pref_terms as $pref_term) :
            ?>

              <div class="shopAcod" id="<?php echo $pref_term->slug; ?>">
                <div class="titleMain titleMain--wrapper">
                  <h2 class="titleMain--main">
                    <?php echo $pref_term->name ?>
                  </h2>
                </div>

                <?php
                $city_terms = get_terms('area', ['parent' => $pref_term->term_id, 'orderby' => 'id']);
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
                    <dl class="shopAcod__city js-acod01" id="<?php echo $city_term->slug ?>">
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

              <div class="area_link">
                <a href="<?php echo "https://www.otakaraya.jp/shop/area/" . $pref_term->slug . "/#shop_data"; ?>"><?php echo $pref_term->name ?>の店舗を見る</a>
              </div>

            <?php
            endforeach;
            ?>

          </div>
        </section>

        <style>
          .area_link>a::after {
            background-image: url(/brand-tokei/wp-content/themes/otakaraya/assets/img/common/icon_arrow_white01.png);
            background-size: contain;
          }

          .area_link {
            padding: 10px;
            background-color: #d82400;
            text-align: center;
            margin: auto;
            width: 200px;
            border-radius: 50px;
            color: #fff;
            font-weight: bold;
            margin-top: 4rem;
          }

          #search-result>div:last-child {
            margin-bottom: 4rem;
          }

          .area_link a {
            display: block;
          }
        </style>

      <?php } else { ?>


        <section>
          <div id="search-result">

            <?php
            $post_type = "shop";
            $pref_terms = get_terms('area', ['parent' => 0, 'orderby' => 'id']);
            foreach ($pref_terms as $pref_term) :
            ?>

              <div class="shopAcod" id="<?php echo $pref_term->slug; ?>">
                <div class="titleMain titleMain--wrapper">
                  <h2 class="titleMain--main">
                    <?php echo $pref_term->name ?>
                  </h2>
                </div>

                <?php
                $city_terms = get_terms('area', ['parent' => $pref_term->term_id, 'orderby' => 'id']);
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
                    'orderby' => 'id',
                    'order' => 'DESC',
                  ));

                  if ($the_query->have_posts()) :
                ?>
                    <dl class="shopAcod__city js-acod01" id="<?php echo $city_term->slug ?>">
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
                                  <a href="/brand-tokei/shop/<?php echo $pref_term->slug; ?>/<?php echo $city_term->slug; ?>/<?php echo $post->post_name ?>/">詳細を見る</a>
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

            <?php
            endforeach;
            ?>

          </div>
        </section>

      <?php } ?>


      <section>
        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>
      </section>




      <!--     ▼▼▼ショップエリア▼▼▼     -->

      <?php get_template_part('/template-parts/shop/shop_area'); ?>

      <!--     ▲▲▲ショップエリア▲▲▲     -->



    </article>


    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->





  </main>

  <script>
    var $children = $('.area_child'); //都道府県の要素を変数に入れます。
    var original = $children.html(); //後のイベントで、不要なoption要素を削除するため、オリジナルをとっておく

    //地方側のselect要素が変更になるとイベントが発生
    $('.area_parent').change(function() {

      //選択された地方のvalueを取得し変数に入れる
      var val1 = $(this).val();

      //削除された要素をもとに戻すため.html(original)を入れておく
      $children.html(original).find('option').each(function() {
        var val2 = $(this).data('val'); //data-valの値を取得

        //valueと異なるdata-valを持つ要素を削除
        if (val1 != val2) {
          $(this).not(':first-child').remove();
        }

      });

      //地方側のselect要素が未選択の場合、都道府県をdisabledにする
      if ($(this).val() == "") {
        $children.attr('disabled', 'disabled');
        $('.shopSearch__select--city').removeClass('visble');
      } else {
        $children.removeAttr('disabled');
        $('.shopSearch__select--city').addClass('visble');
      }

    });

    $('#serch_btn').on("click", function() {

      var speed = 400;
      var href = "#" + $('[name=shop_pref]').val();
      if ($('[name=shop_city]').val()) {
        href = "#" + $('[name=shop_city]').val();
      }
      // console.log(href);
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
      $('body,html').animate({
        scrollTop: position
      }, speed, 'swing');

      var selectCity = $('#shopSearch__select--city');
      var cityId = $(selectCity).children(':selected').val();
      $('#' + cityId).children(".acod__switch").toggleClass("open");
      $('#' + cityId).children(".acod__switch").next('.acod__contents').slideToggle();
      return false;


    });
  </script>



  <?php
  get_footer();
