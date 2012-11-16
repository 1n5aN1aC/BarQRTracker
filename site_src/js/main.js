$(document).ready(function () {
	$('.edit').editable('/class/inc/save.php');
	
	$('#search').keyup(function(){
      var searchField = $('#search').val();
      if (searchField !== "") {
        $('#results').load('includes/live_search.php?s=' + searchField).fadeIn('slow'); }
	  else{$('#results').fadeOut('slow');}
	});
});