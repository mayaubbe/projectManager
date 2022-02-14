
	<script type= 'text/javascript'>
		$(document).ready(function () {			
			$('#project-grid').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo site_url('project/get_projects') ?>",
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
		<table id="project-grid" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="margin: auto;">
			<thead>
				<tr>
					<th>S NO</th>
					<th>Project Name</th>
					<th>Status</th>
					
				</tr>
			</thead>
		</table>
	