  <?php
  include("/home/www_ebs/stg.otakaraya.jp/htdocs/assets/cta/footer_cta.php");
  ?>



  <?php get_template_part('/template-parts/footer/menu'); ?>

  <script src="<?php echo THEME_URL; ?>assets/js/common.js?p=(new Date()).getTime()"></script>
  <script src="<?php echo THEME_URL; ?>assets/js/slick.min.js"></script>
  <script src="<?php echo THEME_URL; ?>assets/js/breadlist.js"></script>

  <?php if (is_tax('result_cat') || is_singular('result')) : ?>

    <script>
      /* parts-flex */
      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1", "flex-slider2", "flex-slider3", "flex-slider4", "flex-slider5", "flex-slider6", "flex-slider7", "flex-slider8", "flex-slider9", "flex-slider10", "flex-slider11", "flex-slider12", "flex-slider13", "flex-slider14", "flex-slider15", "flex-slider16", "flex-slider17", "flex-slider18", "flex-slider19", "flex-slider20", "flex-slider21", "flex-slider22", "flex-slider23", "flex-slider24", "flex-slider25", "flex-slider26", "flex-slider27", "flex-slider28", "flex-slider29", "flex-slider30"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        $(elem).slick({
          arrows: true, // 矢印あり
          dots: true, // ドットあり
          appendArrows: $("." + slider + '--arrow'),
          appendDots: $("." + slider + '--dot'),
          autoplay: false,
          autoplaySpeed: 5000,
          centerMode: false,
          responsive: [{
            breakpoint: 9999,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              centerMode: false,
              variableWidth: true,
            }
          }]
        });
      });
    </script>
    <script>
      let sliders_3 = ["slider_only_3"];
      sliders_3.forEach((slider) => {
        let elem = document.getElementById(slider);
        $(elem).slick({
          arrows: true, // 矢印あり
          dots: true, // ドットあり
          appendArrows: $("." + slider + '--arrow'),
          appendDots: $("." + slider + '--dot'),
          autoplay: false,
          autoplaySpeed: 5000,
          centerMode: false,
          responsive: [{
            breakpoint: 9999,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          }, {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              centerMode: false,
              variableWidth: true,
            }
          }]
        });
      });
    </script>


    <script>
      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["flex-slider-sp5"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (windowW <= 767) {
            if (!elem.classList.contains("slick-initialized")) {
              $(elem).not('.slick-initialized').slick({
                arrows: true, // 矢印あり
                dots: true, // ドットあり
                appendArrows: $("." + slider + '--arrow'),
                appendDots: $("." + slider + '--dot'),
                // speed: 1000,
                slidesToShow: 2,
                slidesToScroll: 2,
                centerMode: false,
                variableWidth: true,
              })
            }
          } else {
            if (elem.classList.contains("slick-initialized")) {
              $(elem).slick('unslick');
            }
          }
        });
      }


      jQuery(window).on('resize load', function() {
        checkBreakPoint();
      });

      checkBreakPoint();
    </script>

    <?php if (is_tax('result_cat')) : ?>
      <?php
      /***** カテゴリ情報取得 *****/
      $term_obj = get_queried_object(); // タームオブジェクトを取得
      $term_parent = $term_obj->parent;
      if ($term_parent != 0) :
        $parent_term = get_term($term_parent);
      endif;

      if ($term_parent != 0) : ?>
        <script>
          /* スライダー(SPのみ) */
          function checkBreakPoint() {
            let slidersScOnly = ["flex-slider-sp5"];
            let windowW = document.body.clientWidth;

            slidersScOnly.forEach((slider) => {
              let elem = document.getElementById(slider);
              if (windowW <= 767) {
                if (!elem.classList.contains("slick-initialized")) {
                  $(elem).not('.slick-initialized').slick({
                    arrows: true, // 矢印あり
                    dots: true, // ドットあり
                    appendArrows: $("." + slider + '--arrow'),
                    appendDots: $("." + slider + '--dot'),
                    // speed: 1000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerMode: false,
                    variableWidth: true,
                  })
                }
              } else {
                if (elem.classList.contains("slick-initialized")) {
                  $(elem).slick('unslick');
                }
              }
            });
          }

          jQuery(window).on('resize load', function() {
            checkBreakPoint();
          });

          checkBreakPoint();
        </script>
    <?php endif;
    endif; ?>


  <?php elseif (is_singular('shop') || is_singular('area_vicinity')) : ?>

    <script>
      /*メインビジュアルユニット1*/
      $("#slide01").slick({
        asNavFor: "#thumbs01",
        arrows: true,
        autoplay: false,
        autoplaySpeed: 3000, // 最初のスライドの秒数
      })
      $("#thumbs01").slick({
        //ここにオプション
        asNavFor: "#slide01",
        slidesToShow: 4,
      });
      $("#thumbs01 .slick-slide").on("click", function() {
        let index = $(this).attr("data-slick-index")
        $("#slide01").slick("slickGoTo", index)
      })


      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1", "purchase_reason_slider"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        if (elem) {
          $(elem).slick({
            arrows: true, // 矢印あり
            dots: true, // ドットあり
            appendArrows: $("." + slider + '--arrow'),
            appendDots: $("." + slider + '--dot'),
            autoplay: false,
            autoplaySpeed: 5000,
            centerMode: false,
            variableWidth: false,
            responsive: [{
              breakpoint: 9999,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
              }
            }, {
              breakpoint: 768,
              settings: {
                variableWidth: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
              }
            }]
          });
        }
      });

      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["numbox-slider-sp1", "numbox-slider-sp2", "numbox-slider-sp3", "numbox-slider-shop_inside"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  variableWidth: false,
                  centerMode: false,
                  slidesToShow: 1,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });

        var slideCount = $('#columnbox01 .col').length;

        if (slideCount < 2) {
          $('.column_section .flex--slide__pagenation').css('display', 'none');
        }

        let slidersScOnly2 = ["columnbox01"];
        slidersScOnly2.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint();
      });
      checkBreakPoint();



      document.addEventListener('DOMContentLoaded', function() {

        /* グラフ表示 */
        var elem = document.getElementById('rateGraph--select');
        if (elem) {
          elem.addEventListener('change', function() {
            var result = elem.value;
            $('#rateGraph--output').html(result);
          }, false);
        }
        /* 計算 */
        var type = document.getElementById('rateSimulation--select');
        if (type) {
          type.addEventListener('change', function() {
            var typenum = $(this).val();
            var weight = $('input[name=weight]');
            var result = $('input[name=result]');

            weight.on('change', function() {
              var str = $(this).val();
              var num = Number(str.replace(/[^0-9]/g, ''));
              if (num == 0) {
                num = '';
              }
              $(this).val(num);
              if (num != 0) {
                var price = num * typenum;
                result.val(price);
              }
            });
          });
        }
      }, false);
    </script>


  <?php elseif (is_tax('area')) : ?>

    <script>
      /*メインビジュアルユニット1*/
      $("#slide01").slick({
        asNavFor: "#thumbs01",
        prevArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_prev_white01.png" class="slide-arrow prev-arrow">',
        nextArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_next_white01.png" class="slide-arrow next-arrow">',
        autoplay: false,
        autoplaySpeed: 5000,
        responsive: [{
          breakpoint: 768, // 399px以下のサイズに適用
          settings: {
            arrows: false,
          },
        }, ],
      })
      $("#thumbs01").slick({
        //ここにオプション
        asNavFor: "#slide01",
        slidesToShow: 4,
      });
      $("#thumbs01 .slick-slide").on("click", function() {
        let index = $(this).attr("data-slick-index")
        $("#slide01").slick("slickGoTo", index)
      })


      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        if (elem) {
          $(elem).slick({
            arrows: true, // 矢印あり
            dots: true, // ドットあり
            appendArrows: $("." + slider + '--arrow'),
            appendDots: $("." + slider + '--dot'),
            autoplay: false,
            autoplaySpeed: 5000,
            centerMode: false,
            variableWidth: false,
            responsive: [{
              breakpoint: 9999,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
              }
            }, {
              breakpoint: 768,
              settings: {
                variableWidth: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
              }
            }]
          });
        }
      });

      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["numbox-slider-sp1", "numbox-slider-sp2", "numbox-slider-sp3"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  variableWidth: true,
                  centerMode: false,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });

        var slideCount = $('#columnbox01 .col').length;

        if (slideCount < 2) {
          $('.column_section .flex--slide__pagenation').css('display', 'none');
        }

        let slidersScOnly2 = ["columnbox01"];
        slidersScOnly2.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint();
      });
      checkBreakPoint();



      document.addEventListener('DOMContentLoaded', function() {

        /* グラフ表示 */
        var elem = document.getElementById('rateGraph--select');
        elem.addEventListener('change', function() {
          var result = elem.value;
          $('#rateGraph--output').html(result);
        }, false);

        /* 計算 */
        var type = document.getElementById('rateSimulation--select');
        type.addEventListener('change', function() {
          var typenum = $(this).val();
          var weight = $('input[name=weight]');
          var result = $('input[name=result]');

          weight.on('change', function() {
            var str = $(this).val();
            var num = Number(str.replace(/[^0-9]/g, ''));
            if (num == 0) {
              num = '';
            }
            $(this).val(num);
            if (num != 0) {
              var price = num * typenum;
              result.val(price);
            }
          });
        });

      }, false);
    </script>

  <?php elseif (is_singular('post')) : ?>

    <script>
      /*メインビジュアルユニット1*/
      $("#slide01").slick({
        asNavFor: "#thumbs01",
        prevArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_prev_white01.png" class="slide-arrow prev-arrow">',
        nextArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_next_white01.png" class="slide-arrow next-arrow">',
        autoplay: false,
        autoplaySpeed: 5000,
        responsive: [{
          breakpoint: 768, // 399px以下のサイズに適用
          settings: {
            arrows: false,
          },
        }, ],
      })
      $("#thumbs01").slick({
        //ここにオプション
        asNavFor: "#slide01",
        slidesToShow: 4,
      });
      $("#thumbs01 .slick-slide").on("click", function() {
        let index = $(this).attr("data-slick-index")
        $("#slide01").slick("slickGoTo", index)
      })
      /* parts-flex */

      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1", "flex-slider2", "flex-slider3", "flex-slider4", "flex-slider5"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        if (elem) {
          $(elem).slick({
            arrows: true, // 矢印あり
            dots: true, // ドットあり
            appendArrows: $("." + slider + '--arrow'),
            appendDots: $("." + slider + '--dot'),
            autoplay: false,
            autoplaySpeed: 5000,
            slidesToShow: 4,
            slidesToScroll: 4,
            centerMode: false,
            variableWidth: true,
            responsive: [{
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
                variableWidth: true,
              }
            }]
          });
        }
      });

      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["flex-slider-sp1", "flex-slider-sp5"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });

        var slideCount = $('#columnbox01 .col').length;

        if (slideCount < 2) {
          $('.column_section .flex--slide__pagenation').css('display', 'none');
        }

        let columnbox_slidersScOnly = ["columnbox01"];

        columnbox_slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });




      }
      $(window).resize(function() {
        checkBreakPoint();
      });

      checkBreakPoint();

      acoddingarea = function() {
        var acod_content = '.modelNumber__acod--contents',
          acod_switchOpen = '.modelNumber__acod--switch.open',
          openClass = 'open';
        $(window).on('load resize', function() {
          if (window.matchMedia("(max-width: 768px)").matches) {
            $(acod_content).hide();
            $(acod_switchOpen).next(acod_content).show();
          } else {
            //画面横幅が769px以上のときの処理
            $(acod_content).show();
          };
        });
        $('.js-modelNumber__acod > .modelNumber__acod--switch').on('click', function() {
          if ($(this).hasClass(openClass)) {
            $(this).removeClass(openClass);
            $(this).next(acod_content).slideUp();
          } else {
            $(this).addClass(openClass);
            $(this).next(acod_content).slideDown();
          }
        });
      };
      acoddingarea();
    </script>


  <?php elseif (is_category()) : ?>

    <script>
      /*メインビジュアルユニット1*/
      $("#slide01").slick({
        asNavFor: "#thumbs01",
        prevArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_prev_white01.png" class="slide-arrow prev-arrow">',
        nextArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_next_white01.png" class="slide-arrow next-arrow">',
        autoplay: false,
        autoplaySpeed: 5000,
        responsive: [{
          breakpoint: 768, // 399px以下のサイズに適用
          settings: {
            arrows: false,
          },
        }, ],
      })
      $("#thumbs01").slick({
        //ここにオプション
        asNavFor: "#slide01",
        slidesToShow: 4,
      });
      $("#thumbs01 .slick-slide").on("click", function() {
        let index = $(this).attr("data-slick-index")
        $("#slide01").slick("slickGoTo", index)
      })
      /* parts-flex */

      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1", "flex-slider2", "flex-slider3", "flex-slider4", "flex-slider5"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        if (elem) {
          $(elem).slick({
            arrows: true, // 矢印あり
            dots: true, // ドットあり
            appendArrows: $("." + slider + '--arrow'),
            appendDots: $("." + slider + '--dot'),
            autoplay: false,
            autoplaySpeed: 5000,
            centerMode: false,
            responsive: [{
              breakpoint: 9999,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
              }
            }, {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
                variableWidth: true,
              }
            }]
          });
        }
      });

      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["flex-slider-sp1"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint();
      });

      checkBreakPoint();

      function checkBreakPoint2() {

        var slideCount = $('#columnbox01 .col').length;

        if (slideCount < 2) {
          $('.column_section .flex--slide__pagenation').css('display', 'none');
        }

        let slidersScOnly = ["columnbox01"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  // speed: 1000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint2();
      });

      checkBreakPoint2();
    </script>

  <?php elseif (is_home() || is_front_page()) : ?>

    <script>
      /*メインビジュアルユニット1*/
      $("#slide01").slick({
        asNavFor: "#thumbs01",
        prevArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_prev_white01.png" class="slide-arrow prev-arrow">',
        nextArrow: '<img src="<?php echo THEME_URL; ?>assets/img/common/slide_next_white01.png" class="slide-arrow next-arrow">',
        autoplay: false,
        autoplaySpeed: 5000,
        responsive: [{
          breakpoint: 768, // 399px以下のサイズに適用
          settings: {
            arrows: false,
          },
        }, ],
      })
      $("#thumbs01").slick({
        //ここにオプション
        asNavFor: "#slide01",
        slidesToShow: 4,
      });
      $("#thumbs01 .slick-slide").on("click", function() {
        let index = $(this).attr("data-slick-index")
        $("#slide01").slick("slickGoTo", index)
      })
      /* parts-flex */

      /* スライダー(PC,SP両方) */
      let sliders = ["flex-slider1", "flex-slider2", "flex-slider3", "flex-slider4", "flex-slider5"];
      sliders.forEach((slider) => {
        let elem = document.getElementById(slider);
        if (elem) {
          $(elem).slick({
            arrows: true, // 矢印あり
            dots: true, // ドットあり
            appendArrows: $("." + slider + '--arrow'),
            appendDots: $("." + slider + '--dot'),
            autoplay: false,
            autoplaySpeed: 5000,
            centerMode: false,
            responsive: [{
              breakpoint: 9999,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
              }
            }, {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                slickGoTo: 1,
                centerMode: false,
                variableWidth: true,
              }
            }]
          });
        }
      });

      /* スライダー(SPのみ) */
      function checkBreakPoint() {
        let slidersScOnly = ["flex-slider-sp1"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  autoplay: false,
                  autoplaySpeed: 5000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint();
      });

      checkBreakPoint();

      function checkBreakPoint2() {

        var slideCount = $('#columnbox01 .col').length;

        if (slideCount < 2) {
          $('.column_section .flex--slide__pagenation').css('display', 'none');
        }

        let slidersScOnly = ["columnbox01"];
        let windowW = document.body.clientWidth;

        slidersScOnly.forEach((slider) => {
          let elem = document.getElementById(slider);
          if (elem) {
            if (windowW <= 767) {
              if (!elem.classList.contains("slick-initialized")) {
                $(elem).not('.slick-initialized').slick({
                  arrows: true, // 矢印あり
                  dots: true, // ドットあり
                  appendArrows: $("." + slider + '--arrow'),
                  appendDots: $("." + slider + '--dot'),
                  // speed: 1000,
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  centerMode: false,
                  variableWidth: true,
                })
              }
            } else {
              if (elem.classList.contains("slick-initialized")) {
                $(elem).slick('unslick');
              }
            }
          }
        });
      }

      jQuery(window).on('resize load', function() {
        checkBreakPoint2();
      });

      checkBreakPoint2();
    </script>


  <?php elseif (is_post_type_archive('faq')) : ?>


    <script>
      $(document).ready(function() {
        $('.faq-accordion__ttl').each(function() {
          if (!$(this).parent().hasClass('open')) {
            $(this).parent().find('.faq-accordion__item').css('display', 'none');
          }
        });
      });
      $('.faq-accordion__ttl').on('click', function() {
        $(this).parent().toggleClass("open");
        $('.faq-accordion__item').slideToggle();
        return false;
      });
    </script>


  <?php endif; ?>
  <!--
<?php
// global $template; // グローバル変数からテンプレート情報を取得
// echo "thema_name = ".$thema_name = basename(dirname($template)); // テーマディレクトリ名
// echo "<BR>";
// echo "template_name = ".$template_name = basename($template, '.php'); // テーマファイル名
?>
-->
  <?php wp_footer(); ?>

  <!-- YTM tag -->
  <script type="text/javascript">
    (function() {
      var tagjs = document.createElement("script");
      var s = document.getElementsByTagName("script")[0];
      tagjs.async = true;
      tagjs.src = "//s.yjtag.jp/tag.js#site=CDpCq97";
      s.parentNode.insertBefore(tagjs, s);
    }());
  </script>
  <noscript>
    <iframe src="//b.yjtag.jp/iframe?c=CDpCq97" width="1" height="1" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  </noscript>
  <!-- YTM tag END-->
  <script type="text/javascript" src="https://fspark-ap.com/tag/lZy6pgXP92vk20010FS.js"></script>
  <script type="text/javascript" src="https://fspark-ap.com/cv_tag/lZy6pgXP92vk20010FS.js"></script>
  </body>

  <style>
    @media (min-width: 768px) {
      .margin_top {
        margin-top: 8rem;
      }
    }

    @media (max-width: 767px) {
      .margin_top {
        margin-top: 4rem;
      }

    }

    @media (max-width: 767px) {
      #shopdetail .shop__detail--services .colBox__col06>.col .text {
        font-size: 0.775rem;
      }

      #shopdetail .shop__detail--services .colBox.sp__col04>.col {
        text-align: center;
      }
    }
  </style>

  <style>
    .contents {
      margin: 2rem auto 2rem;
    }

    .contents__left section+section,
    section.page-link,
    .cta+section {
      margin-top: 2rem !important;
    }

    #mock_app section {
      margin-top: 2rem !important;
    }

    .cta {
      margin: 2rem auto 0;
    }

    .ctaAdd__list dl {
      margin-bottom: 0rem;
    }

    #app_contents .column__wrap {
      margin-bottom: 0rem;
    }


    .titleMain--wrapper {
      margin-top: 2rem;
    }

    .margin_top {
      margin-top: 2rem;
    }

    .sidebar__nav--wrapper+.sidebar__nav--wrapper {
      margin: 0;
    }

    .flex+.btn__wrap.btn__red,
    .flex__content+.btn__wrap.btn__red {
      margin-top: 1rem !important;
    }
  </style>


  </html>