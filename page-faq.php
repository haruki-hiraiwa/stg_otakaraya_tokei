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
      <li class="topic__path--item"><a href="https://www.otakaraya.jp/">買取専門店・おたからやTOP</a></li>
      <li class="topic__path--item"><span>よくあるご質問</span></li>
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
              );

              $terms = get_terms('faq_cat', $args);
              foreach ($terms as $term) {
              ?>
                <li><a href="#<?php echo $term->slug ?>"><?php echo $term->name ?></a></li>
              <?php
              }
              ?>


              <li><a href="#">買取について多く寄せられる質問</a></li>
              <li><a href="#">買取・査定方法について</a></li>
              <li><a href="#">出張買取について</a></li>
              <li><a href="#">店頭買取について</a></li>
              <li><a href="#">身分証明に関するご質問</a></li>
              <li><a href="#">その他多く寄せられるご質問</a></li>
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
        <section>
          <h3 class="titleSub">買取について多く寄せられる質問</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>

        <section>
          <h3 class="titleSub">買取・査定方法について</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>

        <section>
          <h3 class="titleSub">出張買取について</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>

        <section>
          <h3 class="titleSub">店頭買取について</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>

        <section>
          <h3 class="titleSub">身分証明に関するご質問</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>

        <section>
          <h3 class="titleSub">その他多く寄せられるご質問</h3>
          <div class="qa__wrap">
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
            <!-- もっと見るあり -->
            <div class="qa__list">
              <dl class="qa__list__inner">
                <dt class="qa__list__q">通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。</dt>
                <dd class="qa__list__a btn--more">
                  通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。通常テキスト14pxテキストがここに入ります。以下ダミーテキスト。吾輩は猫である。名前はまだ無い。どこで生れたかとんと見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。
                </dd>
                <div class="qa__list__button"><button>もっと見る</button></div>
              </dl>
            </div>
          </div>
        </section>
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
