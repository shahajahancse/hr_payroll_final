<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('/css/dataTables.min.css'); ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <script src="<?php echo base_url('/js/jquery-3.5.1.min.js') ?>"></script>
  <script src="<?php echo base_url('/js/dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.js') ?>"></script>

<style type='text/css'>
body
{
  font-family: Arial;
  font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
  text-decoration: underline;
}
.pagination a{
  padding: 7px 10px;
  margin-right:5px;
  background: #28c8d8;
  color:#fff;
}
.pagination strong{
  padding: 7px 10px;
  margin-right:5px;
  background: #0d9488;
  color:#fff;
}
.dataTables_paginate .paginate_button:hover
{
    background: #28c8d8 !important;
    color:#fff !important;
}

.paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
.dataTables_paginate .paginate_button:active {
    background: #0d9488 !important;
    color:#fff !important;
}

table.dataTable thead th, table.dataTable thead td {
  border-bottom: none !important;
}
table.dataTable.no-footer {
  border-bottom: none;
}
</style>
</head>
<body style="background-color:#FCE9D9;">

    <div class="container" style="padding-top: 10px;">

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand"  href="<?=base_url('index.php/crud_con/sec_add')?>">Add Section</a> -->
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="<?=base_url('index.php/payroll_con')?>" >Home</a></li>
                </ul>
                <div class="pull-right">
                  <form class="navbar-form pull-right" role="search">
                    <div class="input-group">
                      <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                      <div class="input-group-btn">
                          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
      <div class="row">
        <div class="col-md-12">
          <?php
          $success = $this->session->flashdata('success');
          if ($success != "") {
           ?>
           <div class="alert alert-success"><?php echo $success; ?></div>
           <?php
            }
            $failuer = $this->session->flashdata('failuer');
            if ($failuer) {
             ?>
           <div class="alert alert-failuer"><?php echo $failuer; ?></div>
           <?php
            }
            ?>

        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            <div class="col-md-6"><h3 style="margin-top: 0px; margin-bottom: 8px;" >Weekend List</h3></div>
         </div>
      </div>

        <!-- <br> -->
           <div class="row">
                <div class="col-md-9">
                    <table class="table table-striped" id="mytable">
                      <thead>
                        <tr>
                          <th>Unit</th>
                          <th>Emp. ID </th>
                          <th>Work Off Date</th>
                          <th>Replace Val</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody> 
                        <?php 
                          if(!empty($pr_work_off)){ foreach($pr_work_off as $pr_work_offs){?>

                              <tr>
                                  <td><?php echo $pr_work_offs['unit_name'] ?></td>
                                  <td><?php echo $pr_work_offs['emp_id'] ?></td>
                                  <td><?php echo $pr_work_offs['work_off_date'] ?></td>
                                  <td><?php echo $pr_work_offs['replace_val'] ?></td>
                                  <td>
                                      <a href="<?=base_url('index.php/crud_con/weekend_delete').'/'.$pr_work_offs["id"]?>" class="btn btn-danger" role="button">Delete</a>

                                  </td>
                              </tr>
                          <?php } }else{?>

                              <tr>
                                  <td colspan="12">Records not Found</td>
                              </tr>
                          <?php }?>
                      </tbody>
                    </table>
                    <!-- <div class="pagination"><?php // echo $this->pagination->create_links(); ?></div> -->
                 </div>
           </div>
          <br><br>
    </div>

      <script type="text/javascript">
        $(document).ready(function() {
            $("#mytable").dataTable();
            $('#mytable_filter').css({"display": "none"})
            $('#mytable_length').css({"display": "none"})
            $("#mytable").dataTable();
            oTable = $('#mytable').DataTable();
            $('#deptSearch').keyup(function(){
              oTable.search($(this).val()).draw() ;
            })
        });
      </script>

</body>
</html>




 