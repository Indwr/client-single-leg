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
            <li class="breadcrumb-item"><a href="javaScript:void();">Epins</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $header;?></li>
         </ol>
     </div>
     

  </div>

     <!-- Start row tables -->

     <div class="row">
        <div class="col-lg-12">
          <?php 
          if(!empty($this->session->flashdata('success'))){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <div class="alert-icon contrast-alert">
             <i class="icon-check"></i>
              </div>
              <div class="alert-message">
                <span><strong>Success!</strong> '.$this->session->flashdata('success').'</span>
              </div>
                    </div>';
          }
          if(!empty($this->session->flashdata('error'))){
              echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <div class="alert-icon contrast-alert">
             <i class="icon-close"></i>
              </div>
              <div class="alert-message">
                <span><strong>Error!</strong> '.$this->session->flashdata('error').'</span>
              </div>
                    </div>';
              }
          ?>
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> <?php echo $header;?></div>
            <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                      <th>#</th>
                        <th>User ID</th>
                        <th>Epin</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $key => $value) {
                  extract($value);
                  echo '<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$user_id.'</td>
                      <td>'.$epin.'</td>
                      <td>'.$amount.'</td>
                      <td><label class="badge badge-info">Avaliable</label></td>
                      <td>'.$created_at.'</td>';
                      ?>
                      <?php
                      // if($amount == 600 || $amount == 599){
                        echo '<td><a href="'.base_url('Member/Activation/accountActive/'.$epin).'" class="btn btn-success">Activation</a></td>';
                      // }else{
                      //   echo '<td><a href="'.base_url('Member/Activation/accountUpgrade/'.$epin).'" class="btn btn-primary">Upgrade Account</a></td>';
                      // }
                      ?>

                    </tr>
                    <?php
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