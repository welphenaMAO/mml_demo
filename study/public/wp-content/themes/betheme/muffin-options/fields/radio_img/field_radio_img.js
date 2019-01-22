jQuery(document).ready(function($){
	
	jQuery('.mfn-radio-images').click(function(e){
		
		var el 			= $(this);
		var fieldset 	= $(this).closest('fieldset');
		
		fieldset.find('.mfn-radio-images').removeClass('mfn-radio-images-selected');
		el.addClass('mfn-radio-images-selected');
		
		el.find('input[type="radio"]').attr('checked','checked');

	});
	
});