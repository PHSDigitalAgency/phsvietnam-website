// jQuery.noConflict();
(function($){

	/*
	 * Helper function. Return numeric value of css property
	 */
	$.fn.numericCss = function($prop){
		return parseFloat($(this).css($prop).replace(/[^-\d\.]/g, ''));
	}

	$.urlParam = function(url, key){
		var result = new RegExp(key + "=([^&]*)", "i").exec(url);
		return result && unescape(result[1]) || "";
	}

	var padTop = 100,
		collapsibleTimer = 0;	

	function initMagnificPopup(){
		$('.grid-list-mpu .panel .row a.image-link.mpu-ignore').click(function(e){
			$(e.currentTarget).next().click(); //trigger('click');
			e.stopPropagation();
			e.stopImmediatePropagation();
			e.preventDefault();
		});

		$('.grid-list-mpu').magnificPopup({
			delegate: '.panel .row a.image-link:not(.mpu-ignore)',
			type: 'image',
			tLoading: ss.i18n._t('MAIN.tLoading', 'Loading'),
			// mainClass: 'mfp-with-zoom',
			mainClass: 'mfp-fade',
			// removalDelay: 300,
			gallery: {
				tPrev: ss.i18n._t('MAIN.tPrev', 'Previous'),
				tNext: ss.i18n._t('MAIN.tNext', 'Next'),
				tCounter: ss.i18n._t('MAIN.tCounter', ' of '),
				enabled: true,
				navigateByImgClick: true,
				preload: [0,2]
			},
			overflowY: 'hidden',
			image: {
				tError: ss.i18n._t('MAIN.tError', 'Error'),
				tError: 'ERROR',
				titleSrc: function(item) {
					var title = '<h4>' + item.el.attr('title') + '</h4>',
						description = item.el.parent().next().next('div').children('.content-collapse').html();
					title += description ? '<div class="mfp-description">' + description + '</div>' : '';
					return title;
				}
			},
			iframe: {
				markup: '<div class="mfp-iframe-scaler">'+
							'<div class="mfp-close"></div>'+
							'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" scrolling="no" allowfullscreen></iframe>'+
						'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com',
						id: function(url){
							var urlYt = $.urlParam(url,'v') + "?autoplay=1",
								list = $.urlParam(url,'list');
							list = list ? '&list=' + list : '';

							return(urlYt + list);
						},
						src: '//www.youtube.com/embed/%id%'
					},
					kickstarter: {
						index: 'kickstarter.com',
						id: 'v=',
						src: '//www.kickstarter.com/projects/%id%/widget/video.html'
					}
				}
			}

			/*,
			zoom: {
				enabled: true,
				duration: 300,
				easing: 'ease-in-out',
				opener: function(openerElement) {
					var ele = openerElement;
					while(ele.css('display') == 'none' || ele.css('visibility') == 'hidden') ele = ele.prev('.image-link');
					return ele;
				}
			}*/
		});
	}

	function initScripts(){
		var	cl = $("#content").data('classname');
/*		console.log(cl, $('body').attr('class'));
		if(cl == "HomePage"){ // We are arriving on the HomePage
			$(".core-container").animate({"padding-top": padTop}, 300);
		}else*/
		if(cl == "ProjectHolder"){ // Portfolio page
			initMagnificPopup();
			// $('#carousel').carousel();
		}else if(cl == "ContactPage"){ // Contact page
			$.validate({
		        language : {
		            errorTitle : ss.i18n._t('MAIN.errorTitle', 'Form submission failed!'),
		            requiredFields : ss.i18n._t('MAIN.requiredFields', 'You have not answered all required fields'),
		            badEmail : ss.i18n._t('MAIN.badEmail', 'You have not given a correct e-mail address'),
		        }
			});
		}
	}

	$(document).ready(function(){
		initScripts();
		
		/*
		 * Collapsible elements
		 */
		$('#content').on('mouseover mouseleave', '.link-collapse', function(e){
			if(e.type == 'mouseover' && $(this).next('div.item-collapse').hasClass('collapse')){
				var ele = $(this);
				clearTimeout(collapsibleTimer);
				collapsibleTimer = setTimeout(function(){ ele.trigger('click') }, 300);
			}else if(e.type == 'mouseleave'){
				clearTimeout(collapsibleTimer);
			}
			e.preventDefault();
		}).on('mouseover mouseleave', '.image-link', function(e){
			if(e.type == 'mouseover' && $(this).parent().next().next('div.item-collapse').hasClass('collapse')){
				var ele = $(this).parent().next();
				clearTimeout(collapsibleTimer);
				collapsibleTimer = setTimeout(function(){ ele.trigger('click') }, 300);
			}else if(e.type == 'mouseleave'){
				clearTimeout(collapsibleTimer);
			}
			e.preventDefault();
		});
	});

	$(window).on('loadingstate', function(){
		var pb = $(document).outerHeight() - $('.container:first-child').height();

		if($("#content").data('classname') == "HomePage"){ // we are going from the HomePage
			pb = $(document).outerHeight() - $('#footer').numericCss('paddingTop');

			// $(".core-container").animate({'paddingTop': 0}, 300);

			// $("#footer").animate({'paddingBottom': pb }, 300);
		}

		$("#footer").animate({'paddingBottom': pb }, 300);

	}).on('statechangecomplete', function(){
		initScripts();
		
/*		if($("body").hasClass('HomePage')){
			$("#footer").animate({'paddingBottom': 0 }, 300);
		}
*/
		$("#footer").css('paddingBottom', $('#content').innerHeight()).animate({'paddingBottom': 0 }, 300);

		$('body').removeClass().addClass($("#content").data('classname'));
	});



}(jQuery));