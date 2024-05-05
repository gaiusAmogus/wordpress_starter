// $(document).ready(function(){
//     //menu scroll
//     var lastScrollTop = 0;
//     var header = $("header");

//     $(window).scroll(function () {
//         var windowTop = $(window).scrollTop();
//         if (windowTop > 80 && !$('body').hasClass('menuMobileOpened') ) {
//             header.addClass("sticky");

//             if (header.hasClass('sticky')) { 
//                 if (windowTop < lastScrollTop) {
//                     header.addClass('goingUp');
//                 } else {
//                     header.removeClass('goingUp');
//                 }
//             }
//         }
//         else{
//             header.removeClass("sticky");
//         }
       
//         lastScrollTop = windowTop;
//     });
// });