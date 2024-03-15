<?php if (!empty(get_field('purchase_reinforcement_header', 30479))) : ?>
  <section class="purchase_reinforcement_section">
    <div class="titleMain titleMain--wrapper">
      <h2 class="titleMain--main">
        <?php the_field('purchase_reinforcement_header', 30479); ?>
      </h2>
    </div>
    <?php $i = 0; ?>
    <script>
      i = 0;
    </script>

    <div class="purchase_reinforcement" style="margin: 2rem auto 0;">
      <h4 style="text-align: center; width: 100%;">高級時計の買取強化アイテム</h4>
      <?php if (have_rows('purchase_reinforcement_repeat', 30479)) : ?>
        <?php while (have_rows('purchase_reinforcement_repeat', 30479)) : the_row(); ?>

          <?php $purchase_reinforcement_ttl = get_sub_field('purchase_reinforcement_ttl', 30479); ?>

          <?php if (get_sub_field('purchase_reinforcement_ttl', 30479)) : ?>

            <div class="purchase_reinforcement_area <?php echo "purchase_reinforcement_area" . $i++; ?>
            <?php if (get_sub_field('border', 30479)) {
              echo "purchase_reinforcement_border";
            }; ?>">

              <div class="purchase_reinforcement_ttl_wrap">
                <h3 class="purchase_reinforcement_ttl"><?php echo $purchase_reinforcement_ttl; ?></h3>
              </div>

              <div class="purchase_reinforcement_item_wrap">
                <?php if (have_rows('purchase_reinforcement_repeat_inner', 30479)) : ?>
                  <?php while (have_rows('purchase_reinforcement_repeat_inner', 30479)) : the_row(); ?>
                    <?php $purchase_reinforcement_name = get_sub_field('purchase_reinforcement_name', 30479) ?>

                    <a href="<?php the_sub_field('purchase_reinforcement_url', 30479); ?>">
                      <div class="purchase_reinforcement_item">
                        <div class="purchase_reinforcement_img_wrap">
                          <?php if (get_sub_field('purchase_reinforcement_img', 30479)) : ?>
                            <div class="purchase_reinforcement_img">
                              <img src="<?php the_sub_field('purchase_reinforcement_img', 30479); ?>" alt="<?php echo strip_tags($purchase_reinforcement_name); ?>">
                            </div>
                          <?php endif; ?>
                          <div class="purchase_reinforcement_name"><?php the_sub_field('purchase_reinforcement_name', $post_id); ?></div>
                        </div>
                      </div>
                    </a>

                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </div>

            <script>
              purchase_reinforcement_area = $(`.purchase_reinforcement_area${i} .purchase_reinforcement_img`).length;
              if (purchase_reinforcement_area == 4) {
                $(`.purchase_reinforcement_area${i}`).addClass('four');
              }
              i++;
            </script>

          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>

    <style>
      .purchase_reinforcement_item_wrap {
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
      }

      .purchase_reinforcement_img {
        text-align: center;
        margin: 5px 0;
      }

      .purchase_reinforcement_name {
        text-align: center;
      }

      .purchase_reinforcement {
        display: flex;
        flex-wrap: wrap;
        border-radius: 24px;
        padding: 20px 10px;
      }

      .purchase_reinforcement_ttl_wrap {
        text-align: center;
      }

      .purchase_reinforcement_img img {
        max-width: 170px;
        border-radius: 24px;
      }

      .purchase_reinforcement_area {
        width: 49%;
        margin-top: 20px;
        background-color: #f2f2f2;
        border-radius: 24px;
        flex-direction: column;
        justify-content: space-between;
        display: flex;
        padding: 10px 0;
      }

      .purchase_reinforcement_area.four {
        width: 100%;

      }

      .purchase_reinforcement_item {
        max-width: 170px;
      }

      .purchase_reinforcement_border {
        margin-right: 2%;
      }


      @media (max-width: 1025px) {
        .purchase_reinforcement_item_wrap {
          display: flex;
          flex-wrap: wrap;
        }

        .purchase_reinforcement_item {
          padding: 5px;
          max-width: 100%;
        }

        .purchase_reinforcement_area {
          width: 100%;
        }

        .purchase_reinforcement_img img {
          width: 100%;
        }

        .purchase_reinforcement_border {
          margin-right: 0%;
        }

        .purchase_reinforcement_section a {
          width: 50%;
        }

      }
    </style>

  </section>
<?php endif; ?>