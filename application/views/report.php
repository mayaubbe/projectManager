<style>		
	/*table  */
table.dataTable > tbody > tr.child ul.dtr-details {
    display: inline-block;
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%;
}
</style>
<script type= 'text/javascript'>
// data table
    $(document).ready(function () {			
        $('#report-grid').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url('report/get_report') ?>",
            "columns": [
                {
            "className":      'dt-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": ''
        },
        { "data": "id_project" },
        { "data": "project_name" },
        { "data": "hours" },
        { "data": "task" },
    
        ],

    responsive: {
        details: {
            type: 'column',
            target: 'tr'
        }
    },
    columnDefs: [ {
        className: 'control',
        orderable: false,
        targets:   0
    } ,
    {
        targets: 'no-sort', 
        orderable: false 
    },
    ],
    
            
        });
        
    
    });

</script>
	
	<p id='err'/>
	<table id="report-grid" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="99%" style="margin: auto;">
		<thead>
			<tr>
            <th></th>
				<th class="no-sort">S No</th>
				<th class="no-sort">Name</th>
				<th class="no-sort">Total Hours</th>
                <th> </th>
                <th> </th>
			</tr>
		</thead>
	</table>
	
	