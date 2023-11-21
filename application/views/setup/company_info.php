<div class="content">
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
                <a class="navbar-brand" href="<?=base_url('index.php/setup_con/company_add')?>">Add Comapny Unit</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('index.php/payroll_con') ?>">Home</a></li>
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
    <!-- <br> -->
    <div class="row tablebox">
        <div class="col-md-12">

            <table class="table table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>Company Name </th>
                        <th>Company Address</th>
                        <th>Company Phone No</th>
                        <th>Company Logo</th>
                        <th>Company Signature</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            if (!empty($company_infos)) {foreach ($company_infos as $cominfos) {?>

                    <tr>
                        <td><?php echo $cominfos['company_name_bangla'] ?></td>
                        <td><?php echo $cominfos['company_add_bangla'] ?></td>
                        <td><?php echo $cominfos['company_phone'] ?></td>
                        <td><img width="55" height="55" src="<?=base_url()?>images/<?=$cominfos['company_logo']?>" />
                        </td>
                        <td><img width="55" height="55"
                                src="<?=base_url()?>images/<?=$cominfos['company_signature']?>" /></td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/company_edit') . '/' . $cominfos["id"]?>"
                                target='_blank' class="btn btn-primary" role="button">Edit</a>
                        </td>
                        <td>
                            <a href="<?=base_url('index.php/setup_con/company_delete') . '/' . $cominfos["id"]?>"
                                class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php }} else {?>

                    <tr>
                        <td colspan="12">Records not Found</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
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