<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" ></script>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered customx table-hover display nowrap" id="tblDetilMonitor" style="width:100%">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Nama AM</th>
								<th scope="col">No Order</th>
								<th scope="col">Service ID</th>
								<th scope="col">Type Order</th>
								<th scope="col">Customer Name</th>
								<th scope="col">Account Name</th>
								<th scope="col">Product Name</th>
								<th scope="col">Milestone</th>
								<th scope="col">Status</th>
								<th scope="col">Order Status</th>
								<th scope="col">Biaya OTC</th>
								<th scope="col">Biaya MRC</th>
								<th scope="col">Keterangan Doc</th>
							</tr>
						</thead>

						<tbody>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#tblDetilMonitor1').DataTable();


		$.fn.dataTableExt.oApi.fnPagingInfo = function (a) {
			return {
				iStart: a._iDisplayStart,
				iEnd: a.fnDisplayEnd(),
				iLength: a._iDisplayLength,
				iTotal: a.fnRecordsTotal(),
				iFilteredTotal: a.fnRecordsDisplay(),
				iPage: Math.ceil(a._iDisplayStart / a._iDisplayLength),
				iTotalPages: Math.ceil(a.fnRecordsDisplay() / a._iDisplayLength),
			};
		};
		var table = $("#tblDetilMonitor").dataTable({
			initComplete: function() {
				var api = this.api();
				$("#tblDetilMonitor input")
				.off(".DT")
				.on("input.DT", function() {
					api.search(this.value).draw();
				});
			},
			oLanguage: {
				sProcessing: "loading...",
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: '<?php echo base_url('Monitoring/get_all_data') ?>',
				type: "POST",
				data: function(data) {
					data.am_id = '<?php echo $this->uri->segment(3) ?>';
					data.status = '<?php echo $this->uri->segment(4) ?>';
				}
			},
			columns: [
			{
				data: "No",
				searchable: true,
				orderable: false
			},
			{
				data: "nama_am",
				searchable: true,
				orderable: false,
			},
			{
				data: "no_order",
				searchable: false,
				orderable: false,
			},
			{
				data: "service_id",
				searchable: false,
				orderable: false,
			},
			{
				data: "type_order",
				searchable: false,
				orderable: false,
			},
			{
				data: "constumer_name",
				searchable: false,
				orderable: false,
			},
			{
				data: "acount_name",
				searchable: false,
				orderable: false,
			},
			{
				data: "product_name",
				searchable: false,
				orderable: false,
			},
			{
				data: "milestone",
				searchable: false,
				orderable: false,
			},
			{
				data: "status",
				searchable: false,
				orderable: false,
			},
			{
				data: "status_order",
				searchable: false,
				orderable: false,
			},
			{
				data: "biaya_otc",
				searchable: false,
				orderable: false,
			},
			{
				data: "biaya_mrc",
				searchable: false,
				orderable: false,
			},
			{
				data: "ket_doc",
				searchable: false,
				orderable: false,
			},
			],
			order: [
			[0, "ASC"]
			],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
                //$('td:eq(0)', row).html(index);
                //$(row).attr('id','Lihat');
                //$(row).attr('data',data.ID);
                //$(row).css('cursor','pointer');
            },
            initComplete: function () {
            	$('[data-popup="tooltip"]').tooltip();
            },
        });
	} );
</script>
