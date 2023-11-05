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
              <a class="navbar-brand"href="<?=base_url('index.php/acl_con/member_add')?>" >Add Member</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
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
              <div class="col-md-6"><h3>Member List</h3></div>
              <div class="col-md-6 text-right">
                  <a href="<?=base_url('index.php/acl_con/member_add')?>" target='_blank' class="btn btn-info" role="button">Add Member</a>
              </div>
         </div>
      </div>

        <!-- <br> -->
           <div class="row">

                <div class="col-md-8">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Unit name</th>
                            <th>Status</th>
                            <!-- <th>ACL</th> -->
                            <th>Action</th>
                        </tr>
                        <?php
                          //echo "<pre>"; print_r($members); exit;
                        if(!empty($members)){
                          foreach($members as $member){?>
                          <tr>
                              <td><?php echo $member['id_number'] ?></td>
                              <td><?php echo '******' ?></td>
                              <td><?php echo $member['level'] ?></td>
                              <td><?php echo $member['unit_name'] ?></td>
                              <td><?php echo $member['status'] ?></td>
                              <!-- <td><?php echo $member['acl_name'] ?></td> -->
                              <td >
                                  <a href="<?=base_url('index.php/acl_con/member_edit').'/'.$member["id"]?>"target='_blank' class="btn btn-primary" role="button">Edit</a>
                              </td>
                              <td>
                                  <a href="<?=base_url('index.php/acl_con/member_delete').'/'.$member["id"]?>" class="btn btn-danger" role="button">Delete</a>

                              </td>
                          </tr>
                        <?php } }else{?>
                            <tr>
                                <td colspan="12">Records not Found</td>
                            </tr>
                        <?php }?>
                    	</tbody>
                    </table>
                    <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
                 </div>
           </div>

    </div>
</body>
</html>
