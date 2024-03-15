<?php
/* 相場グラフ（３）
*Template Name: bar_chart
*テンプレートパーツとしてグラフの描写を行います。

カスタムフィールドの構成は
親フィールドは２つで、フィールド名が
purchase_market_price_transition_repeat (タイプ繰り返しフィールド)
  ┗pmpt_history_repeat (タイプ繰り返しフィールド)
    ┗pmpt_history_repeat_date(タイプテキスト：2000年00月)
    ┗pmpt_history_repeat_price(タイプテキスト：金額※数値のみ)
  ┗pmpt_repeat_brand(タイプテキスト：ブランド名)
  ┗pmpt_repeat_model(タイプテキスト：商品名)
pmpt_repeat_img(タイプ画像：返り値のフォーマットは画像ID)

です。

CSSは命名を適時変更して頂く想定で作成しています。

また、このチャートの描写のChart.jsはバージョン3.7.1でbar_chart.phpは4.2.1ですので共存できません。
bar_chart.phpとこのグラフを同じページに配置する場合はこちらのバージョンを上げて出力出来る様に変更を行います。
*/
global $cat_id;

if (is_category()) :
  $post_id = 'category_' . $cat_id;
  $purchase_market_price_transition_repeat = get_field('purchase_market_price_transition_repeat', $post_id);
  $headline = get_field('purchase_market_price_transition_headline', $post_id);
else :
  $purchase_market_price_transition_repeat = get_field('purchase_market_price_transition_repeat');
  $headline = get_field('purchase_market_price_transition_headline');
endif;

?>


<?php if ($purchase_market_price_transition_repeat) : ?>
  <link rel="stylesheet" href="https://www.otakaraya.jp/brand-tokei/wp-content/plugins/otakaraya-brand-lp//assets/css/brandlp.css?22032602">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <section id="rate-box" class="section section--soba">
    <div class="chart">
      <!-- margin top 128px -->

      <div class="titleMain titleMain--wrapper">
        <h2 class="titleMain--main">
          <?php echo $headline; ?>
        </h2>
      </div>




      <div class="chart__wrap">
        <?php

        // echo '<pre>';
        // var_dump($purchase_market_price_transition_repeat);
        // echo '</pre>';


        foreach ($purchase_market_price_transition_repeat as $key => $soba) :

          //$product_name = $soba['product']->post_title;
          $brand_name = $soba['pmpt_repeat_brand'];
          $product_name = $soba['pmpt_repeat_model'];
          $thumbnail = $soba['pmpt_repeat_img'];
          $select_thumbnail = get_field('img_path', $soba['select_product']->ID);
          $select_image_url = wp_get_attachment_url($select_thumbnail, 'large');
          $history_array = $soba['pmpt_history_repeat'];
          $pmpt_history_repeat_date = array();
          $pmpt_history_repeat_price = array();

          foreach ($history_array as $h) :
            // $history_data[] = [$h['pmpt_history_repeat_date'],$h['pmpt_history_repeat_price']];
            $pmpt_history_repeat_date[] = '"' . $h['pmpt_history_repeat_date'] . '"';
            $pmpt_history_repeat_price[] = $h['pmpt_history_repeat_price'];
          endforeach;
          $lastItem_price = end($pmpt_history_repeat_price);
          $Item_Minprice = min($pmpt_history_repeat_price);

          // Get the index of the last and second last items
          $Item_Minprice_index = array_search($Item_Minprice, $pmpt_history_repeat_price);

          // Get the date of the last and second last items
          $lastItem_date = str_replace('"', '', end($pmpt_history_repeat_date));
          $Item_Minprice_date = str_replace('"', '', $pmpt_history_repeat_date[$Item_Minprice_index]);


          // echo '<pre>';
          // var_dump($history_data);
          // echo '</pre>';

          // echo '<pre>';
          // var_dump($pmpt_history_repeat_date);
          // var_dump($pmpt_history_repeat_price);
          // echo '</pre>';



        ?>


          <div class="chart__card">
            <figure class="chart__image">
              <img src="<?php echo (!empty($thumbnail) ? $thumbnail : $select_image_url); ?>" alt="<?php echo ($brand_name . " " . $product_name); ?>">
              <figcaption class="chart__title"><?php echo $brand_name; ?></figcaption>
              <figcaption class="chart__text">
                <?php echo $product_name; ?>
              </figcaption>
            </figure>

            <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load("current", {
              packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                  role: "style"
                }],
                // ["Copper", 8.94, "#b87333"],
                // ["Silver", 10.49, "silver"],
                [<?php echo $history_data[0][0]; ?>, <?php echo $history_data[0][1]; ?>, "color:#ccc"],
                [<?php echo $history_data[1][0]; ?>, <?php echo $history_data[1][1]; ?>, "color:#ccc"],
                [<?php echo $history_data[2][0]; ?>, <?php echo $history_data[2][1]; ?>, "color:#b74b5f"]
              ]);

              var view = new google.visualization.DataView(data);
              view.setColumns([0, 1,
                {
                  calc: "stringify",
                  sourceColumn: 1,
                  type: "string",
                  role: "annotation"
                },
                2
              ]);

              var options = {
                width: "100%",
                height: "100%",
                bar: {
                  groupWidth: "95%"
                },
                legend: {
                  position: "none"
                },
              };
              var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
              chart.draw(view, options);
            }
          </script>
          <div id="columnchart_values" style="width: 360px; height: 360px;"></div> -->

            <div class="chart__translation">
              <canvas id="graph<?php echo $key; ?>"></canvas>
              <table class="chart__table">
                <thead>
                  <tr>
                    <th class=""><?php echo $Item_Minprice_date; ?></th>
                    <th class=""><?php echo $lastItem_date; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="">
                    <td class=""><?php echo $Item_Minprice; ?> 万円</td>
                    <td class=""><?php echo $lastItem_price; ?> 万円</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <script>
              var ctx_soba<?php echo $key; ?> = document.getElementById("graph<?php echo $key; ?>").getContext('2d');
              var myChart_soba<?php echo $key; ?> = new Chart(ctx_soba<?php echo $key; ?>, {
                type: 'line',
                data: {
                  labels: [<?php echo implode(',', $pmpt_history_repeat_date); ?>],
                  datasets: [{
                    label: '買取価格',
                    data: [<?php echo implode(',', $pmpt_history_repeat_price); ?>],
                    // backgroundColor: [
                    //   '#ccc', '#ccc', '#b74b5f'
                    // ],
                    borderColor: 'rgb(183, 75, 95)',
                    backgroundColor: 'rgba(183, 75, 95,0.5)',
                    // pointStyle: 'rect',
                    // pointRadius: 1,
                    // pointHoverRadius: 1

                  }]
                },
                responsive: true,
                options: {
                  plugins: {
                    legend: false
                  },
                  scales: {
                    y: {
                      title: {
                        display: true,
                        text: '（万円）'
                      }
                    }
                  }
                }
              });
            </script>

          </div>


        <?php endforeach; ?>
        <style>
          .section--sobaItem {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            //justify-content: space-between;
            //gap: 10px;
          }

          .section--sobaItem .graph {
            width: 60%;
          }

          .section--sobaItem .model {
            text-align: center;
          }

          figure {
            margin: 1em 40px;
          }

          .section--sobaItem .model figcaption {
            display: block;
            text-align: center;
            font-weight: 700;
            font-size: 1.8rem;
          }

          .section--sobaItem .model figcaption span {
            font-size: 60%;
            font-weight: 100;
          }

          //ここは変更する。
          .model img {
            width: 200px;
          }

          //ここは変更する。
          .sobaChart canvas {
            border: 5px solid #F2F2F2;
            padding: 30px;
            border-radius: 10px;
          }

          table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            border-radius: 35px;
            overflow: hidden;
            margin-top: 30px;
          }

          th {
            background-color: rgb(84, 84, 84);
            color: rgb(242, 242, 242);
            font-weight: 100;
            padding: 10px;

          }

          th:nth-child(2) {
            background-color: rgb(216, 35, 0);
          }

          td {
            background-color: rgb(242, 242, 242);
            color: rgb(84, 84, 84);
            padding: 10px;

          }

          td:nth-child(2) {
            background-color: rgb(242, 242, 242);
/*             color: rgb(216, 35, 0); */
            color: rgb(84, 84, 84);
            font-weight: bold;
          }

          th:first-child,
          td:first-child {
            border-right: 1px solid white;
          }

          th:last-child,
          td:last-child {
            border-left: 1px solid white;
          }
        </style>
      </div>
    </div>

  </section>
<?php endif; ?>

<?php /* if ($table_price) : ?>
  <section id="rate-box" class="section section--soba">

    <h2 class="headline-text mincho sitecolor"><?php echo $intro_ttl; ?>相場高騰中！</h2>
    <table>
      <?php if ($table_price['header']) : ?>
        <tr>
          <?php foreach ($table_price['header'] as $th) : ?>
            <th class="bgsitecolor"><?php echo $th['c']; ?></th>
          <?php endforeach; ?>
        </tr>
      <?php endif; ?>
      <?php foreach ($table_price['body'] as $tr) : ?>
        <tr>
          <?php
          $i = 0;
          foreach ($tr as $td) :
            $cls = ($i > 0) ? 'price' : '';
          ?>
            <td class="<?php echo $cls; ?>"><?php echo $td['c']; ?></td>
          <?php $i++;
          endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </table>
  </section>
<?php endif; */ ?>