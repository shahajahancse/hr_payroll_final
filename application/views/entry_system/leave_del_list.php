<div class="content">
    <nav class="navbar navbar-inverse bg_none">
        <div class="container-fluid nav_head">
            <div class="navbar-header col-md-5">
                <div>
                    <a class="btn btn-info" href="<?php echo base_url('index.php/entry_system_con/leave_transation') ?>">Add Leave</a>
                    <a class="btn btn-primary" href="<?php echo base_url('index.php/payroll_con') ?>">Home</a>
                </div>
            </div>
            <div class="col-md-7">
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="">
                        <form class="navbar-form pull-right" role="search">
                            <div class="input-group">
                              <input type="text" id="search-input" onkeyup="loadData(1)" placeholder="Search...">
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
           
            <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Unit name</th>
                            <th>User name </th>
                            <th>Leave Date</th>
                            <th>Leave Day</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                <tbody id="tbody">
                    <!-- Table rows will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
</div>

<script type="text/javascript">

var offset = 0;
var limit = 10;
function loadData(r=null) {
    if (r != null) {
      $('#tbody').empty();
    }
   var searchQuery = $('#search-input').val()

    $.ajax({
        url: '<?= base_url("entry_system_con/get_leave_data/") ?>' + offset + '/' + limit,
        type: 'GET',
        data: { search: searchQuery },
        dataType: 'json',
        success: function(data) {
            var i = 1;
            data.forEach(function(row) {
                // console.log(row);return false;
                // emp_id
                var tr = $('<tr></tr>');
                tr.append('<td>' + i + '</td>');
                tr.append('<td>' + row.name_en + '</td>');
                tr.append('<td>' + row.unit_name + '</td>');
                tr.append('<td>' + row.leave_start + '</td>');
                tr.append('<td>' + row.leave_end + '</td>');
                tr.append('<td>' + row.leave_type + '</td>');
                tr.append('<td>' + row.total_leave + '</td>');
                tr.append('<td><button type="button" class="btn btn-danger" onclick="leave_delete(' + row.id + ')">Delete</button></td>');
                $('#tbody').append(tr);
                i++;
            });
            offset += limit;
        },
        error: function(xhr, status, error) {
            console.error('Error loading data:', error);
        }
    });
}
// Initial load
loadData();
// Load more data when scrolling
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $('#mytable').height()) {
        loadData();
    }
});

</script>