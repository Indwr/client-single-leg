<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

              </div>
            <!-- </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Total Payout</th>
                            <th>Direct Income</th>
                            <th>Level Income</th>
                            <th>Single Leg Income</th>
                            <th>Non-Working Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($records as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $record['date']; ?></td>
                                <td><?php echo $record['payout'] ; ?></td>
                                <td><?php echo $record['incomes']['direct_income'] ; ?></td>
                                <td><?php echo $record['incomes']['level_income'] ; ?></td>
                                <td><?php echo $record['incomes']['single_leg'] ; ?></td>
                                <td><?php echo $record['incomes']['non_working_income'] ; ?></td>
                                
                                 <td>
                                  <a href="<?php echo base_url('Jarvis/Settings/date_payout/'.$record['date']);?>" target="_blank">View</a>


                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">Showing <?php echo ($segament + 1) .' to  '.$i;?> of <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      <?php
                        echo $this->pagination->create_links();
                        ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>
