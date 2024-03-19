'use strict';

(function($, undefined) {

  $(function () {
    Ctrl.acodContentsnav();
    Ctrl.acodContents01();
    Ctrl.acodContents02();
    Ctrl.drawer01();
    Ctrl.smoothScroll();
    Ctrl.faqMore();
    Ctrl.moreBtn();
    Ctrl.scrollAccordion();
    Ctrl.checkBreakPoint();
    Ctrl.acodSidenav();
    Ctrl.acodSidenav2();
  });

  var Ctrl = (function () {
    var _func = {},
    //アコーディオン
    _acodContentsnav = function () {
      var acod__contentNav = '.acod__contentsNav',
        acod__switchOpenNav = '.acod__switchNav.open',
        openClass = 'open';

      $(window).on('load resize', function () {
        if (window.matchMedia("(max-width: 767px)").matches) {
          $(acod__contentNav).hide();
          $(acod__switchOpenNav).next(acod__contentNav).show();
        } else {
          $(acod__contentNav).show();
        }
      });

      $('.js-acod__nav > .acod__switchNav').on('click', function () {
        $(this).toggleClass(openClass);
        $(this).next(acod__contentNav).slideToggle();
      });
    },

    _acodContents01 = function () {
      var acod_content = '.acod__contents',
      acod_switchOpen = '.acod__switch.open',
      openClass = 'open';
      $(acod_content).hide();
      $(acod_switchOpen).next(acod_content).show();
      //slideToggleを使用する
      $('.js-acod01 > .acod__switch').on('click',function(){
        $(this).toggleClass(openClass);
        $(this).next(acod_content).slideToggle();
      });
    },

    _acodContents02 = function () {
      var acod_content = '.acod__contents',
      acod_switchOpen = '.acod__switch.open',
      openClass = 'open';

      $(window).on('load resize', function () {
        if (window.matchMedia("(max-width: 767px)").matches) {
          $(acod_content).hide();
          $(acod_switchOpen).next(acod_content).show();
          //slideToggleを使用する
        } else {
          $(acod_content).show();
        }
      });

      $('.js-acod02 > .acod__switch').on('click',function(){
        $(this).toggleClass(openClass);
        $(this).next(acod_content).slideToggle();
      });
    },

    _acodSidenav = function () {
      var acod__contentNav = '.sideAcod__contentsNav',
      acod__switchOpenNav = '.sideAcod__switchNav.open',
      openClass = 'open';
      $(acod__contentNav).hide();
      $(acod__switchOpenNav).next(acod__contentNav).show();

      //slideToggleを使用する
      $('.js-acod__nav > .sideAcod__switchNav').off('click');
      $('.js-acod__nav > .sideAcod__switchNav').on('click',function(){
        $(this).toggleClass(openClass);
        $(this).next(acod__contentNav).slideToggle();
      });
    },

    _acodSidenav2 = function () {
      var acod__contentNav2 = '.js-acid-nav2__content',
      acod__switchOpenNav2 = '.sideAcod__switchNav.open',
      openClass = 'open';
      $(acod__contentNav2).hide();
      $(acod__switchOpenNav2).parents('.js-acod__nav2').children(acod__contentNav2).show();

      $(acod__contentNav2 +'.head').prev('.item').addClass('last-item');

      //slideToggleを使用する
      $('.js-acod__nav2 > .sideAcod__switchNav').off('click');
      $('.js-acod__nav2 > .sideAcod__switchNav').on('click',function(){
        $(this).toggleClass(openClass);
        $(this).parents('.js-acod__nav2').children(acod__contentNav2).slideToggle();
      });
    },


    //ドロワーメニュー
    _drawer01 = function () {
      var scrollpos = 0;
      $('#nav_toggle').on('click',function(){
        if($('header').hasClass('open')){
          navClose();
          $(window).scrollTop(scrollpos);
        }else{
          scrollpos = $(window).scrollTop();//スクロール位置を取得
          $('header').addClass('open');
          var navHeight = $(window).innerHeight();
          $('body').addClass('is-fixed').css({//スクロールできないように対策
            'top': -scrollpos,
            'position': 'relative',
            'overflow': 'hidden'
          });
          $('header.open').css({'height': navHeight + 'px'});
        }
      });
      $('nav a.scroll').on('click', function(){//ナビのページ内リンクをクリックしたときにナビを閉じる
        navClose();
      });
      //閉じる関数
      function navClose() {
        $('#header').removeClass('open');
        $('.overLay').remove();//[.overLay]を削除する
        $('body').removeClass('is-fixed').css({
          'top': 0,
          'position': '',
          'overflow': ''
        });//スクロールできないように対策を解除
        $('header').css({'height': ''});
      }
    },

    //スムーススクロール
    _smoothScroll = function () {
      $('a.scroll[href^="#"]').click(function(){
        var speed = 500;
        var href= $(this).attr('href');
        var target = $(href == '#' || href == '' ? 'html' : href);
        var position = target.offset().top;
        $('html, body').animate({scrollTop:position}, speed, 'swing');
        return false;
      });
    },

    //スクロール後アコーディオンが開く
    _scrollAccordion = function () {
      $(".fshoplist-target__list > .fshoplist-target--item").hide();
      $(".fshoplist-target__list.open > .fshoplist-target--item").show();
      $('.fshoplist-trigger--item > a').on('click', function(){
        var href= $(this).attr('href');
        var target = $(href == '#' || href == '' ? 'html' : href);
        var targetId = $(target).attr('id');
        $(target).toggleClass("open");
        $(target).children(".fshoplist-target--item").slideToggle();
        return false;
      });
      $('.fshoplist-target__list .fshoplist-target--ttl').on('click', function(){
        $(this).parent().toggleClass("open");
        $(this).parent().children(".fshoplist-target--item").slideToggle();
        return false;
      });
    },

    //faq
    _faqMore = function () {
      $('.qa__list__button > button').on('click',function(){
        var statusClass = 'btn--more';
        var faqBtn = '.qa__list__button';
        $(this).parent().fadeOut(200);
        $(this).parent().prev().removeClass(statusClass);
        $(this).parent().parent().css("min-height", "auto");
      });
    },


    //もっと見るボタン
    _moreBtn = function () {
      $(window).on('load', function(){
        const more3th = 'js__more--3th',
        more2th = 'js__more--2th',
        moreNum5 = 5,
        // moreNum3 = 3,
        moreNum2 = 2;
        $('.js__more--item3:nth-child(n + ' + (moreNum5 + 1) + ')').addClass('is-hidden').hide();
        $('.js__more--item2:nth-child(n + ' + (moreNum2 + 1) + ')').addClass('is-hidden').hide();
        /* 全てのリストを表示したら「もっとみる」ボタンをフェードアウト */
        $('.js__more--3th').each(function() {
          $('.js__more--btn3').on('click', function() {

            // $(this).prev('.js__more--3th').children('.js__more--item3.is-hidden').slice(0, moreNum3).removeClass('is-hidden').show();
            // $(this).prev('.js__more--3th').children('.js__more--item3:nth-child(n + ' + (moreNum3 + 1) + ').is-hidden').removeClass('is-hidden').show();
            const $more3th = $(this).prev('.js__more--3th');
            $more3th.children('.js__more--item3.is-hidden').slice(0, moreNum5).removeClass('is-hidden').show();
      
            if ($more3th.find(".js__more--item3.is-hidden").length == 0) {
              $(this).fadeOut();
            }
          });
        });

        $('.js__more--2th').each(function() {
          $('.js__more--btn2').on('click', function() {

            // $(this).prev().children(".is-hidden").removeClass('is-hidden').show();
            $(this).prev('.js__more--2th').children('.js__more--item2.is-hidden').slice(0, moreNum2).removeClass('is-hidden').show();

            if ($(this).prev().children(".is-hidden").length == 0) {
              $(this).fadeOut();
            }
          });
        });
      });
    },

    _checkBreakPoint = function () {
      /* タブ切り替え */
      let tabs = document.querySelectorAll(".tab__item");
      tabs.forEach((tab) => {
        tab.addEventListener("click",()=> {

          const targetTabParent = tab.parentElement;
          const targetTabs = targetTabParent.getElementsByClassName("tab__item");
          const targetTabIndex = [].slice.call(targetTabs).indexOf(tab);

          // ターゲットのタブグループのactiveを付け替え
          for(let elem of targetTabs){
            elem.classList.remove("active");
          }
          tab.classList.add("active");

          // ターゲットのタブコンテンツのactiveを付け替え
          const tabContent = targetTabParent.nextElementSibling.getElementsByClassName("flex__content");
          for(let elem of tabContent){
            elem.classList.remove("active");
          }
          tabContent[targetTabIndex].classList.add("active");
        }, false);
      });
    };

    // public
    _func = {
      acodContentsnav: _acodContentsnav,
      acodContents01: _acodContents01,
      acodContents02: _acodContents02,
      acodSidenav: _acodSidenav,
      acodSidenav2: _acodSidenav2,
      drawer01: _drawer01,
      smoothScroll: _smoothScroll,
      faqMore: _faqMore,
      moreBtn: _moreBtn,
      scrollAccordion: _scrollAccordion,
      checkBreakPoint: _checkBreakPoint
    };
    return _func;
  }());

}(jQuery));
