$(document).ready(function(){$(window).on("scroll",function(){var e=$(window).scrollTop();e>=50&&$(".featured-articles").addClass("featured-articles-animate"),e>=900&&$(".trending-articles").addClass("trending-articles-animate"),e>=1500&&$(".trending-video").addClass("trending-video-animate"),e>=2200&&$(".coming-soon").addClass("coming-soon-animate")}),$("#tab-triggers li").click(function(){var e=$(this).index();$(this).addClass("selected").siblings().removeClass("selected"),$("#tabs .tab").eq(e).removeAttr("hidden").siblings().attr("hidden","hidden")});var e=$(".content-area").height();heightSidebar=$(".sidebar").height(),heightSidebar>e&&$(".content-area").height($(".sidebar").height());var a=$(".search-trigger");a.on("click",function(){return $(".search-active").fadeIn(),$("#s").val("").focus(),!1}),$(document).on("click",function(e){var a=$(e.target);a.closest(".search-active").length||$(this).find(".search-active").fadeOut()}),$(".menu-trigger").on("click",function(){$(".nav").toggleClass("nav-active"),$(this).closest(".navbar-default").toggleClass("navbar-default-active")})});