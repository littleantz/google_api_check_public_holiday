<?php ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <!--<link rel="stylesheet" href="<?=base_path()?>\vendor\twbs\bootstrap\dist\css\bootstrap.css">-->
	<link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('assets/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container-fluid" style="margin-top:20px;">
		<div class="panel panel-info class">
			<div class="panel-heading">Check Public Holiday</div>
			<div class="panel-body">
				<form class="form-inline">
					  <div class="form-group">
							<label for="date">Date</label>
							<!--<input type="date" class="form-control" id="check_date">-->
							<div class="input-group date" id="datetimepicker1">
								<input type="text" class="form-control" id="check_date">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
					  </div>
					  <div class="form-group">
							<button type="button"  id="btnSubmit"class="btn btn-success">Submit</button>
					  </div>
				</form>
			</div>
		</div>
		
		
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Date Info</h4>
			  </div>
			  <div class="modal-body">
				<p id="date_info"></p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ URL::asset('assets/js/moment-with-locales.js')}}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.js')}}"></script>
	
	<script>
		$(function() {
			$('#datetimepicker1').datetimepicker({
				defaultDate : "01 Jan 2018",
				minDate : "01 Jan 2018",
				maxDate : "31 Dec 2018",
                format: 'DD MMM YYYY'
            });
			
			$("#btnSubmit").on('click', function(){
				$.ajax({
					beforeSend: function() { $('#btnSubmit').attr('disabled', true);  },
					complete  : function() { $('#btnSubmit').attr('disabled', false);  },
					type: "POST",
					url: "\checkPublicHoliday",
					dataType: "json",
					data: { check_date: $('#check_date').val(), _token: $('#_token').val() },
					success: function (res) {
						$('#date_info').html(res.result);
						$('#myModal').modal('show');
					},
					error: function (jqXHR, exception) {	
					
					},
				});
			});
		});
	</script>
  </body>
</html>