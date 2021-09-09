jQuery( document ).ready(function($) {
$('#new_vehicle').slick({
dots: false,
arrows: true,
infinite: true,
speed: 2000,
slidesToShow: 3,
loop: true,
slidesToScroll: 1,
autoplay: false,
autoplaySpeed: 2000,
pauseOnHover: false,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 3,
speed: 1000,
slidesToScroll: 1,
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 2,
speed: 1000,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1
}
}
]
});
});
/*Back to top*/
var btn = $("#button");

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    btn.addClass("show");
  } else {
    btn.removeClass("show");
  }
});

btn.on("click", function (e) {
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "300");
});
/*Back to top*/

/*Team*/
jQuery( document ).ready(function($) {
$('#team').slick({
dots: false,
arrows: true,
infinite: true,
speed: 2000,
slidesToShow: 4,
loop: true,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 4000,
pauseOnHover: true,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1,
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1
}
}
]
});
});
/*Team*/
/*Testimonials*/
jQuery( document ).ready(function($) {
$('#client').slick({
dots: true,
arrows: false,
infinite: true,
speed: 2000,
slidesToShow: 2,
loop: true,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 4000,
pauseOnHover: true,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1,
}
},
{
breakpoint: 600,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1
}
},
{
breakpoint: 480,
settings: {
slidesToShow: 1,
speed: 1000,
slidesToScroll: 1
}
}
]
});
});
/*Testimonials*/


/*Video pOpup*/
// Function to reveal lightbox and adding YouTube autoplay
function revealVideo(div, video_id) {
  var video = document.getElementById(video_id).src;
  document.getElementById(video_id).src = video + "&autoplay=1"; // adding autoplay to the URL
  document.getElementById(div).style.display = "block";
}

// Hiding the lightbox and removing YouTube autoplay
function hideVideo(div, video_id) {
  var video = document.getElementById(video_id).src;
  var cleaned = video.replace("&autoplay=1", ""); // removing autoplay form url
  document.getElementById(video_id).src = cleaned;
  document.getElementById(div).style.display = "none";
}

/*Video pOpup*/