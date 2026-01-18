<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
<style>
    #fileDiv #removeTr td {
        padding: 5px 10px !important;
        font-size: 14px;
    }
    .btnn { border-radius: 2px; padding: 2px 8px; }
</style>
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <?php
		$this->load->model('common_model');
		$unit = $this->common_model->get_unit_id_name();
        ?>
<div class="content">
    <div class="col-md-8">
        <div class="row tablebox" style="display: block;">
            <h3 style="font-weight: 600;"><?= $title ?></h3>
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label>Unit <span style="color: red;">*</span> </label>
                    <select name="unit_id" id="unit_id" class="form-control input-sm">
                        <option value="">Select Unit</option>
                        <?php
                        // dd();
							foreach ($unit->result_array() as $row) {
								if($row['unit_id'] == $user_data->unit_name){
								$select_data="selected";
								}else{
                                    if ($user_data->level != "All") {
                                        continue;
                                    }
								}
								echo '<option '.$select_data.'  value="'.$row['unit_id'].'">'.$row['unit_name'].
								'</option>';
							}
						?>
                    </select>
                </div>
            </div>
            <!-- department -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label>Department </label>
                    <select class="form-control input-sm dept" id='dept' name='dept'>
                        <?php if (!empty($user_data->unit_name)) {
                            $dpts = $this->db->where('unit_id', $user_data->unit_name)->get('emp_depertment'); ?>
                        <option value=''>Select Department</option>
                        <?php foreach ($dpts->result() as $key => $val) { ?>
                        <option value='<?= $val->dept_id ?>'><?= $val->dept_name ?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <!-- section -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Section </label>
                    <select class="form-control input-sm section" id='section' name='section'>
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- line -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Line </label>
                    <select class="form-control input-sm line" id='line' name='line'>
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- Designation -->
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Designation</label>
                    <select class="form-control input-sm desig" id='desig' name='desig' onChange="grid_emp_list()">
                        <option value=''></option>
                    </select>
                </div>
            </div>
            <!-- status -->
            <div class="col-md-6">
                <?php $categorys = $this->db->get('emp_category_status')->result(); ?>
                <div class="form-group" style="margin-bottom: 10px !important;">
                    <label class="control-label">Status </label>
                    <select name="status" id="status" class="form-control input-sm" onChange="grid_emp_list()">
                        <option value="">All Employee</option>
                        <?php foreach ($categorys as $key => $row) { ?>
                        <option value="<?= $row->id ?>"><?= $row->status_type; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="row nav_head" style="display: block;">
            <div class="col-lg-12">
                <span style="font-size: 20px;"><?= $title ?></span>
            </div>
            <div class="col-lg-12" style="display: flex;gap: 20px">
                <input type="date" id="comment_date" name="comment_date">
                <textarea id="comment_employee" name="comment_employee" class="form-control" ></textarea>
            </div>
            <div class="col-lg-12 text-left">
                <br>
                <button class="btn btn-primary" onclick="comment_employee()">Save</button>
                <button class="btn btn-info"    onclick="show_comments()">Show all Comment</button>
            </div>
        </div>
        <br>
    </div>

    <div class="col-md-4 tablebox">
        <input type="text" id="searchi" class="form-control" placeholder="Search">
        <div style="height: 80vh; overflow-y: scroll;">
            <table class="table table-hover" id="fileDiv">
                <thead>
                    <tr style="position: sticky;top: 0;z-index:1">
                        <th class="active" style="width:10%"><input type="checkbox" id="select_all"
                                class="select-all checkbox" name="select-all"></th>
                        <th class="" style="background:#0177bcc2;color:white">Id</th>
                        <th class=" text-center" style="background:#0177bc;color:white">Name</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php if (!empty($employees)) {
                        foreach ($employees as $key => $emp) { ?>
                    <tr class="removeTr">
                        <td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="<?= $emp->emp_id ?>">
                        </td>
                        <td class="success"><?= $emp->emp_id ?></td>
                        <td class="warning "><?= $emp->name_en ?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr class="removeTrno">
                        <td colspan="3" class="text-center"> No data found</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- </div> -->
    <!-- Show Comment Modal -->

     <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="commentsModalBody" style="background-color: #fff;">
                    <!-- JS will populate this -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnn btn-danger" onclick="$('#commentsModal').modal('hide')" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editCommentForm">
            <input type="hidden" name="comment_id" id="edit_comment_id">
            <div class="mb-3">
                <label for="edit_date_time" class="form-label">Date</label>
                <input type="date" class="form-control" id="edit_date_time" name="date_time" required>
            </div>
            <div class="mb-3">
                <label for="edit_comment_text" class="form-label">Comment</label>
                <textarea class="form-control" id="edit_comment_text" name="comment" rows="3" required></textarea>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="saveCommentBtn">Save Changes</button>
        </div>
        </div>
    </div>
    </div>


</div>

<script>
    function comment_employee() {
        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            return false;
        }
        date = document.getElementById('comment_date').value;
        comment = document.getElementById('comment_employee').value;
        var data = "emp_id="+numbersArray+"&comment="+comment+"&date="+date;
        $.ajax({
            type: "POST",
            url: hostname + "entry_system_con/comment_employee_save",
            data: data,
            success: function(res) {
                if (res == 'done') {
                    showMessage('success', 'Successfully Added');
                    setTimeout(function() { window.location.reload(); }, 3000);
                }else{
                    showMessage('error', res);
                }
            },
            error: function(data) {
                $("#loader").hide();
                showMessage('error', 'Sorry Not Updated');
            }
        })
    }
    function show_comments() {
        var checkboxes = document.getElementsByName('emp_id[]');
        var sql = get_checked_value(checkboxes);
        let numbersArray = sql.split(",");
        if (numbersArray == '') {
            showMessage('error', 'Please select employee Id');
            return false;
        }
        if (numbersArray.length > 1) {
            showMessage('error', 'Please select max one employee Id');
            return false;
        }
        unit_id = document.getElementById('unit_id').value;
        if (unit_id == '') {
            showMessage('error', 'Please select Unit');
            return false;
        }
        var data = "emp_id="+numbersArray;
        $.ajax({
            type: "POST",
            url: hostname + "entry_system_con/show_comments",
            data: data, // your data
            dataType: "json",        // expect JSON
            success: function(res) {
                // console.log(res);
                if(res.length === 0){
                    showMessage('error', 'No comments found.');
                    return;
                }
                let employee = res[0];
                let html = `<div  style="width:100%">
                    <h4>Comments About</h4>
                    <h5 class="mb-3">
                        <b> Name: ${employee.name_en}</b>, 
                        <b> Emp. ID:  ${employee.emp_id}</b>
                    </h5>
                    <table class="table table-bordered" style="width:100%;border:1px solid black !important">
                        <thead >
                            <tr>
                                <th style="border:1px solid black !important">Sl</th>
                                <th style="border:1px solid black !important">Date</th>
                                <th style="border:1px solid black !important">Comment</th>
                                <th style="border:1px solid black !important">Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
                    res.forEach((comment, index) => {
                        html += `<tr id="row-${comment.id}">
                            <td style="border:1px solid black !important">${index + 1}</td>
                            <td style="border:1px solid black !important" class="date-cell">${comment.date_time}</td>
                            <td style="border:1px solid black !important" class="comment-text">${comment.comment}</td>
                            <td style="border:1px solid black !important">
                                <button class="btn btnn btn-sm btn-primary editBtn"
                                        data-id="${comment.id}"
                                        data-comment="${comment.comment}">
                                    Edit
                                </button>
                                <a href="${hostname}entry_system_con/delete_comment/${comment.id}" 
                                    class="btn btnn btn-sm btn-danger deleteBtn">
                                        Delete
                                </a>
                            </td>
                        </tr>`;
                    });
                html += `</tbody></table></div>`;
                $("#commentsModalBody").html(html);
                $("#commentsModal").modal('show');
            },
            error: function(err) {
                console.error(err);
            }
        });
    }

    $(document).on('click', '.editBtn', function() {
        let commentId = $(this).data('id');
        let commentText = $(this).data('comment');
        let dateTime = $(this).closest('tr').find('.date-cell').text();

        // Pre-fill the edit modal
        $('#edit_comment_id').val(commentId);
        $('#edit_comment_text').val(commentText);

        // Convert "YYYY-MM-DD HH:MM:SS" to "YYYY-MM-DDTHH:MM" for datetime-local
        let dt = dateTime.replace(' ', 'T');
        $('#edit_date_time').val(dt);

        // Show the edit modal
        $('#editCommentModal').modal('show');
    });

    $('#saveCommentBtn').click(function() {
        let formData = $('#editCommentForm').serialize(); // comment_id, date_time, comment

        $.ajax({
            type: "POST",
            url: hostname + "entry_system_con/update_comment", // create this endpoint
            data: formData,
            success: function(res) {
                // Optionally, you can update the table row without reload
                let updatedComment = $('#edit_comment_text').val();
                let updatedDate = $('#edit_date_time').val().replace('T', ' ');
                let rowId = $('#edit_comment_id').val();
                let row = $('#row-' + rowId);
                row.find('.comment-text').text(updatedComment);
                row.find('.date-cell').text(updatedDate);
                $('#editCommentModal').modal('hide');
                showMessage('success', 'Comment updated successfully');
            },
            error: function(err) {
                console.error(err);
                showMessage('error', 'Failed to update comment');
            }
        });
    });

    // Delegate click because table rows are dynamic
    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault(); // prevent default link click

        if(!confirm('Are you sure you want to delete this comment?')) return;

        let url = $(this).attr('href');       // URL from href
        let rowId = $(this).closest('tr').attr('id'); // e.g., row-123

        $.ajax({
            type: "POST",
            url: url,           // your delete endpoint
            success: function(res) {
                // Remove row from table
                $('#' + rowId).remove();
                showMessage('success', 'Comment deleted successfully');
            },
            error: function(err) {
                console.error(err);
                showMessage('error', 'Failed to delete comment');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // select all item or deselect all item
        $("#select_all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        //Designation dropdown
        $('#line').change(function() {
            $('.desig').addClass('form-control input-sm');
            $(".desig > option").remove();
            var id = $('#line').val();
            $.ajax({
                type: "POST",
                url: hostname + "common/ajax_designation_by_line_id/" + id,
                success: function(func_data) {
                    $('.desig').append("<option value=''>-- Select Designation --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.desig').append(opt);
                    });
                }
            });
            grid_emp_list();
        });

        //Line dropdown
        $('#section').change(function() {
            $('.line').addClass('form-control input-sm');
            $(".line > option").remove();
            $(".desig > option").remove();
            var id = $('#section').val();
            $.ajax({
                type: "POST",
                url: hostname + "common/ajax_line_by_sec_id/" + id,
                success: function(func_data) {
                    $('.line').append("<option value=''>-- Select Line --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.line').append(opt);
                    });
                }
            });
            grid_emp_list();
        });

        //Section dropdown
        $('#dept').change(function() {
            $('.section').addClass('form-control input-sm');
            $(".section > option").remove();
            $(".line > option").remove();
            $(".desig > option").remove();
            var id = $('#dept').val();
            $.ajax({
                type: "POST",
                url: hostname + "common/ajax_section_by_dept_id/" + id,
                success: function(func_data) {
                    $('.section').append("<option value=''>-- Select Section --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.section').append(opt);
                    });
                }
            });
            grid_emp_list();
        });

        //Department dropdown
        $('#unit_id').change(function() {
            $('.dept').addClass('form-control input-sm');
            $(".dept > option").remove();
            $(".section > option").remove();
            $(".line > option").remove();
            $(".desig > option").remove();
            var id = $('#unit_id').val();
            if (typeof id === "undefined" || id === '') {
                return false;
            }
            $.ajax({
                type: "POST",
                url: hostname + "common/ajax_department_by_unit_id/" + id,
                success: function(func_data) {
                    $('.dept').append("<option value=''>-- Select Department --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.dept').append(opt);
                    });
                }
            });
            grid_emp_list();
        });
    });
</script>

<script>
    function get_checked_value(checkboxes) {
        var vals = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value)
            .join(",");
        return vals;
    }
</script>

<script>
    $(document).ready(function() {
        $("#searchi").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            $(".removeTrno").toggle($(".removeTr").length === 0);
        });
    });
</script>

<script>
    function loading_open() {
        $('#loader').css('display', 'block');
    }
    function grid_emp_list() {
        var unit = document.getElementById('unit_id').value;
        var dept = document.getElementById('dept').value;
        var section = document.getElementById('section').value;
        var line = document.getElementById('line').value;
        var desig = document.getElementById('desig').value;
        var status = document.getElementById('status').value;
        if (typeof unit === "undefined" || unit === '') {
            return false;
        }
        url = hostname + "common/grid_emp_list/" + unit + "/" + dept + "/" + section + "/" + line + "/" + desig;
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                "status": status
            },
            contentType: "application/json",
            dataType: "json",


            success: function(response) {
                $('.removeTr').remove();
                if (response.length != 0) {
                    $('.removeTrno').hide();
                    var items = '';
                    $.each(response, function(index, value) {
                        items += '<tr class="removeTr">';
                        items +=
                            '<td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="' +
                            value.emp_id + '" ></td>';
                        items += '<td class="success">' + value.emp_id + '</td>';
                        items += '<td class="warning ">' + value.name_en + '</td>';
                        items += '</tr>';
                    });
                    // console.log(items);
                    $('#fileDiv tr:last').after(items);
                } else {
                    $('.removeTrno').show();
                    $('.removeTr').remove();
                }
            }
        });
    }
</script>
