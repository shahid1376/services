$(document).ready(function(){
	
	var config = {
		siteURL		: '',	// Change this to your site
		searchSite	: true,
		type		: 'web',
		append		: false,
		perPage		: 8,			// A maximum of 8 is allowed by Google
		page		: 0				// The start page
	}
	
	// The small arrow that marks the active search icon:
	var arrow = $('<span>',{className:'arrow'}).appendTo('ul.icons');
	
	$('ul.icons li').click(function(){
		var el = $(this);
		
		if(el.hasClass('active')){
			// The icon is already active, exit
			return false;
		}
		
		el.siblings().removeClass('active');
		el.addClass('active');
		
		// Move the arrow below this icon
		arrow.stop().animate({
			left		: el.position().left,
			marginLeft	: (el.width()/2)-4
		});
		
		// Set the search type
		config.type = el.attr('data-searchType');
		$('#more').fadeOut();
	});
	
	// Adding the site domain as a label for the first radio button:
	$('#siteNameLabel').append(' '+config.siteURL);
	
	// Marking the Search tutorialzine.com radio as active:
	$('#searchSite').click();	
	
	// Marking the web search icon as active:
	$('li.web').click();
	
	// Focusing the input text box:
	$('#s').focus();

	$('#searchForm').submit(function(){
		//googleSearch();
		return true;
	});
	
	$('#searchSite,#searchWeb').change(function(){
		// Listening for a click on one of the radio buttons.
		// config.searchSite is either true or false.
		
		config.searchSite = this.id == 'searchSite';
	});
	
	
    if($('#ischeck').val() == 1)
    {
    
        $('.radio-button').prop('checked', false);      
        $('#searchWeb').prop('checked', true);      
    }
    else if($('#ischeck').val() == 2)
    {
    
        $('.radio-button').prop('checked', false); 
         $('#searchSite').prop('checked', true); 
    }
    else 
    {
      $('#searchSite').prop('checked', true);  
    }
    
     
    
    
	
});
