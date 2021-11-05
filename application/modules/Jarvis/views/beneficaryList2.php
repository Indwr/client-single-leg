<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Beneficary List </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Beneficary List</li>
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
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" name="start_date" class="form-control" value="<?php echo $start_date;?>" placeholder="Start Date" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="end_date" class="form-control"  value="<?php echo $end_date;?>" placeholder="End Date" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="user_id" class="form-control"  value="" placeholder="User ID" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" class="form-control" value="search" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Bank Name</th>
                                        <th>Bank Holder Name</th>
                                        <th>Bank A/C No.</th>
                                        <th>Bank IFSC</th>
                                        <th>Bank Branch</th>
                                        <th>Register Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $i = ($segament) + 1;
                                    foreach ($requests as $key => $request) {
                                        ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $request['user_id']; ?></td>
                                        <td><?php echo $request['user']['name']; ?></td>
                                        <td><?php echo $request['beneficiary_bank']; ?></td>
                                        <td><?php echo $request['beneficiary_name']; ?></td>
                                        <td><?php echo $request['beneficiary_account_no']; ?></td>
                                        <td><?php echo $request['beneficiary_ifsc']; ?></td>
                                        <td><?php echo $request['beneficiary_branch']; ?></td>
                                        <td><?php echo $request['beneficiary_mobile']; ?></td>
                                        <td><a href="<?php echo base_url('Jarvis/Management/editBeneficary/'.$request['id']); ?>" class="btn btn-primary">EDIT</a></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                                        Showing <?php echo ($segament + 1) .' to  '.$i;?> of
                                        <?php echo $total_records;?> entries</div>
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