'use strict';

$(function(){
  $.getJSON('/brand-tokei/wp-content/themes/otakaraya/assets/js/shopSearch_city.json',function(data){
    for(var i=1;i<48;i++){
      var code=('00'+i).slice(-2);$('#shopSearch__select--pref').append('<option value="'+code+'">'+data[i-1][code].pref+'</option>')
    }
  })
});
$('#shopSearch__select--pref').on('change',function(){
  $('#shopSearch__select--city option:nth-child(n+2)').remove();
  var select_pref=('00'+$('#shopSearch__select--pref option:selected').val()).slice(-2);
  var key=Number(select_pref)-1;
  $.getJSON('/brand-tokei/wp-content/themes/otakaraya/assets/js/shopSearch_city.json',function(data){
    for(var i=0;i<data[key][select_pref].city.length;i++){
      $('#shopSearch__select--city').append('<option value="'+data[key][select_pref].city[i].id+'">'+data[key][select_pref].city[i].name+'</option>')
    }
  })
});

$(function(){
  $('#shopSearch__select--pref').change(function() {
    $('#shopSearch__select--city').prop( 'disabled', false );
  });
  $( '#shopSearch__select--city' ).prop( 'disabled', true );
  $('#shopSearch__select--pref').on('change', function(){
    const selected = $('#shopSearch__select--pref').val();
    if( selected !== '' ){
      $('#shopSearch__select--city').prop('disabled', false);
      $('.shopSearch__select--city').addClass('visble');
    } else {
      $('#shopSearch__select--city').prop('disabled', true);
      $('.shopSearch__select--city').removeClass('visble');
    }
  });
});

//検索ボタンクリックでスクロール
$(function(){
  var selectPref = $('#shopSearch__select--pref');
  var selectCity = $('#shopSearch__select--city');
  var search = $('#serch_btn');

  selectPref.on('change', function(){
      var prefId = $(this).children(':selected').val();
      search.attr('href', '#' + prefId );
  });
  selectCity.on('change', function(){
    var cityId = $(this).children(':selected').val();
    search.attr('href', '#' + cityId );
  });
  search.on('click',function(){
    var cityId = $(selectCity).children(':selected').val();
    $('#' + cityId).children(".acod__switch").toggleClass("open");
    $('#' + cityId).children(".acod__switch").next('.acod__contents').slideToggle();
  });
});


