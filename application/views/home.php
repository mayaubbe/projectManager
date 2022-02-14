<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Project Task Manager</title>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css"/>
	<script type= 'text/javascript' src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type= 'text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
	<script type= 'text/javascript' src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type= 'text/javascript' src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script type= 'text/javascript' src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type= 'text/javascript' src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
	<script type= 'text/javascript'>
		$(document).ready(function () {			
            $('.menu-a').on('click',function(e){
                e.preventDefault();
                $('li').removeClass('active');
                url = $(this).attr('href');
                $(this).parent('li').addClass('active');

                $.ajax({
					type: "GET",
					url: url,
                    dataType: 'json',
					cache: false,
					success: function(data) {
						$("#content").html( data.view );
					},
					error: function() {
						$("#msgAdd").html( "<span style='color: red'>Error in loading</span>" );
					}
				});

            });
			
		});
	</script>
	
	<style>		
    /*************************/
/* Styling Header */
/*************************/
header{
	
	overflow: hidden;
}

#top-header{
		
	text-align: center;
	height: 60px;
}

/****************/
/* Styling Logo */
/****************/
#logo{
	float: left;
	padding: none;
	margin: none;
	height: 60px;
	width: 30%;
}

#logo img{
	width: 60%;
	float: left;
	padding: 10px 0px;
}

/*************************/
/*    Styling  Header    */
/*************************/
header{
     
     overflow: hidden;
 }
  
 #top-header{
          
     text-align: center;
     height: 60px;
 }
  
 /****************/   
 /* Styling Logo */
 /****************/
 #logo{
     float: left;
     padding: none;
     margin: none;
     height: 60px;
     width: 30%;
 }
  
 
  
 /***************************/
 /* Styling Navigation Menu */
 /***************************/
 #menu{
     float: right;
     width: 100%;
     height: 100%;
     margin: none;
 }
      
 #menu ul{
     text-align: center;
     float: right;
     margin: none;
     background: #0074D9;
 }
      
 #menu li{
     display: inline-block;
     padding: none;
     margin: none;
 }
      
 #menu li a, #menu li span{
     display: inline-block;
     padding: 0em 1.5em;
     text-decoration: none;
     font-weight: 600;
     text-transform: uppercase;
     line-height: 60px;
 }
      
 #menu li a{
          
     color: #FFF;
 }
      
 #menu li:hover a, #menu li span{
     background: #FFF;
     color: #0074D9;
     border-left: 1px solid #0074D9;
     text-decoration: none;
 }
 #menu li.active a {
    background: #FFF;
    color: #0074D9;
    border-left: 1px solid #0074D9;
    text-decoration: none;
}
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
    
    <div id="top-header">
             
             <!-- Logo -->
               
                      
             <!-- Navigation Menu -->
             <nav>
               <div id="menu">
                 <ul>
                     <li class="<?php if($this->uri->uri_string() == '') { echo 'active'; } ?>"><a href="#">Home</a></li>
                     <li class="<?php if($this->uri->uri_string() == 'project/index') { echo 'active'; } ?>">
                     <a class="menu-a" href="<?php echo site_url('project/index'); ?>" ><i class="glyphicon glyphicon-list-alt fa-lg"></i> Manage Projects</a>
                     </li>
                     <li class="<?php if($this->uri->uri_string() == 'task/index') { echo 'active'; } ?>">
                     <a class="menu-a" href="<?php echo site_url('task/index'); ?>" ><i class="glyphicon glyphicon-list-alt fa-lg"></i> Manage Tasks</a>
                     </li>
                     <li>
                     <a class="menu-a" href="<?php echo site_url('taskLog/index'); ?>" ><i class="glyphicon glyphicon-list-alt fa-lg"></i> Manage Time entries</a>                 
                    </li>
                     <li>
                     <a class="menu-a" href="<?php echo site_url('report/index'); ?>" ><i class="glyphicon glyphicon-list-alt fa-lg"></i> Report</a>                 
                     </li>
                 </ul>
               </div>
             </nav>
         </div> 
</head>
<body>
	
<div class="container">
    <div id="content" class="row">
    </div>
</div>
	
</body>
</html>