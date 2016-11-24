var $ = jQuery.noConflict(), _ww , _wh , _cw , _tw, post_slider ;
var Blank = {
	home_content : function(){
		_ww = jQuery(window).width();
		_cw = jQuery('.container').outerWidth();		
		var space_left_right = _ww - _cw;
		console.log(space_left_right);
		var pad_right = Math.round(space_left_right/2);
		jQuery('.cont-right-space').css({"padding-right":pad_right});
		jQuery('.cont-left-space').css({"padding-left":pad_right});
		//below is perfect match with padding added
		jQuery('.cont-right-per-space').css({"padding-right":pad_right+100});
		jQuery('.cont-left-per-space').css({"padding-left":pad_right+100});		
	},
	title_wrd_brk : function(){
		var $elem = $('.featured .title');
		$elem.html($elem.text().replace(' ','<br/>'));
	},
	title_pos_page: function(){
		 _tw = jQuery('.page-default .title').width();
		 if(_tw > 300 ){
			_tw = jQuery('.page-default .title').width() - 100; 
		 }
		 else{
			  _tw = jQuery('.page-default .title').width() - 65;
		 }
		 jQuery('.page-default .title').css({"left":'-' + _tw + 'px'});
	},
	
	post_slide : function(post){
		post_slider = jQuery(post);
		post_slider.owlCarousel({
			margin:10,
			loop:true,
			autoWidth:true,
			center:true
		});
		// Custom Navigation Events
		jQuery(".post-next-slide").click(function(){
		post_slider.trigger('next.owl.carousel');
		})
		jQuery(".post-prev-slide").click(function(){
		post_slider.trigger('prev.owl.carousel');
		});	
	},
	
	masonry_grid : function(){
		if(jQuery('.blog-page').length){
			 jQuery('.grid').masonry({
			   /*itemSelector: '.grid-item--width1',*/
			   columnWidth: '.grid-sizer',
			   percentPosition: true
			});
		}		
	},
	
	woo_quantity : function(){
	 // Quantity buttons
		$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<i class="fa fa-angle-right plus" aria-hidden="true"></i>' ).prepend( '<i class="fa fa-angle-left minus" aria-hidden="true"></i>' );

		// Target quantity inputs on product pages
		$( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
			var min = parseFloat( $( this ).attr( 'min' ) );

			if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
				$( this ).val( min );
			}
		});

		$( document ).on( 'click', '.plus, .minus', function() {

			// Get values
			var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
				currentVal	= parseFloat( $qty.val() ),
				max			= parseFloat( $qty.attr( 'max' ) ),
				min			= parseFloat( $qty.attr( 'min' ) ),
				step		= $qty.attr( 'step' );

			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
			if ( max === '' || max === 'NaN' ) max = '';
			if ( min === '' || min === 'NaN' ) min = 0;
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

			// Change the value
			if ( $( this ).is( '.plus' ) ) {

				if ( max && ( max == currentVal || currentVal > max ) ) {
					$qty.val( max );
				} else {
					$qty.val( currentVal + parseFloat( step ) );
				}

			} else {

				if ( min && ( min == currentVal || currentVal < min ) ) {
					$qty.val( min );
				} else if ( currentVal > 0 ) {
					$qty.val( currentVal - parseFloat( step ) );
				}

			}

			// Trigger change event
			$qty.trigger( 'change' );
		});

		/* end add quanitity button */
		var calc_shipping_dropdown = $('.woocommerce table.shop_table.shipping p select');
		if($.isFunction(calc_shipping_dropdown.select2)) {
			calc_shipping_dropdown.select2();
		}		
	},
	
load_more: function(){
			if($("ul.page-numbers").length){
				var pg_num = 2;
				var num_of_pg = $("ul.page-numbers").children().length;
				$('#more_posts').on('click', function() { 
					var page  = window.location.href;  
					var inc_pg_num = pg_num++;
					if(inc_pg_num < num_of_pg) {
						var url   =   page+'page/'+inc_pg_num+'/';

						$.ajax({
							url: url ,
							type: 'post',
							beforeSend: function(){
							$('.loader_product').css({"display":"block"}); 
							},
							success: function(data){
							$('.products').append($(data).find('.products').html());
							//$('html, body').animate({scrollTop: $('#more_posts').offset().top - 50}, 1000);
							$('.loader_product').css({"display":"none"}); 
							},
							complete: function(){

							}
						});
					}   
					else{
					$('#more_posts').hide();
					$('.no_more').show(); 
					} 
				});
			}

			else{

			$('#more_posts').hide();
			}
		}, 	
		
	home_post_link_pos : function(){
		$('.home .home-post').each(function(){
			var side_h = $(this).find('img').height();
			$(this).find('.rm-pad').css({"height":side_h});
		});
	}
}


jQuery(window).on("load resize", function(){

	Blank.home_content();
	Blank.title_pos_page();
	Blank.post_slide('.post-slider');
	Blank.masonry_grid();

	
});

jQuery(window).on("load", function(){
	Blank.home_post_link_pos();
});

jQuery(document).ready(function(){
	if(jQuery('.banner').length){
	jQuery('.banner').flexslider({
	animation: "slide",
	controlNav: false,
	directionNav: true,
	slideshowSpeed: 3000,
	animationSpeed: 600,
	touch: true,
	start: function(slider) {
				jQuery('#sliderNext').on('click', function(e){
					jQuery('.flex-next').trigger('click');
				});
				jQuery('#sliderPrev').on('click', function(e){
					jQuery('.flex-prev').trigger('click');
				});	
				jQuery('.total-slides').text(slider.count);
			  },
			  after: function(slider) {
				jQuery('.current-slide').text(slider.currentSlide+1);
			 }
	});
}


if(jQuery('.instagram-wrapper').length){
	
	var userFeed = new Instafeed({
		get: 'user',
		limit:30,
		userId: '2285661877',
		accessToken: '2285661877.0fe4f3d.bf0b644e3e494bd5b0bf4ccc8ebac9d2',
		resolution: 'low_resolution',
		after: function () {
			var owl = jQuery(".owl2row-plugin");
			owl.owlCarousel({	
			responsive:{
					0:{
						items:2
					},
					480:{
						items:3
					},
					1000:{
						items: 5
					}
				}
	
			});
			// Custom Navigation Events
			jQuery(".next").click(function(){
			owl.trigger('next.owl.carousel');
			})
			jQuery(".prev").click(function(){
			owl.trigger('prev.owl.carousel');
			});
		},
	 template: '<div class="item"><a href="{{link}}" target="_blank"><span><img src="{{image}}" alt="{{caption}}"/></span></a></div>',	
	});
	userFeed.run();	
	}
	
	Blank.home_content();
	Blank.title_wrd_brk();
	Blank.title_pos_page();
	Blank.masonry_grid();
	Blank.woo_quantity();	
	Blank.load_more();
	Blank.home_post_link_pos();
	
	if(jQuery('.shop-slider').length){
		jQuery('.shop-slider').flexslider({
			animation: "slide",
			controlNav: false,
			directionNav: true,
			start: function(slider) {
				jQuery('#sliderNext').on('click', function(e){
					jQuery('.flex-next').trigger('click');
				});
				jQuery('#sliderPrev').on('click', function(e){
					jQuery('.flex-prev').trigger('click');
				});	
				jQuery('.total-slides').text(slider.count);
			  },
		});
	 }
	
});
