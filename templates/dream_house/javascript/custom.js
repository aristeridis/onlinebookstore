jQuerOs(document).ready(function () {

  //if (jQuerOs("[rel=tooltip]").length) {jQuerOs("[rel=tooltip]").tooltip();}
 // jQuerOs('button').addClass('btn');
// ____________________________________________________________________________________________ resize display

        // var myWidth = 0;
        // myWidth = window.innerWidth;
        // jQuerOs('body').prepend('<div id="size" style="background:#000;padding:5px;position:fixed;z-index:999;color:#fff;">Width = '+myWidth+'</div>');
        // jQuerOs(window).resize(function(){
        //     var myWidth = 0;
        //     myWidth = window.innerWidth;
        //     jQuerOs('#size').remove();
        //     jQuerOs('body').prepend('<div id="size" style="background:#000;padding:5px;position:fixed;z-index:999;color:#fff;">Width = '+myWidth+'</div>');
        // });

// ____________________________________________________________________________________________ responsive menu

jQuerOs('.main_menu .navbar-toggle').on('click', function () {
          if (jQuerOs('.main_menu .collapse').hasClass('menu_active')) {
              jQuerOs(".main_menu .collapse").addClass("menu_in_active");
              jQuerOs(".main_menu .collapse").removeClass("menu_active");
          } else {
              jQuerOs(".main_menu .collapse").removeClass("menu_in_active");
              jQuerOs(".main_menu .collapse").addClass("menu_active");
          }
      });

jQuerOs('.footer_menu .navbar-toggle').on('click', function () {
          if (jQuerOs('.footer_menu .collapse').hasClass('menu_active')) {
              jQuerOs(".footer_menu .collapse").addClass("menu_in_active");
              jQuerOs(".footer_menu .collapse").removeClass("menu_active");
          } else {
              jQuerOs(".footer_menu .collapse").removeClass("menu_in_active");
              jQuerOs(".footer_menu .collapse").addClass("menu_active");
          }
      });





	var mainMenu = jQuerOs('.main_menu ul.nav');
  mainMenu.find('li.parent > a,li.parent > .mod-menu__heading ').append('<span class="arrow"></span>');
  mainMenu.find(' > li').last().addClass('lastChild');
// ____________________________________________________________________________________________

 });