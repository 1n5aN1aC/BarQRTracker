$(document).ready(function () {
	$('.edit').editable('/class/inc/save.php');
	
	$('#search').keyup(function(){
      var searchField = $('#search').val();
      if (searchField !== "") {
        $('#results').load('includes/live_search.php?s=' + searchField).fadeIn('slow'); }
	  else{$('#results').fadeOut('slow');}
	});
});

function fooddetails(ID_Number) {
	removeoverlay()
	$('#fooddetails').load('includes/food_details.php?s=' + ID_Number).fadeIn('slow');
}

function editfood(ID_Number) {
	removeoverlay()
	$('#foodedit').load('includes/food_edit.php?s=' + ID_Number).fadeIn('slow');
}

function addsubmit() {
	addoverlay()
	var Server_Name = $('#Server_Name').val();
	var Asset_Tag = $('#Asset_Tag').val();
	var RT_Ticket = $('#RT_Ticket').val();
	var Location = $('#Location').val();
	var Description = $('#Description').val();
	$('#addresults').load('inc/Add.php?Server_Name=' + Server_Name + '&Asset_Tag=' + Asset_Tag + '&RT_Ticket=' + RT_Ticket + '&Location=' + Location + '&Description=' + Description).fadeIn('slow');
}

function removesubmit(Server_ID) {
	removeoverlay()
	$('#removeresults').load('inc/Remove.php?s=' + Server_ID).fadeIn('slow');
}

function addoverlay() {
	el = document.getElementById("addoverlay");
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
	document.forms['addform'].elements['Server_Name'].focus();
}

function removeoverlay() {
	el = document.getElementById("removeoverlay");
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
}