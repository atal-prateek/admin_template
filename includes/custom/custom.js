// JavaScript Document
$(document).ready(function(e) {
	$('#loading').fadeOut();
    setTimeout(function() {
		$('.msg-popup').fadeOut();
	},5000);
});

function createDataTable(){
	var table=$('.data-table').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search"
		},
	});
	new $.fn.dataTable.FixedHeader( table );
}