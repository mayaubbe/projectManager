
	<script type= 'text/javascript'>
		$(document).ready(function () {			
			$('#task-grid').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url('task/get_tasks') ?>",
				columnDefs: [
					{
						targets: 'no-sort', 
						orderable: false 
					}
				]
			});
			
		
			
			
		});
	</script>

	<p id='err'/>
	<table id="task-grid" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="99%" style="margin: auto;">
		<thead>
			<tr>
				<th>Id</th>
				<th>Task Name</th>
				<th>Project name</th>
				<th>Status</th>
				
			</tr>
		</thead>
	</table>
	

