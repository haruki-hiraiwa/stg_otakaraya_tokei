<script>
  $(window).on('load', function() {
    const moreNum10 = 10;
    $('.js__more--item10:nth-child(n + ' + (moreNum10 + 1) + ')').addClass('is-hidden').hide();
    $('.js__more--10th').each(function() {
      $('.js__more--btn10').on('click', function() {
        $(this).prev('.js__more--10th').children('.js__more--item10.is-hidden').slice(0, moreNum10).removeClass('is-hidden').show();
        if ($(this).prev().children(".is-hidden").length == 0) {
          $(this).fadeOut();
        }
      });
    });
  });
</script>

<style>
  .latest_results_item {
    display: flex;
    gap: 0px 10px;
  }

  .latest_results_area {
    display: flex;
    border-bottom: 1px solid #000;
    padding: 10px;
  }

  .latest_results_area a {
    text-decoration: revert;
  }

  .latest_results_area_text_ttl {
    width: 100px;
    font-weight: bold;
  }

  .latest_results_list {
    background-color: #f2f2f2;
    padding: 30px 10px;
    border-radius: 24px;
  }

  .latest_results_item:not(:first-child) {
    margin-top: 50px;
  }

  .latest_results_content_wrap {
    margin-top: 4rem;
  }

  .latest_results_text_area_wrap {
    width: 100%;
  }

  .latest_results_section table {
    width: 100%;
  }


  @media (max-width: 1024px) {
    .latest_results_item {
      flex-direction: column;
    }

    .latest_results_image.img {
      text-align: center;
    }

    .latest_results_content_wrap {
      margin-top: 2rem;
    }
  }

  .latest_results_section .js__more--btn10 {
    display: none;
  }
</style>

<section class="latest_results_section">
  <div class="titleMain titleMain--wrapper">
    <h2 class="titleMain--main">
      最新のブランド時計買取実績
    </h2>
  </div>

  <div class="latest_results_content_wrap">
    <div class="atest_results_content">
      <div class="latest_results_list flex--slide js__more--10th">


        <?php
        $args = array(
          'posts_per_page' => -1,
          'post_type'      => 'latest_results',
          // 'meta_key' => 'display_order_field_key',
          'orderby' => 'ASC',
          // 'order' => 'ASC',
          // 'custom_orderby' => true,
          // 'suppress_filters' => false,
          // 'tax_query'      => array(
          //   array(
          //     'taxonomy' => 'result_cat', 
          //     'field'    => 'slug', 
          //     'terms'    => "patekphilippe", 
          //   )
          // ),
        );

        $myposts = get_posts($args);
        foreach ($myposts as $post) {
          $latest_results_img = get_field('latest_results_img');
          $latest_results_name = get_field('latest_results_name');
          $latest_results_time = get_field('latest_results_time');
          $latest_results_shop = get_field('latest_results_shop');
          $latest_results_shop_url = get_field('latest_results_shop_url');
          $latest_results_remarks = get_field('latest_results_remarks');
        ?>
          <div class="latest_results_item js__more--item10">

            <div class="latest_results_image img">
              <img width="150" height="150" src="<?php echo $latest_results_img; ?>" alt="<?php echo get_the_title(); ?>">
            </div>
            <div class="latest_results_text_area_wrap">
              <div class="latest_results_area">
                <div class="latest_results_area_text_ttl">商品名</div>
                <div class="latest_results_area_text"><?php echo $latest_results_name; ?></div>
              </div>
              <div class="latest_results_area">
                <div class="latest_results_area_text_ttl">買取日時</div>
                <div class="latest_results_area_text"><?php echo $latest_results_time; ?></div>
              </div>
              <div class="latest_results_area">
                <div class="latest_results_area_text_ttl">買取店舗</div>
                <a href="<?php echo $latest_results_shop_url; ?>" target="_blank" rel="noopener noreferrer">
                  <div class="latest_results_area_text"><?php echo $latest_results_shop; ?></div>
                </a>
              </div>
              <div class="latest_results_area">
                <div class="latest_results_area_text_remarks"><?php echo $latest_results_remarks; ?></div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="btn__wrap btn__more js__more--btn10">
        <span>もっと実績を見る</span>
      </div>
    </div>

    <style>
      .condition_table_area table,
      .condition_table_area td,
      .condition_table_area th {
        border-collapse: collapse;
        border: 1px solid #fff;
      }

      .condition_table_area td {
        padding: 5px 15px;
      }
    </style>

    <div class="condition_table_area">
      <h3 style="text-align: center;margin: 10px 0;">腕時計のコンディションについて</h3>
      <table style="border-collapse: collapse; overflow: hidden;background: #f2f2f2; border-radius: 24px;">
        <tr style="background-color: #5080be; color: white;">
          <td>状態</td>
          <td>概要</td>
        </tr>
        <tr>
          <td>非常に良い（未使用）</td>
          <td>未開封、一度も使用していない商品</td>
        </tr>
        <tr>
          <td>未使用に近い</td>
          <td>数回しか使っていない、傷がない</td>
        </tr>
        <tr>
          <td>目立った傷や汚れなし</td>
          <td>よく見ないと分からないレベルの傷</td>
        </tr>
        <tr>
          <td>傷や汚れあり</td>
          <td>パッと見だときに傷や汚れが分かる、一部の部品がないなど</td>
        </tr>
        <tr>
          <td>故障</td>
          <td>原因は不明だが時計が駆動していない</td>
        </tr>
        <tr>
          <td>電池切れ</td>
          <td>電池が切れている</td>
        </tr>
      </table>
    </div>

</section>