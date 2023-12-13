  <div class="content" >
      <nav  class="navbar navbar-inverse bg_none">
    <div class="container-fluid nav_head">
      <div class="navbar-header col-md-5" style="padding: 7px;">
          <div>
          <a href="<?=base_url('index.php/crud_con/taxnother_add')?>" class="btn btn-info" role="button">Add Left</a>
          <a href="<?php echo base_url('index.php/payroll_con')?>" class="btn btn-primary">Home</a>
          </div>
      </div>
      <div class="col-md-7">
        <div id="navbar" class="navbar-collapse collapse">
            <div class="">
                <form class="navbar-form pull-right" role="search">
                    <div class="input-group">
                      <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
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
  <div class="row tablebox">
    <div class="col-md-6"><h3 style="margin-top: 0px; margin-bottom: 8px;" >Left List</h3></div>
    <div class="col-md-12">
      <table class="table table-striped" id="mytable">
        <thead>
          <tr>
            <th>Emp. ID </th>
            <th>Name</th>
            <th>Unit</th>
            <th>Join Date</th>
            <th>Left Date</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody> 
        <?php if(!empty($pr_leave_trans)){ foreach($pr_leave_trans as $pr_leave_transs){?>
          <tr>
            <td><?php echo $pr_leave_transs['emp_id'] ?></td>
            <td><?php echo $pr_leave_transs['emp_full_name'] ?></td>
            <td><?php echo $pr_leave_transs['unit_name'] ?></td>
            <td><?php echo $pr_leave_transs['emp_join_date'] ?></td>
            <td><?php echo $pr_leave_transs['left_date'] ?></td>
            <td>
              <a href="<?=base_url('index.php/crud_con/left_delete').'/'.$pr_leave_transs["left_id"]?>" class="btn btn-danger" role="button">Delete</a>
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
  </div> <br><br>
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