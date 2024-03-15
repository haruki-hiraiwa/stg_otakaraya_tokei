<?php
/* Template Name: よくある質問ページテンプレート */

get_template_part('head');

?>

<body id="faq">

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
      <li class="topic__path--item">
        <span>よくあるご質問</span>
      </li>
    </ol>
  </div>

  <main class="contents">
    <article class="contents__left">
      <section>
        <dl class="faq-accordion open">
          <dt class="faq-accordion__ttl">
            <p>よくある質問のカテゴリー</p>
          </dt>
          <dd class="faq-accordion__item">
            <ul>
              <?php
              $args = array(
                'exclude' => array(543, 544, 545, 546),
                'hide_empty' => 0,
              );

              $terms = get_terms('faq_cat', $args);
              foreach ($terms as $term) {

                // echo "------------<BR>";
                // var_dump($term);
                // echo "<BR>------------";
              ?>
                <li><a class="scroll" href="#<?php echo $term->slug ?>"><?php echo $term->name ?></a></li>
              <?php
              }
              ?>
            </ul>
          </dd>
        </dl>
      </section>

      <section>
        <div class="titleMain titleMain--wrapper">
          <h2 class="titleMain--main">
            おたからやに寄せられる<span>よくある質問</span>
          </h2>
        </div>

        <?php
        foreach ($terms as $term) :

          $args = array(
            'post_type' => 'faq',
            'tax_query' => array(
              array(
                'taxonomy' => 'faq_cat',
                'field'    => 'slug',
                'terms'    => $term->slug,
              ),
            ),
          );
          $the_query = new WP_Query($args);
        ?>
          <?php if ($the_query->have_posts()) : ?>
            <section>
              <h3 class="titleSub" id="<?php echo $term->slug ?>"><?php echo $term->name ?></h3>
              <div class="qa__wrap">
                <!-- もっと見るあり -->
                <?php while ($the_query->have_posts()) : $the_query->the_post();
                  $kind_name = 'ブランド時計';
                  $question = str_replace('[kind-name]', $kind_name, get_the_title());

                ?>
                  <div class="qa__list">
                    <dl class="qa__list__inner">
                      <dt class="qa__list__q"><?php echo $question; ?></dt>
                      <?php
                      $answer = nl2br(str_replace('[kind-name]', $kind_name, the_field_without_wpautop('faq_answer')));

                      if (substr_count($answer, "<br>") > 0) :
                      ?>
                        <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
                        <div class="qa__list__button"><button>もっと見る</button></div>
                      <?php
                      elseif (substr_count($answer, "\n") > 0) :
                      ?>
                        <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
                        <div class="qa__list__button"><button>もっと見る</button></div>
                      <?php
                      elseif (substr_count($answer, "\r\n") > 0) :
                      ?>
                        <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
                        <div class="qa__list__button"><button>もっと見る</button></div>
                        <?php
                      // echo "c = ".strstr($answer, "\r\n")."<br>";
                      else :
                        if (mb_strlen(get_the_content(), 'UTF-8') > 100) :
                        ?>
                          <dd class="qa__list__a btn--more"><?php echo $answer; ?></dd>
                          <div class="qa__list__button"><button>もっと見る</button></div>
                        <?php else : ?>
                          <dd class="qa__list__a"><?php echo $answer; ?></dd>
                        <?php endif; ?>
                      <?php endif; ?>

                    </dl>
                  </div>
                <?php endwhile; ?>
            </section>
          <?php endif; ?>
        <?php endforeach;
        wp_reset_postdata(); ?>



      </section>

      <section>
        <?php get_template_part('/template-parts/cta/cta01'); ?>
        <?php get_template_part('/template-parts/cta/cta03'); ?>
      </section>



    </article>





    <!--     ▼▼▼サイドメニュー▼▼▼     -->

    <?php get_template_part('/template-parts/navigation/side_menu'); ?>

    <!--     ▲▲▲サイドメニュー▲▲▲     -->


  </main>



  <?php
  get_footer();
