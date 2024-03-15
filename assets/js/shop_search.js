// $("select[name='jobs_area'], input[name='jobs_skill[]']").change(function () {
jQuery(document).ready(function($) {
// $('#shop_sch_btn').on('click',function(){
//     alert("click!");
// });


$('#shop_sch_btn').on("click", function(){
    // alert("click!");
    // dispLoading();
console.log('click');
  // let jobs_skill = [];
  // $("[name='jobs_skill[]']:checked").each(function () {
  //   jobs_skill.push(this.value);
  // });
console.log($('[name=shop_pref]').val());
console.log($('[name=shop_city]').val());

  $.ajax({
    type: 'GET',
    url: ad_url.ajax_url,
    data: {
      'action': 'my_action',
      'shop_pref': $('[name=shop_pref]').val(),
      'shop_city': $('[name=shop_city]').val(),
      // 'jobs_skill': jobs_skill,
      'nonce': ad_url.nonce}
	}).done(function(data){
      console.log(data);
      console.log("done...");
      console.log("done...");
      console.log("done...");
      console.log("done...");
      console.log("done...");
      console.log("done...");
      console.log("done...");
      $('#search-result').html(data);
    }).fail(function(XMLHttpRequest, textStatus, error){
          console.log(error);
          console.log(XMLHttpRequest.responseText);
    });





//     success: function (response) {
// console.log('ok');
// // console.log(response);
//       $('#search-result').html(response);

// console.log('res');
//     },
//     error: function () {
// console.log('ng');
//         alert("読み込み失敗");
//     }
//   })
//     // 処理終了時
//     .always(function (response) {
//       removeLoading();
//     });

//   return false;
})
});













/* ------------------------------
 Loading
 ------------------------------ */
function dispLoading(msg) {
  if (msg == undefined) {
    msg = "";
  }
  var dispMsg = "<div class='loadingMsg'>" + msg + "</div>";
  if ($("#loading").length == 0) {
    $("body").append("<div id='loading'>" + dispMsg + "</div>");
  }
}

function removeLoading() {
  $("#loading").fadeOut('fast').queue(function() {
    $("#loading").remove();
  })
}