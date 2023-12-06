

<div class="content" >
    <nav class="navbar navbar-inverse bg_none">
      <div class="container-fluid nav_head">
          <div class="navbar-header col-md-5" style="padding: 7px;">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                  aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <div>
                  <a class="btn btn-info"href="<?=base_url('index.php/crud_con/salgrd_add')?>">Add Salary Grade</a>
                    <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
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
          <!--/.nav-collapse -->
      </div>
          <!--/.container-fluid -->
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
    <div class="row tablebox">

        <div class="col-md-12">

            <table class="table table-striped" id="mytable">
              <thead >
                <tr>
                  <th class="text-center">Sl. No. </th>
                  <th class="text-center">Salary Grade</th>
                  <th class="text-center" width="80">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
              </thead>
                <tbody>
                    <?php
                  // print_r($pr_grade);exit('keno?');
                    if(!empty($salary_grade)){$i=1; foreach($salary_grade as $pr_grades){?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-center"><?php echo $pr_grades['gr_name'] ?></td>
                            <td class="text-center" >
                                <a href="<?=base_url('index.php/crud_con/salgrd_edit').'/'.$pr_grades["id"]?>"target='_blank' class="btn btn-primary" role="button">Edit</a>
                            </td>
                            <td class="text-center">
                                <a href="<?=base_url('index.php/crud_con/salgrd_delete').'/'.$pr_grades["id"]?>" class="btn btn-danger" role="button">Delete</a>
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