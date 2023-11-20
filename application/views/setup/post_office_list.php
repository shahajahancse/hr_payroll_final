
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
          <a class="navbar-brand"  href="<?=base_url('setup_con/post_office_add')?>">Add Post Office</a>
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
              <th>Post Office Name </th>
              <th>Post Office Bangla </th>
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
                    <a href="<?=base_url('setup_con/post_office_edit/'.$pr_depts['id'])?>" class="btn btn-primary" role="button">Edit</a>
                  </td>
                  <td>
                    <a href="<?=base_url('setup_con/post_office_delete/'.$pr_depts["id"])?>" class="btn btn-danger" role="button">Delete</a>
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
