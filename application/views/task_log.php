
<script type= 'text/javascript'>
$(document).ready(function () {			
	$('#tasklog-grid').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo site_url('taskLog/get_task_logs') ?>",
		columnDefs: [
			{
				targets: 'no-sort', 
				orderable: false 
			}
		]
	});

	$("#add").submit(function (event) {
		event.preventDefault();
		var formData = $('#add').serialize();

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('taskLog/add_task_log') ?>",
			data: formData,
			dataType: "json",
			encode: true,
			}).done(function (data) {
				if (!data.success) {
					if (data.errors.message) {
					$('#addNew').attr('disabled',false);

					$("#msgAdd").html( "<span style='color: red'>Error adding a new product"+data.errors.message+"</span>" );
					}


				} 
				else {
					$('#addNew').attr('disabled',false);
					$("#msgAdd").html( "<span style='color: green'>Product added successfully</span>" );
					$('#tasklog-grid').DataTable().draw();;
					document.getElementById("add").reset(); 
				}
		});


	});

});
</script>
	
	<style>		
		/* modal window */
		.modal p { margin: 1em 0; }
		
		.add_form.modal {
		  border-radius: 0;
		  line-height: 18px;
		  padding: 0;
		  font-family: "Lucida Grande", Verdana, sans-serif;
		}
		.add_form h3 {
		  margin: 0;
		  padding: 10px;
		  color: #fff;
		  font-size: 14px;
		  background: -moz-linear-gradient(top, #2e5764, #1e3d47);
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
		}
		.add_form.modal p { padding: 20px 30px; border-bottom: 1px solid #ddd; margin: 0;
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #eee),color-stop(1, #fff));
		  overflow: hidden;
		}
		.add_form.modal p:last-child { border: none; }
		.add_form.modal p label { float: left; font-weight: bold; color: #333; font-size: 13px; width: 110px; line-height: 22px; }
		.add_form.modal p input[type="text"],
		.add_form.modal p input[type="submit"]		{
		  font: normal 12px/18px "Lucida Grande", Verdana;
		  padding: 3px;
		  border: 1px solid #ddd;
		  width: 200px;
		}
		
		#msgAdd {
		  margin: 10px;
		  padding: 30px;
		  color: #fff;
		  font-size: 18px;
		  font-weight: bold;
		  background: -moz-linear-gradient(top, #2e5764, #1e3d47);
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
		}
	</style>
</head>
<body>
	<p id='err'/>
	<p><a class='btn' href="#add" rel="modal:open">Add Time Entry</a></p>
	<table id="tasklog-grid" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="99%" style="margin: auto;">
		<thead>
			<tr>
				<th>S No</th>
				<th>Description</th>
				<th>Task</th>
				<th>Hours</th>
				<th>Date</th>
			</tr>
		</thead>
	</table>
	
	<form id="add" action="#" class="add_form modal" style="display:none;">
		<div id='msgAdd'/>
		<h3>Add Time entry</h3>
		<p>
			<label>Description</label>
			<textarea required name="description"></textarea>
		</p>
		<p>
			<label>Task</label>
			<select required name="task_id">
			<?php 
			foreach($tasks as $task){
			?>
			<option value="<?php echo $task['id_task']?>"><?php echo $task['task_name']?></option>
			<?php
			}
			 ?>
			 </select>
		</p>
		<p>
			<label>Hours</label>
			<input required type="number" value="1" name="hours">
		</p>
		
		<p>
			<input type="submit" id="addNew" value="Submit">
		</p>
	</form>
