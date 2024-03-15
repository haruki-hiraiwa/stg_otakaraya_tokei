<?php
/* ブランドページ（カテゴリページ）テンプレート */

get_template_part('head');

?>

<body id="app_404">

  <?php // get_header(); ?>

  <main class="contents">
    <article class="contents__left">

      <section>
        <div class="logo__img">
          <h1><a href="https://www.otakaraya.jp/"><img src="<?php echo THEME_URL; ?>assets/img/common/logo.png" class="logo" alt="おたからや"></a></h1>
        </div>
        <section class="app_404__wrap">
          <div class="titleH4">
            <h2>お探しのページは<br>見つかりませんでした。</h2>
          </div>
          <div class="text__wrap">
            <p>おたからやWEBサイトをご利用いただき、ありがとうございます。申し訳ございませんが、アクセスいただいたURLは、一時的にアクセスができない状態にあるか、移動・もしくは削除した可能性があります。お手数ですが、トップページから再度目的のページをお探しくださいませ。</p>
            <div class="btn__wrap btn__red">
              <a href="https://www.otakaraya.jp/">トップページに戻る</a>
            </div>
          </div>
        </section>
      </section>

    </article>

    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php // get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->

  </main>

  <?php
  // get_footer();?>
  </body>
</html>