<?php 
	require '../dashboard/dashboard.php';
?>

	<section class="content-header">
		<h1>
	        View Announcements
		    <small>UniversalTech</small>
		</h1>
	<!-- End of content header-->
	</section>

	<section class="content">
		<table id="tbl-announcements" class="table" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Status</th>
				</tr>
			</thead>

			<tbody>
				<?php 
					loadAnnouncements($_SESSION['user_id']);
				?>
			</tbody>
		</table>

	    <!-- view modal begin !-->
		<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">View Message</h4>
	                </div>
	                <div class="modal-body">
	                	<h2 id="modal-title"></h2>
	                    <p id="modal-msg"></p>
	                  	<div class="clearfix"></div>
	                  </div>                                      
					<div class="modal-footer">
	                    <div style="float:right">
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
	                    </div>
					</div>
				</div>
			</div>
		</div>
		<!--view modal end!-->

	<!-- End of content-->	
	</section>

<!-- End of div content wrapper-->
</div>
<!-- End of div wrapper-->
</div>
<!-- End of body-->
</body>

<script type="text/javascript">
	document.getElementById("viewAnnouncements").setAttribute("class", "active");

  $(document).ready(function(){
	  var table = $('#tbl-announcements').DataTable({
	    "responsive": true,
	    "pagingType": "full_numbers",
	    "lengthMenu": [[-1, 15, 16, 30, 31], ["All", 15, 16, 30 ,31]],
	    "order": [],
	    "columnDefs": [ {
	      "targets"  : 'no-sort',
	      "orderable": false,
	    }]
	  });

	  $('#tbl-announcements').on("click", "tr", function(){
	  	var tr = $(this).closest("tr");
	    var id = "msg_" + tr.attr('id');
	    console.log( table.row( this ).data()[1]);
	  	$("#modal-title").text(table.row( this ).data()[1]);
	  	$("#modal-msg").text(document.getElementById(id).innerHTML);
	  });
  });
</script>