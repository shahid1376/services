(function($){

	$.backToTzine = function(settings){
		
		var img = {'silver':'silver.png'}[settings.style],
			timeout;
		
		settings.contracted = {width:30};
		settings.expanded = {width:276};
		
		var a = $('<a>',{
			href	: settings.url,
			target	: 'blank',
			css		: {
				background	: "url('../assets/img/"+img+"') no-repeat",
				position	: 'fixed',
				border		: 'none',
				textDecoration	: 'none',
				width		: settings.expanded.width,
				height		: 74,
				right		: 0,
				top			: 55
			}
		}).hover(function(){
			clearTimeout(timeout);
			a.trigger('expand').css('background-position','left bottom');
		},function(){
			timeout = setTimeout(function(){
				a.trigger('contract');
			},1500);
			a.css('background-position','left top');
		}).bind('expand',function(){
			a.stop().animate(settings.expanded);
		}).bind('contract',function(){
			a.stop().animate(settings.contracted);
		}).appendTo(document.body);
		
		setTimeout(function(){
			a.trigger('mouseleave');
		},1000);
	}

	
})(jQuery);

