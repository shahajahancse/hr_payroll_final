<style>
  #mytable {
    border-collapse: collapse;
  }
  #mytable, th, td {
    border: 1px solid #b0c0df;
    text-align: center;
    vertical-align: middle !important;
  }
  .table td {
    padding: 0px 3px !important;
    font-size: 13px;
  }
  table.dataTable thead th, table.dataTable thead td {
    border-bottom: none;
    white-space: nowrap;
  }
  table.dataTable tbody th, table.dataTable tbody td {
    padding: 4px !important;
    white-space: nowrap;
  }
  .center-text {
    vertical-align: center;
    padding: 5px 10px;
  }
</style>


<div class="content">
  <nav class="navbar navbar-inverse bg_none">
    <div class="container-fluid nav_head">
      <div class="navbar-header col-md-5" style="padding: 7px;">
        <div>
          <a class="btn btn-info" href="<?php echo base_url('setup_con/post_office_add')?>">Add Post Office</a>
          <a class="btn btn-primary" href="<?php echo base_url('payroll_con') ?>">Home</a>
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
    <div class="col-md-8">
      <?php $success = $this->session->flashdata('success');
        if ($success != "") { ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
      <?php } 
        $failuer = $this->session->flashdata('failuer');
        if ($failuer) { ?>
        <div class="alert alert-failuer"><?php echo $failuer; ?></div>
      <?php } ?>
    </div>
  </div>
  <div id="target-div">
    <div class="tablebox">
      <div class="col-md-6" style="margin-left:-16px">
        <h4 style="font-weight:bold">Post Office List</h4>
      </div>
      <table class="table" id="mytable">
        <thead>
          <tr>
            <th>Post Office Bangla </th>
            <th>Post Office English</th>
            <th>Upa Zila</th>
            <th>District</th>
            <th>Division</th>
            <th width="80">Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($pr_dept)){ foreach($pr_dept as $pr_depts){?>
            <tr>
                <td><?php echo $pr_depts['name_bn'] ?></td>
                <td><?php echo $pr_depts['name_en'] ?></td>
                <td><?php echo $pr_depts['upa_name_en'] ?></td>
                <td><?php echo $pr_depts['dis_name_en'] ?></td>
                <td><?php echo $pr_depts['div_name_en'] ?></td>
                <td >
                  <a href="<?=base_url('setup_con/post_office_edit/'.$pr_depts['id'])?>" class="btn btn-primary input-sm center-text" role="button">Edit</a>
                </td>
                <td>
                  <a href="<?=base_url('setup_con/post_office_delete/'.$pr_depts["id"])?>" class="btn btn-danger input-sm center-text" role="button">Delete</a>
                </td>
            </tr>
          <?php } }else{?>
            <tr>
                <td colspan="12">Records not Found</td>
            </tr>
          <?php }?>
        </tbody>
      </table>
        <!-- <div class="pagination"><?php //echo $this->pagination->create_links(); ?></div> -->
    </div>
  </div>
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