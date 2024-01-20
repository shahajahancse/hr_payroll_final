
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
    }
    table.dataTable tbody th, table.dataTable tbody td {
      padding: 4px !important;
    }
    .center-text {
        vertical-align: center;
        padding: 5px 10px;
        /* line-height: 40px; Should be equal to the button's height */
    }
</style>

<div class="content" style="display: flex;flex-direction: column;gap: 10px">
  
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
  <div id="add_form" class="row tablebox">
    <form action="<?= base_url('setting_con/dasig_group_add')?>" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acl_name">Group Name</label>
                    <input style="height: 5px !important;" type="text" name="name_en" class="form-control input-lg" id="name_en" placeholder="Enter Name">
                    <?= (isset($failuer['name_en'])) ? '<div class="alert alert-failuer">' . $failuer['name_en'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acl_name">Group Name (বাংলা)</label>
                    <input style="height: 5px !important;" type="text" name="name_bn" class="form-control input-lg" id="name_bn" placeholder="Enter Name">
                    <?= (isset($failuer['name_bn'])) ? '<div class="alert alert-failuer">' . $failuer['name_bn'] . '</div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="unit_id">Unit</label>
                    <select name="unit_id">
                        <option value="">Select Unit</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="unit_id">status</label>
                    <select name="status">
                        <option value="1">Enable</option>
                        <option value="2">Disable</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
            <div class="form-group">
                <label for="acl_name" style="visibility: hidden">.</label>
                <input type="submit" value="Submit" class="btn btn-success">
            </div>
            </div>
        </div>
   </form>
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
