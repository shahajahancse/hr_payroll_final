
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


  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div class="content">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"  href="<?=base_url('attn_process_con/file_add')?>"><?= $title ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url('payroll_con')?>" >Home</a></li>
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
      <div class="container-fluid">
        <table class="table table-striped" id="mytable">
          <thead>
            <tr>
              <th>SL.</th>
              <th>Unit Name </th>
              <th>Date</th>
              <th>File Name </th>
              <th>Delete</th>
            </tr>
          </thead>

          <tbody>
            <?php if(!empty($results)){ $i=0; foreach($results as $row){?>
              <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $row->unit_name; ?></td>
                  <td><?php echo $row->upload_date; ?></td>
                  <td><a href="<?=base_url('data/'.$row->file_name)?>"><?php echo $row->file_name; ?></a></td>
                  <td>
                    <a href="<?=base_url('attn_process_con/delete_attn_file/'.$row->id)?>" class="btn btn-danger btn-mini" role="button">Delete</a>
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
