(function ($) {
	$(document).ready(function() {
		$("#industry_experience").multiselect({
    	noneSelectedText: 'Industry Experience', 
    	classes: 'industry_experience_multiselect',
    	/*header: 'Choose options below'*/}).multiselectfilter();
		$("#areas_of_expertise").multiselect({
		noneSelectedText: 'Areas of Expertise', 
		classes: 'areas_of_expertise_multiselect',
		/*header: 'Choose options below'*/}).multiselectfilter();
	var filterbutton = $('#submit-filter-options');
	var industry_experience_checkAllButton = $('.industry_experience_multiselect .ui-multiselect-all');
	var industry_experience_checkNoneButton = $('.industry_experience_multiselect .ui-multiselect-none');
	var areas_of_expertise_checkAllButton = $('.areas_of_expertise_multiselect .ui-multiselect-all');
	var areas_of_expertise_checkNoneButton = $('.areas_of_expertise_multiselect .ui-multiselect-none');

	industry_experience_checkAllButton.click(function(){
		$("#industry_experience").multiselect("checkAll");
	});
	industry_experience_checkNoneButton.click(function(){
		$("#industry_experience").multiselect("uncheckAll");
	});

	areas_of_expertise_checkAllButton.click(function(){
		$("#areas_of_expertise").multiselect("checkAll");
	});
	areas_of_expertise_checkNoneButton.click(function(){
		$("#areas_of_expertise").multiselect("uncheckAll");
	});


	var values = $('#industry_experience').val();
	var array_of_checked_values = $("#industry_experience").multiselect("getChecked").map(function(){
   		return this.value;    
	}).get();

	// filterbutton.click(function() {
	// 	var industry_experience_checked = $("#industry_experience").multiselect("getChecked");
	// 	var areas_of_expertise_checked = $("#areas_of_expertise").multiselect("getChecked");
	// 	var allChecked = [];
	// 	for(var i = 0; i < industry_experience_checked.length; i++){
	// 		allChecked.push(industry_experience_checked[i].value);
	// 	}
	// 	for(var i= 0; i < areas_of_expertise_checked.length ; i++){
	// 		allChecked.push(areas_of_expertise_checked[i].value);
	// 	}
	// 	var checked_array = allChecked;
	// 	alert(checked_array);
	// })
	})
   
}(jQuery));


