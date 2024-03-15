<?php
if (is_category()) {
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
} else {
  $post_id = get_the_ID();
}

$rp_cnt =  count(get_field('purchase_achieve_model_repeat', $post_id));
// echo "rp_cnt = ".$rp_cnt;
// $aaa = get_field('purchase_achieve_model_repeat', $post_id);
// echo "<pre>";
// var_dump($aaa);
// echo "</pre>";
// rp_cnt = 1
// array(1) {
//   [0]=>
//   array(2) {
//     ["purchase_achieve_model_repeat_category"]=>
//     bool(false)
//     ["purchase_achieve_model_repeat_name"]=>
//     string(0) ""
//   }
// }
if ($rp_cnt == 1) {
  $rp_data = get_field('purchase_achieve_model_repeat', $post_id);
  if (empty($rp_data[0]['purchase_achieve_model_repeat_category']) && empty($rp_data[0]['purchase_achieve_model_repeat_name'])) {
    $rp_cnt = 0;
  }
}


if ($rp_cnt > 0) :
?>
  <section>
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php the_field('purchase_achieve_model_headline', $post_id); ?>
      </h2>
      <div class="titleMain--lead">
        <p>
          <?php
          //the_field('purchase_achieve_model_lead_text', $post_id); 
          echo "買取価格に関しては時期や相場により<br class=is-sp>変動致しますので、お問合せ下さい。"
          ?>
        </p>
      </div>
    </div>

    <div class="flex flex--hasItem<?php echo $rp_cnt; ?>">
      <!-- タブメニュー -->
      <?php
      if ($rp_cnt > 1) :
      ?>
        <ul class="flex__tab">
          <!-- タブ部分 -->
          <?php
          if (have_rows('purchase_achieve_model_repeat', $post_id)) :
            $cnt = 1;
            while (have_rows('purchase_achieve_model_repeat', $post_id)) : the_row();
          ?>
              <li class="tab__item <?php if ($cnt == 1) echo 'active'; ?>"><a><?php the_sub_field('purchase_achieve_model_repeat_name', $post_id); ?></a><?php echo $_SESSION['windowsize']; ?></li>
          <?php
              $cnt++;
            endwhile;
          endif;
          ?>
        </ul>
      <?php
      endif;
      ?>




      <!-- スライダー部分 -->
      <div class="flex__tabContents no_slider">

        <?php
        if (have_rows('purchase_achieve_model_repeat', $post_id)) :
          $cat_cnt = 1;
          while (have_rows('purchase_achieve_model_repeat', $post_id)) : the_row();
            $term = get_sub_field('purchase_achieve_model_repeat_category');
        ?>
            <div class="flex__content <?php if ($cat_cnt == 1) echo 'active'; ?>">
              <div id="flex-slider" <?php
                                    //  echo $cat_cnt;
                                    ?> class="content__list flex--slide">
                <?php purchase_achieve_brand_model_list(16, $term->slug, 'model'); ?>
              </div>
              <!-- pagenation -->
              <!-- <?php purchase_achieve_brand_model_list_bar(16, $term->slug, $cat_cnt); ?> -->
              <?php $cat_cnt++; ?>


              <?php
              //echo "flex_model";
              //タイトルから商品名を取得
              $site_title = wp_title('', false);
              //買取から後を削除、のから後を削除
              $parts = explode("買取", $site_title);
              $before_first_pipe = $parts[0];
              $parts2 = explode("の", $before_first_pipe);
              $tokei_name = $parts2[0];

              //特定の文字列を削除
              $stringsToRemove = array("おたからやで", " ");
              // 文字列から指定した文字列を除外
              $outputString = str_replace($stringsToRemove, '', $tokei_name);

              //文字の数を取得
              $StringLength = strlen($outputString);


              //文字の数が多ければ改行
              //echo $StringLength . "<br>";
              if ($StringLength >= 40) {
                $buttonText = $outputString . "<br>買取実績一覧はこちら";
              } else if ($StringLength >= 20) {
                $buttonText = $outputString . "<br class=is-sp>買取実績一覧はこちら";
              } else {
                $buttonText = $outputString . "買取実績一覧はこちら";
              }


              //アドレスを取得
              $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $position = strpos($current_url, "brand-tokei/"); //文字列の番号

              if ($position !== false) {
                ///以降の文字列を削除 
                $result = substr($current_url, $position + strlen("brand-tokei/"));
                $position = strpos($result, "/");
                $result2 = substr($result, 0, $position);
                $result_url = "https://www.otakaraya.jp/brand-tokei/result/" . $result;
              }


              $output = '<a href="' . $result_url . '">' .  "<center>" . $buttonText . "</center>" . '</a> ';

              ?>
              <div class="btn__wrap btn__red">
                <?php echo $output; ?>
              </div>

            </div>
        <?php
            $cnt++;
          endwhile;
        endif;
        ?>
      </div>
    </div>



  </section>
<?php endif; ?>
<style>
  .no_slider .content__list {
    flex-wrap: wrap;
  }

  .no_slider .content__item {
    list-style: none;
  }

  @media (max-width: 767px) {
    .no_slider .content__item {
      width: 44%;
      max-width: 350px;
      margin-bottom: 15px;
    }
  }
</style>