<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="<?php echo base_url('payroll_con') ?>">Home</a></li>
                </ul>

              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
      <div class="row">
        <div class="col-md-8">
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
          <div class="col-md-8">
              <div class="col-md-6"><h3>Leave List</h3></div>

         </div>
      </div>

        <!-- <br> -->
           <div class="row">

                <div class="col-md-8">
                   <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>


                  <div>
                    <form method='post' action="<?= base_url() ?>entry_system_con/leave_delete/" >
                          <input type='text' name='search' value='<?= $search ?>'><input type='submit' name='submit' value='Submit'>
                       </form>
                       <br/>
                     </div>
                    <table class="table table-striped">


                        <tbody>
                            <tr>
                                <th>Emp. ID </th>
                                <th>Unit</th>
                                <th>Start Date</th>
                                <th>Leave Type</th>
                                <th>Leave Start</th>
                                <th>Leave End</th>
                                <th>Leave Desciption</th>

                                <th>Delete</th>

                            </tr>

                            <?php
                         // print_r($pr_leave_trans);exit('keno?');


                            if(!empty($pr_leave_trans)){ foreach($pr_leave_trans as $pr_leave_transs){?>

                                <tr>
                                    <td><?php echo $pr_leave_transs['emp_id'] ?></td>
                                    <td><?php echo $pr_leave_transs['unit_name'] ?></td>
                                    <td><?php echo $pr_leave_transs['start_date'] ?></td>
                                    <td><?php echo $pr_leave_transs['leave_type'] ?></td>
                                    <td><?php echo $pr_leave_transs['leave_start'] ?></td>
                                    <td><?php echo $pr_leave_transs['leave_end'] ?></td>
                                    <td><?php echo $pr_leave_transs['leave_descrip'] ?></td>




                                    <td>
                                        <a href="<?=base_url('crud_con/leave_delete').'/'.$pr_leave_transs["id"]?>" class="btn btn-danger" role="button">Delete</a>

                                    </td>
                                </tr>
                            <?php } }else{?>

                                <tr>
                                    <td colspan="12">Records not Found</td>
                                </tr>
                            <?php }?>

                    	</tbody>
                    </table>
                  </div>
           </div>

    </div>
</body>
</html>
