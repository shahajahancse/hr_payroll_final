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
    .bangla_font {
        font-family: SutonnyMJ !important;
    }
</style>

<div class="content">
  <nav class="navbar navbar-inverse bg_none">
      <div class="container-fluid nav_head">
          <div class="navbar-header col-md-5">
                <h3 style="font-weight:bold">Alert List</h3>
          </div>
          <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
  </nav>

  <div id="target-div" class="row tablebox">
      <table class="table" id="mytable">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Emp Id </th>
            <th>Name </th>
            <th>Line</th>
            <th>Designation</th>
            <th>Remark</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($results)){$i=1; foreach($results as $r){?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $r->emp_id ?></td>
                <td><?php echo $r->name_en ?></td>
                <td><?php echo $r->line_name_en ?></td>
                <td><?php echo $r->desig_name ?></td>
                <td><?php echo $r->msg ?></td>
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

