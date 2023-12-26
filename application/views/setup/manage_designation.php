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
            <div class="navbar-header col-md-5">
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('setup_con/manage_designation_add') ?>"><?= $title ?></a>
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
        <div class="col-md-12">
            <?php $success = $this->session->flashdata('success');
                if ($success != "") {  ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } ?>


            <?php $failure = $this->session->flashdata('failure');
                if ($failure != "") { ?>
                <div class="alert alert-failuer"><?php echo $failure; ?></div>
            <?php }?>
        </div>
    </div>
    <div id="target-div" class="row tablebox table-responsive">
        <div class="col-md-6" style="margin-left:-16px">
             <h3 style="font-weight:bold">Designation List</h3>
         </div>
        <!-- <div class="col-md-12"> -->
            <table class="table" id="mytable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Designation Name </th>
                        <th>Line</th>
                        <th>Section</th>
                        <th>Department</th>
                        <th>Unit Name </th>
                        <th width="80">Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($results)){ foreach($results as $key => $data){?>

                    <tr>
                        <td><?php echo $key+1?></td>
                        <td><?php echo $data['desig_name'] ?></td>
                        <td><?php echo $data['line_name_en'] ?></td>

                        <td><?php echo $data['sec_name_en'] ?></td>
                        <td><?php echo $data['dept_name'] ?></td>
                        <td><?php echo $data['unit_name'] ?></td>
                        <td>
                            <a href="<?=base_url('setup_con/manage_designation_edit') . '/' . $data["id"]?>"
                                 class="btn btn-primary center-text" role="button">Edit</a>
                        </td>
                        <td>
                            <a href="<?=base_url('setup_con/manage_designation_delete') . '/' . $data["id"]?>"
                                class="btn btn-danger center-text" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php } }else{?>

                    <tr>
                        <td colspan="12">Records not Found</td>
                    </tr>
                    <?php }?>

                </tbody>
            </table>
        <!-- </div> -->
    </div>
    <br><br>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#mytable").dataTable();
    $('#mytable_filter').css({
        "display": "none"
    })
    $('#mytable_length').css({
        "display": "none"
    })
    $("#mytable").dataTable();
    oTable = $('#mytable').DataTable();
    $('#deptSearch').keyup(function() {
        oTable.search($(this).val()).draw();
    })
});
</script>