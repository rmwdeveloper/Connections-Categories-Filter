(function ($) {
	$(document).ready(function() {
		var filterButton = $('#submit-filter-options');

		Array.prototype.remove = function() {
    		var what, a = arguments, L = a.length, ax;
    		while (L && this.length) {
       			what = a[--L];
        		while ((ax = this.indexOf(what)) !== -1) {
            		this.splice(ax, 1);
        		}
    		}
    		return this;
		};

		function getChecked(){
			var industry_experience_checked = $("#industry_experience").multiselect("getChecked");
			var areas_of_expertise_checked = $("#areas_of_expertise").multiselect("getChecked");
			var allChecked = [];
			for(var i = 0; i < industry_experience_checked.length; i++){
				allChecked.push(industry_experience_checked[i].value);
			}
			for(var i= 0; i < areas_of_expertise_checked.length ; i++){
				allChecked.push(areas_of_expertise_checked[i].value);
			}
			
			if(allChecked.length > 0){

				return allChecked;
			}

			return null;
		}
		function isInArray(value, array) {
  			return array.indexOf(value) > -1;
		}
		
		filterButton.click(function(){

			var checked_array = getChecked();
			var entries = $('.cn-list-row-alternate, .cn-list-row');


			var data = {
				'action': 'filter_mentors',
				'checked_array': checked_array
			};
			$.post(ajax_object.ajax_url, data, function(response){
				var slugs = response.trim().split(',');
				slugs.remove('');
				if (slugs.length === 0){
					for(var i = 0; i < entries.length; i++){
						entries[i].style.display='block';
					}
					return;
				}
				for(var i = 0; i < entries.length ; i ++){
					entry_div_id = entries[i].id;
					if (!isInArray(entry_div_id, slugs)){
						entries[i].style.display='none';
					}
					else {
						entries[i].style.display='block';
					}
				}
			});
		});
		
		
		// function filter_mentors(){

		// }
	})
   
}(jQuery));


