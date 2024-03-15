<?php
if (is_category()) {
  // echo "cateegory";
  $cat_id = get_queried_object()->cat_ID;
  $post_id = 'category_' . $cat_id;
} else {
  // echo "else";
  //   global $post_id;
  //   global $terms;
  $post_id = get_the_ID();
  // echo "post_id =".$post_id."<BR>";
  // echo "terms =".$terms."<BR>";
  // echo "get_id =".$post_id."<BR>";
}


if (!empty(get_field('pmc_headline', $post_id))) :
?>



  <section>
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php echo get_field('pmc_headline', $post_id); ?>
      </h2>
      <div class="titleMain--lead">
        <p><?php echo get_field('pmc_lead_text', $post_id); ?></p>
      </div>
    </div>


    <div class="kaitoriBox">
      <div class="kaitoriBox__header">
        <h3 class="kaitoriBox__title">
          <?php echo get_field('pmc_title', $post_id); ?>
        </h3>
      </div>
      <div class="kaitoriBox__body">
        <?php

        // カスタムフィールド「kaitori_graph」の値を取得
        $kaitori_graphs1 = get_field('pmc_graph_repeat_01', $post_id);
        // フィールド「buys_date」と「buys_price」の配列
        $buys_dates1 = array();
        $buys_prices1 = array();

        // 「A_field」の各要素を取得
        foreach ((array) $kaitori_graphs1 as $pmc_graph_repeat_01) {

          // サブフィールド「buys_date」と「buys_price」の値を取得
          $pmc_bar_graph_ym_repeat_01 = isset($pmc_graph_repeat_01['pmc_bar_graph_ym_repeat_01']) ? $pmc_graph_repeat_01['pmc_bar_graph_ym_repeat_01'] : '';
          $pmc_bar_graph_val_repeat_01 = isset($pmc_graph_repeat_01['pmc_bar_graph_val_repeat_01']) ? $pmc_graph_repeat_01['pmc_bar_graph_val_repeat_01'] : '';

          // 取得した値を配列に格納
          array_push($buys_dates1, $pmc_bar_graph_ym_repeat_01);
          array_push($buys_prices1, $pmc_bar_graph_val_repeat_01);
        }
        $kaitori_up_price1 = $buys_prices1[2] - $buys_prices1[0];

        // カスタムフィールド「kaitori_graph」の値を取得
        $kaitori_graphs2 = get_field('pmc_graph_repeat_02', $post_id);
        // フィールド「buys_date」と「buys_price」の配列
        $buys_dates2 = array();
        $buys_prices2 = array();

        // 「A_field」の各要素を取得
        foreach ((array) $kaitori_graphs2 as $pmc_graph_repeat_02) {

          // サブフィールド「buys_date」と「buys_price」の値を取得
          $pmc_bar_graph_ym_repeat_02 = isset($pmc_graph_repeat_02['pmc_bar_graph_ym_repeat_02']) ? $pmc_graph_repeat_02['pmc_bar_graph_ym_repeat_02'] : '';
          $pmc_bar_graph_val_repeat_02 = isset($pmc_graph_repeat_02['pmc_bar_graph_val_repeat_02']) ? $pmc_graph_repeat_02['pmc_bar_graph_val_repeat_02'] : '';

          // 取得した値を配列に格納
          array_push($buys_dates2, $pmc_bar_graph_ym_repeat_02);
          array_push($buys_prices2, $pmc_bar_graph_val_repeat_02);
        }
        $kaitori_up_price2 = $buys_prices2[2] - $buys_prices2[0];

        $pmc_repeat_img_01 = get_field('pmc_repeat_img_01', $post_id);
        $pmc_repeat_img_01_thumnail = get_field('img_path', $pmc_repeat_img_01);
        $pmc_repeat_img_01_url = wp_get_attachment_url($pmc_repeat_img_01_thumnail, 'large');
        $pmc_repeat_img_02 = get_field('pmc_repeat_img_02', $post_id);
        $pmc_repeat_img_02_thumnail = get_field('img_path', $pmc_repeat_img_02);
        $pmc_repeat_img_02_url = wp_get_attachment_url($pmc_repeat_img_02_thumnail, 'large');
        ?>
        <div class="kaitoriBox__body">
          <div class="kaitoriBox__example">
            <figure class="example__image">
              <img src="<?php echo $pmc_repeat_img_01_url; ?>" alt="<?php the_field('pmc_repeat_brand_01', $post_id); ?>">
              <figcaption>
                <p class="example__title"><?php the_field('pmc_repeat_brand_01', $post_id); ?></p>
                <p class="example__text"><?php the_field('pmc_repeat_model_01', $post_id); ?></p>
              </figcaption>
            </figure>
            <picture class="example__graph">
              <!--ここからchart-->
              <div>

                <p class="ttl"><span>約</span><?php echo number_format($kaitori_up_price1); ?><span>万円</span>UP!</p>
              </div>
              <div class="barChart">
                <canvas id="myChart1"></canvas>
                <span class="yentext1">万円</span>
              </div>
              <!--ここまでchart-->
            </picture>
          </div>

          <div class="kaitoriBox__example">
            <figure class="example__image">
              <img src="<?php echo $pmc_repeat_img_02_url; ?>" alt="<?php the_field('pmc_repeat_brand_02', $post_id); ?>">
              <figcaption>
                <p class="example__title"><?php the_field('pmc_repeat_brand_02', $post_id); ?></p>
                <p class="example__text"><?php the_field('pmc_repeat_model_02', $post_id); ?></p>
              </figcaption>
            </figure>
            <picture class="example__graph">
              <!--ここからchart-->
              <div>

                <p class="ttl"><span>約</span><?php echo number_format($kaitori_up_price2); ?><span>万円</span>UP!</p>
              </div>
              <div class="barChart">
                <canvas id="myChart2"></canvas>
                <span class="yentext2">万円</span>
              </div>
              <!--ここまでchart-->
            </picture>
          </div>

          <!--Chart.jsで必要なスクリプト-->
          <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
          </script>
          <!--Chart.jsで必要なスクリプトEND-->



          <div class="kaitoriBox__table">
            <h3 class="kaitoriBox__table__title"><?php echo get_field('pmc_sub_title', $post_id); ?></h3>
            <!-- PC用 -->
            <table class="is-pc">
              <thead>
                <tr>
                  <th class="table__head--bold">モデル名</th>
                  <th class=""><?php echo get_field('occ_ym_01', $post_id); ?></th>
                  <th class="table__head--emphasis"><?php echo get_field('occ_ym_02', $post_id); ?></th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (have_rows('occ_info_repeat', $post_id)) :
                  while (have_rows('occ_info_repeat', $post_id)) : the_row(); ?>
                    <?php
                    $num1 = get_sub_field('occ_repeat_price_01');
                    $num1 = str_replace(',', '', $num1);
                    $num1 = intval($num1);
                    $num1 = number_format($num1);
                    $num2 = get_sub_field('occ_repeat_price_02');
                    $num2 = str_replace(',', '', $num2);
                    $num2 = intval($num2);
                    $num2 = number_format($num2);
                    ?>

                    <tr class="table__items">
                      <td class="table__item item--name"><?php the_sub_field('occ_repeat_brand_name'); ?><br><span><?php the_sub_field('occ_repeat_model_name'); ?></span></td>
                      <td class="table__item "><?php echo $num1; ?> 万円</td>
                      <td class="table__item item--emphases"><?php echo $num2; ?> 万円</td>
                    </tr>
                <?php
                  endwhile;
                endif;
                ?>
              </tbody>
            </table>
            <!-- SP用 -->
            <div class="kaitoriBox__list is-sp">
              <?php
              if (have_rows('occ_info_repeat', $post_id)) :
                while (have_rows('occ_info_repeat', $post_id)) : the_row(); ?>
                  <?php
                  $num1 = get_sub_field('occ_repeat_price_01');
                  $num1 = str_replace(',', '', $num1);
                  $num1 = intval($num1);
                  $num1 = number_format($num1);
                  $num2 = get_sub_field('occ_repeat_price_02');
                  $num2 = str_replace(',', '', $num2);
                  $num2 = intval($num2);
                  $num2 = number_format($num2);
                  ?>
                  <dl class="kaitoriBox__item">
                    <dt class="kaitoriBox__item__title">
                      <?php the_sub_field('occ_repeat_brand_name'); ?><br><span><?php the_sub_field('occ_repeat_model_name'); ?></span>
                    </dt>
                    <dd class="kaitoriBox__item__text">
                      <p class="text--month"><?php echo get_field('occ_ym_01', $post_id); ?></p>
                      <p class="text--price"><?php echo $num1; ?> 万円</p>
                    </dd>
                    <dd class="kaitoriBox__item__text">
                      <p class="text--month emphasis"><?php echo get_field('occ_ym_02', $post_id); ?></p>
                      <p class="text--price emphasis"><?php echo $num2; ?> 万円</p>
                    </dd>
                  </dl>
              <?php
                endwhile;
              endif;
              ?>
            </div>
            <div class="kaitoriBox__note">
              <p class="note note--color1"><?php echo get_field('pmc_alert_text', $post_id); ?></p>
              <p class="note note--color2"><?php echo get_field('pmc_pr', $post_id); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--Chart.js生成の記述-->
  <script>
    const ctx = document.getElementById('myChart1').getContext('2d');
    //chartのオプション共通設定
    const chartOptions = {
      responsive: true,
      plugins: {
        tooltip: {
          enabled: false
        },
        legend: {
          display: false
        },

        datalabels: {
          color: 'White',
          font: function(context) {
            const fontSize = context.dataIndex === 2 ? 26 : 18;
            const fontWeight = context.dataIndex === 2 ? 'bold' : 'normal';
            return {
              size: fontSize,
              weight: fontWeight
            };
          },
          formatter: function(value, context) {
            const yentxt = context.dataIndex === 2 ? '' : '万円';
            return value + yentxt;
          },

        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            display: false,
          },
          border: {
            display: false
          },
          title: {
            display: false
          },
          ticks: {
            display: false
          },
          scaleLabel: {
            display: false
          }
        },
        x: {
          border: {
            display: false
          },
          grid: {
            display: false
          },
          ticks: {
            color: (context) => {
              return context.tick.value === 2 ? 'rgb(216, 35, 0)' : 'rgba(0, 0, 0, 0.9)';
            },
            font: (context) => {
              const fontWeight = context.tick.value === 2 ? 'bold' : 'normal';
              return {
                size: 14,
                weight: fontWeight
              };
            },
          }
        }
      }
    };
    //背景のグラデーション描写
    const gradation = {
      id: 'customCanvasBackgroundColor',
      beforeDraw: (chart, args, options) => {
        const {
          ctx
        } = chart;
        const chartArea = chart.chartArea;
        const top = chartArea.top;
        const bottom = chartArea.bottom;
        const height = bottom - top;
        const offset = height / 3;
        const gradient = ctx.createLinearGradient(0, 0, 0, height);
        gradient.addColorStop(0, 'rgba(0, 0, 0, 0)');
        gradient.addColorStop(0.3, 'rgba(0, 0, 0, 0)');
        gradient.addColorStop(0.7, 'rgba(0, 0, 0, 0)');
        gradient.addColorStop(0.8, 'rgba(0, 0, 0, 0)');
        gradient.addColorStop(1, 'rgba(0, 0, 0, 0.15)');
        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = gradient;
        ctx.fillRect(0, bottom - offset, chart.width, offset);
        ctx.restore();
      }
    };
    //chart生成ベース
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($buys_dates1); ?>,
        datasets: [{
          label: '買取実績1',
          data: <?php echo json_encode($buys_prices1); ?>,
          backgroundColor: [
            'rgb(84, 84, 84)',
            'rgb(84, 84, 84)',
            'rgb(216, 35, 0)'
          ],
          borderColor: [
            'rgb(84, 84, 84)',
            'rgb(84, 84, 84)',
            'rgb(216, 35, 0)'
          ],

        }]
      },
      plugins: [ChartDataLabels, gradation],
      options: chartOptions
    });
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    //chart生成ベース
    const myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($buys_dates2); ?>,
        datasets: [{
          label: '買取実績2',
          data: <?php echo json_encode($buys_prices2); ?>,
          backgroundColor: [
            'rgb(84, 84, 84)',
            'rgb(84, 84, 84)',
            'rgb(216, 35, 0)'
          ],
          borderColor: [
            'rgb(84, 84, 84)',
            'rgb(84, 84, 84)',
            'rgb(216, 35, 0)'
          ],

        }]
      },
      plugins: [ChartDataLabels, gradation],
      options: chartOptions
    });
    //○○万円UPのサイズと位置を計算
    const chartWidth = myChart.chartArea.width;
    const numLabels = myChart.data.labels.length;
    const barWidth = chartWidth / numLabels;
    const ttl_barWidth = barWidth * 2;
    const rbarWidth = barWidth * 0.7;
    const barSpacings = (chartWidth - (rbarWidth * 3)) / numLabels / 2;
    const thirdLabelX = myChart.scales.x.getPixelForValue(2);
    //3番目のグラフの万円部分の位置を算出
    //y軸
    const thirdBarHeight = myChart.scales.y.getPixelForValue(0) - myChart.scales.y.getPixelForValue(myChart.data.datasets[0].data[2]);
    //x軸
    const thirdBar = myChart.data.datasets[0].data[2];
    const thirdLabelWidth = myChart.ctx.measureText(myChart.data.labels[2]).width;
    const thirdLabel = thirdLabelX - (thirdLabelWidth / 2) - 4;
    //3番目のグラフの万円部分の位置を算出2
    //y軸
    const thirdBarHeight2 = myChart2.scales.y.getPixelForValue(0) - myChart2.scales.y.getPixelForValue(myChart2.data.datasets[0].data[2]);
    // CSSに変数を渡す
    const style = document.createElement('style');
    style.innerHTML = `
                      .ttl {
                        width: ${ttl_barWidth}px;
                        margin-left: ${barSpacings}px;
                        font-size: ${barSpacings}px;
                       }

                      .yentext1{
                        color: #fff;
                        position: absolute;
                         left: ${thirdLabel}px;
                            bottom: ${thirdBarHeight/2*0.9}px;

                          }
                      .yentext2{
                        color: #fff;
                        position: absolute;
                         left: ${thirdLabel}px;
                            bottom: ${thirdBarHeight2/2*0.9}px;

                          }
                          `;
    // HTMLにCSSを追加
    document.head.appendChild(style);
  </script>

  <style>
    .barChart {
      position: relative;
    }

    .example__graph p {
      position: absolute;
      padding: .3em 2.3em .3em .3em;
      background: #FFCA28;
      color: #fff;
      background: linear-gradient(to right, #d82300, #ffa800);
      font-weight: bold;
      margin-top: 10px;
    }

    @media (max-width: 767px) {
      .example__graph p {
        margin-top: 0;
        margin-left: 24px;
        max-width: 210px;
        font-size: 20px;
      }
    }

    .example__graph p::before {
      position: absolute;
      content: '';
      right: 0px;
      top: 0px;
      border: none;
      border-right: solid 2em #fafcfc;
      border-top: solid 2.3em transparent;
    }

    .example__graph p span {
      font-size: small;
    }
  </style>

<?php endif; ?>