<!-- nav -->
<div class="nav__wrap">
  <div class="nav__inner">

    <div class="subnav__wrap test">
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'spmenu',
          'container'               => 'div', //<nav>タグで囲うよ！
          'container_class'          => 'subnav__wrap', //<nav id="gnav">にするよ！
          'depth'                    => 0,
          'walker'  => new custom_walker_sp_nav_menu
        )
      );
      ?>
      <ul>
        <?php
        if (have_rows('side_common_menu_repeat', 19068)) :
          while (have_rows('side_common_menu_repeat', 19068)) : the_row(); ?>
            <li class="btn__gy01--wrap">
              <a href="<?php the_sub_field('side_common_menu_repeat_link'); ?>" class="">
                <?php the_sub_field('side_common_menu_repeat_text'); ?></a>
            </li>
        <?php
          endwhile;
        endif;
        ?>
      </ul>

    </div>

    <?php
    $mode = "";
    if ($_GET["mode"]) {
      $mode = $_GET["mode"];
    }
    ?>
    <?php if (!$mode == "test") { ?>
      <div class="cta__wrap">
        <ul>
          <li class="btn__gr01--wrap">
            <a href="https://www.otakaraya.jp/shop/">お近くの店舗を探す</a>
          </li>
          <li class="btn__gr01--wrap">
            <a href="https://www.otakaraya.jp/visiting/">出張買取の詳細はこちら</a>
          </li>
        </ul>
      </div>
    <?php } else { ?>
      <?php echo get_field('cta_sidemenu_button', 19025); ?>
    <?php } ?>


    <div class="logo__wrap">
      <p class="logo__img"><img src="<?php echo THEME_URL; ?>assets/img/common/logo.png" class="logo" alt="おたからや"></p>
      <p class="logo__text">貴金属の買取なら無料査定・出張買取<br>全国出店数No.1の買取専門店</p>
    </div>

    <div class="tel__wrap">
      <p class="tel__img"><a href="tel:0120555600"><img src="<?php echo THEME_URL; ?>assets/img/common/header_tel.png" alt="0120-555-600"></a></p>
      <p class="tel__text">
        <?php
        include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/business_hours/business_hours_text.php");
        ?>
      </p>
    </div>

    <nav class="nav">
      <ul class="gnav__wrap">
        <li class="gnav__item top<?php if (is_home() || is_front_page()) : ?> current<?php endif; ?>"><a href="<?php echo esc_url(home_url('/')); ?>">
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_01.png" alt="トップページ"></p>
              <p class="gnav__item--text">トップページ</p>
            </div>
          </a></li>
        <li class="gnav__item newCustomer"><a href="https://www.otakaraya.jp/first/">
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_02.png" alt="初めての方へ"></p>
              <p class="gnav__item--text">初めての方へ</p>
            </div>
          </a></li>
        <li class="gnav__item flow"><a href="https://www.otakaraya.jp/method_flow/">
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_03.png" alt="査定・買取の流れ"></p>
              <p class="gnav__item--text">査定・買取の流れ</p>
            </div>
          </a></li>
        <li class="gnav__item items"><a href="https://www.otakaraya.jp/item/">
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_04.png" alt="買取可能な商品"></p>
              <p class="gnav__item--text">買取可能な商品</p>
            </div>
          </a></li>
        <li class="gnav__item howto_businessTrip"><a href="https://www.otakaraya.jp/visiting/">
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_05.png" alt="出張買取とは"></p>
              <p class="gnav__item--text">出張買取とは</p>
            </div>
          </a></li>
        <li class="gnav__item nearBy_shops<?php if (is_post_type_archive('shop') || is_tax('area') || is_singular('shop')) : ?> current<?php endif; ?>">
          <a href="https://www.otakaraya.jp/shop/">
            <!-- <a href="https://www.otakaraya.jp/shop/"> -->
            <div>
              <p class="gnav__item--img"><img src="<?php echo THEME_URL; ?>assets/img/common/nav_img_06.png" alt="お近くの店舗を探す"></p>
              <p class="gnav__item--text">お近くの店舗を探す</p>
            </div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>