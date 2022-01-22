
$(document).ready(function () {
  $(".sidenav").sidenav();
});

$(".dropdown-trigger").dropdown()

function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

function like(id_imagen){
  $.post('./like.php', {id_imagen: id_imagen}).done(function(data) {
    res = JSON.parse(data);
    if(res.islike){
      //te gusta la imagen
      $(`#icon-like-${id_imagen}`).html('favorite');
    }else{
      //no te gusta la imagen
      $(`#icon-like-${id_imagen}`).html('favorite_border');
    }
    nlikes = JSON.parse(res.nlikes);
    $(`#n-like-${id_imagen}`).html(`${nlikes['nlikes']} likes`);
  });
}