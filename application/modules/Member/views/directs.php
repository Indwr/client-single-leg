<?php
	require_once 'header.php';
?>
<style>
  .footer {
    position: fixed;
}
</style>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"><?php echo $header;?></h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Member/Index') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Income</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $header;?></li>
         </ol>
	   </div>
     

	</div>

     <!-- Start row tables -->

     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> <?php echo $header;?> (<?php echo $totalDirects['totalDirects'];?>)</div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                    	<th>#</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Phone No.</th>
                        <th>Active Status</th>
                        <th>Joining At</th>
                        <th>Activation Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $key => $value) {
                	extract($value);
                	echo '<tr>
                			<td>'.($key+1).'</td>
                			<td>'.$user_id.'</td>
                			<td>'.$name.'</td>
                      <td>'.$phone.'</td>
                			<td>'.(($paid_status == 0) ? '<label class="badge badge-danger">Inactive</label>': '<label class="badge badge-success">Active</label>').'</td>
                			<td>'.$created_at.'</td>
                			<td>'.(($topup_date > 0) ? $topup_date : '<label class="badge badge-danger">Inactive</label>').'</td>
                		</tr>';
                }

                ?>
                    </tbody>
            </table>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->



 </div>
</div>
</div>

<?php
	require_once 'footer.php';
?>

<script>
     // $(document).ready(function() {
     //  //Default data table
     //   $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      // } );

    </script>