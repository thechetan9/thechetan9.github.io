<!DOCTYPE html>
<html lang="en">

<head>
    <title>Car Inventory</title>
   
    <link rel="stylesheet" href="CSS/jquery-ui.css">
    <link rel="stylesheet" href="CSS/jquery.dataTables.min.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery-ui.js"></script>
    <script src="JS/jquery.dataTables.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

  	<style type="text/css">
	    .jumbotron {
	    height: 150px;
	    background: #8cbf7b;
	  }
  	</style>
</head>

<body>
    <div class="jumbotron text-center" style="margin-bottom:-40px;">
        <h2>Mini Car Inventory System</h2>
    </div>
    <div id="alerts" style="display:none;">
    </div>
    <div class="container">
        <div class="row">
            <ul class="nav nav-pills" style="margin-bottom: 10px">
                <li class="active"><a data-toggle="pill" href="#manufacturer">Add Manufacturer</a></li>
                <li><a data-toggle="pill" href="#model">Add Model</a></li>
                <li><a data-toggle="pill" href="#inventory">View Details</a></li>
            </ul>

            <div class="tab-content">

                <div id="manufacturer" class="tab-pane fade in active">
                    <form action="#">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="manufacturer_name">Manufacturer:</label>
                                    <input type="text" class="form-control" id="manufacturer_name" placeholder="Enter Manufacturer Name" name="manufacturer_name" required>
                                </div>
                            
                                <button type="button" style="background-color: #6c757d" class="btn btn-primary" onclick="addManufacturere()">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="model" class="tab-pane fade">
                    <form id="model-form">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="select-manufacturer">Select Manufacturer:</label>
                                    <select class="form-control input-sm" id="select-manufacturer">
                                    </select>
                                </div>  
                            </div>  
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="model-name">Model Name:</label>
                                    <input type="text" class="form-control input-sm" id="model-name">
                                </div>    
                            </div>   
                        </div>   

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="model-color">Color:</label>
                                    <input type="text" class="form-control input-sm" id="model-color">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="model-year">Manufacturing Year:</label>
                                    <input class="date-own form-control" style="width: 370px;" type="text" id="model-year">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4">        
                                <div class="form-group">
                                    <label for="model-reg-no">Registration Number:</label>
                                    <input type="text" class="form-control input-sm" id="model-reg-no">
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="model-note">Note:</label>
                                    <input type="text" class="form-control input-sm" id="model-note">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
	                        <div class="col-sm-1">  
		                        <div class="form-group">
				                    <label for="model-count">Count:</label>
				                    <input type="number" class="form-control input-sm" id="model-count" min="0" value="0">
				                </div>
				            </div>
				        	
				        	<div class="col-sm-3">
		                        <div class="form-group">
		                            <label for="image-1">Image 1st:</label>
		                            <input type="file" name="image" id="image-1" required>
		                        </div>
                            </div>

                            <div class="col-sm-3">
		                        <div class="form-group">
		                            <label for="image-2">Image 2nd:</label>
		                            <input type="file" name="image" id="image-2" required>
		                        </div>
		                    </div>
	                    </div>

                        <button type="button" class="btn btn-primary" style="background-color: #6c757d" onclick="addModel()">SUBMIT</button>                     
                    </form>
                </div>

                <div id="inventory" class="tab-pane fade">
		            <table id="inventory-table" class="display" style="width:100%">
		                <thead>
		                    <tr>
		                        <th>Serial Number</th>
		                        <th>Manufacturer Name</th>
		                        <th>Model Name</th>
		                        <th>Count</th>
		                    </tr>
		                </thead>
		            </table>
					
					<button style="display:none;" id="model-button" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"></h4>
								</div>
								
								<div class="modal-body">
									<p></p>
								</div>
									
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">X</button>
								</div>
							</div>
						</div>
					</div>
        		</div>
            </div> <!-- tab div close -->
        </div> <!-- row div close -->
    </div> <!-- Container div close -->

</body>

<script type="text/javascript">
    $("#model-year").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
</script>

<script src="JS/manufacturer.js"></script>
<script src="JS/add_model.js"></script>
<script src="JS/inventory.js"></script>

</html>