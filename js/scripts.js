$(document).ready(function () {
	$(window).on('scroll', function () {
		var scrTop = $(window).scrollTop();
		
		if (scrTop >= 500) {
			$('.trending-articles').addClass('trending-articles-animate');
		};
		if (scrTop >= 1100) {
			$('.trending-video').addClass('trending-video-animate');
		};
		if (scrTop >= 1800) {
			$('.coming-soon').addClass('coming-soon-animate');
		};
	});

	//Sidebar tabs 
	$('#tab-triggers li').click(function(){
		var tab = $(this).index();
		$(this).addClass('selected').siblings().removeClass('selected');
		$('#tabs .tab').eq(tab).removeAttr('hidden').siblings().attr('hidden', 'hidden');
	});

	//Dinamic height of aside menu
	var heightContent = $('.content-area').height();
		heightSidebar = $('.sidebar').height();
		if (heightContent < heightSidebar) {
			$('.content-area').height($('.sidebar').height());
		};
		console.log(heightContent);

	//Dinamic height of sidebar elements
	var postTitle = $('.sidebar .post-thumbnail').height();
	$('.sidebar .post-title').height(postTitle);
		console.log(postTitle);
	//Search 
	var $searchTrigger = $('.search-trigger');
	$searchTrigger.on('click', function() {
		$('.search-active').fadeIn();
		$('#s').val('').focus();
		return false;
	});
	$(document).on('click', function(ev) {
		var $target = $(ev.target);
		if (!$target.closest('.search-active').length) {
			$(this).find('.search-active').fadeOut();
		} 
	});

	// Close send message
		$('.wpcf7-form').on('click', '.closer', function() {
			$(this).closest('.wpcf7-mail-sent-ok').fadeOut('fast', function() {
				$(this).css('display', 'none');
			});
		});

	//tabs
    $('.tab .tabs').delegate('li:not(.active)','click',function(){
    	$(this).addClass('active').siblings().removeClass('active').parents('.tab').find('.box').hide().eq($(this).index()).fadeIn(250);
    });
    $('.tabs li:first').addClass('active');
    $('.box:first').addClass('visible');

    // Mmenu
	$("#my-menu").mmenu({
		// Options
	});
	var API = $("#my-menu").data("mmenu");

	$("#my-button").click(function() {
		API.open();
	});
     
    // NEWS Contact form  
    $('.name').on('click', function() {
		$('.question-form').toggleClass('question-form-active');
    	return false;

	});
    //------------------------------------------------------------------------//
});