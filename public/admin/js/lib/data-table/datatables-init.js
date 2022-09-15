(function ($) {
    //    "use strict";


    /*  Data Table
    -------------*/

 	// $('#bootstrap-data-table').DataTable();


    $('#bootstrap-data-table').DataTable({
        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
    });



    $('#bootstrap-data-table-export').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
	
	$('#row-select').DataTable( {
		processing: true,
		serverSide: true,
		ajax: "products/show",
		columns: [{
				data: 'DT_RowIndex',
				'orderable': false,
				'searchable': false
			},
			{
				data: 'id',
				name: 'id'
			},
			{
				data: 'name',
				name: 'name'
			},
			{
				data: 'category',
				name: 'category'
			},
			{
				data: 'quantity',
				name: 'quantity'
			},
			{
				data: 'price',
				name: 'price'
			},
			{
				data: 'seller_id',
				name: 'seller_id'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false,
				searchable: false
			},
		],
		initComplete: function () {
			this.api().columns().every( function () {
				var column = this;
				var select = $('<select class="form-control"><option value=""></option></select>')
					.appendTo( $(column.footer()).empty() )
					.on( 'change', function () {
						var val = $.fn.dataTable.util.escapeRegex(
							$(this).val()
						);
	
						column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
					} );
	
				column.data().unique().sort().each( function ( d, j ) {
					select.append( '<option value="'+d+'">'+d+'</option>' )
				} );
			} );
		}
	} );






})(jQuery);