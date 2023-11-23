<div class="container" style="padding-top: 10px;">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url('index.php/crud_con/sec_add')?>">Add Section</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?=base_url('index.php/payroll_con')?>">Home</a></li>
                </ul>
                <div class="pull-right">
                    <form class="navbar-form pull-right" role="search">
                        <div class="input-group">
                            <input id="deptSearch" type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
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
            <div class="col-md-6">
                <h3 style="margin-top: 0px; margin-bottom: 8px;">Holiday List</h3>
            </div>
        </div>
    </div>
    <!-- <br> -->
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Unit</th>
                        <th>Emp. ID </th>
                        <th>Holiday Date</th>
                        <th>Replace Val</th>
                        <th>Description</th>
                        <th>Delete</th>
                    </tr>
                    <?php 
                if(!empty($attn_holiday)){ foreach($attn_holiday as $attn_holidays){?>
                    <tr>
                        <td><?php echo $attn_holidays['unit_name'] ?></td>
                        <td><?php echo $attn_holidays['emp_id'] ?></td>
                        <td><?php echo $attn_holidays['holiday_date'] ?></td>
                        <td><?php echo $attn_holidays['replace_val'] ?></td>
                        <td><?php echo $attn_holidays['description'] ?></td>
                        <td>
                            <a href="<?=base_url('index.php/crud_con/holiday_delete').'/'.$attn_holidays["id"]?>"
                                class="btn btn-danger" role="button">Delete</a>
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