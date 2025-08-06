<script src="<?php echo base_url(); ?>js/grid_content.js" type="text/javascript"></script>
<style>
#fileDiv #removeTr td {
    padding: 5px 10px !important;
    font-size: 14px;
}
</style>
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

<?php
	$this->load->model('common_model');
	$unit = $this->session->userdata('unit_name');
?>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <?php $success = $this->session->flashdata('success');
	        if ($success != "") { ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } 
	         $error = $this->session->flashdata('error');
	         if ($error) { ?>
            <div class="alert alert-failuer"><?php echo $error; ?></div>
            <?php } ?>
        </div>
				<script>
			$(document).ready(function() {
			setTimeout(function() {
				$('.alert-success, .alert-failuer').fadeOut('slow');
			}, 2000);
			});
		</script>
    </div>
    <!-- <div class="container-fluid">	 -->
    <div class="col-md-8">
        <div class="row tablebox" style="display: block;">
            <div class="col-md-12" style="display: flex;justify-content: space-between;align-items: center;">
                <h3 style="font-weight: 600;"><?= $title ?></h3>
                                <div>
                    <!-- <a class="btn btn-info" href="< ?php echo base_url('setup_con/emp_shift_change') ?>">< < Back</a> -->
                    <a class="btn btn-primary" href="<?php echo base_url('payroll_con') ?>">Home</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Unit <span style="color: red;">*</span> </label>
                    <select name="unit_id" id="unit_id" class="form-control input-sm">
                        <option value="">Select Unit</option>
                        <?php 
							foreach ($dept as $row) {
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
                <div class="form-group">
                    <label>Department </label>
                    <select class="form-control input-sm dept" id='dept' name='dept'>
                        <?php if (!empty($user_data->unit_name)) { 
										$dpts = $this->db->where('unit_id', $user_data->unit_name)->get('emp_depertment'); ?>
                        <option value=''>Select Department</option>
                        <?php foreach ($dpts->result() as $key => $val) { ?>
                        <option value='<?= $val->dept_id ?>'><?= $val->dept_name ?></option>
                        <?php } } ?>
                        <option value=''>Select Department</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div id='loaader' style="display: none;align-items: center;justify-content: center;z-index: 33333;background: #e9e9e966;position: absolute;" class="col-md-12">
            
        </div>
       		<form action="<?= base_url('setup_con/shiftChanged')?>" enctype="multipart/form-data" method="post">
            <div class="row nav_head" style="display: flex;flex-direction: column;">

                <div class="col-lg-12">
                    <span style="font-size: 20px;"><?= $title ?> </span>
                </div><!-- /.col-lg-6 -->
                <br>
		
        
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php 
                                    $shifts = $this->db->select('*')->where('unit_id',$_SESSION['data']->unit_name)->get('pr_emp_shift')->result();
                                    // dd($_SESSION);
                                ?>
                                <select name="shift_type" class="form-control input-sm" id="shift_type">
                                        <option value="">Select Shift</option>
                                        <?php foreach($shifts as $shift){ ?>
                                        <option value="<?= $shift->id ?>"><?= $shift->shift_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="pull-left">
                                    <button type="button" name="submit" onclick = "changeShift()" class="btn btn-success btn-sm" >Submit</button>
                                    <button name="cancle" class="btn btn-warning btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                </div>
        <!-- </form>	 -->
            </div><!-- /.row -->
        
    </div>

    <!-- employee list for right side -->
    <div class="col-md-4 tablebox">
        <input type="text" id="searchi" class="form-control" placeholder="Search">
        <div style="height: 80vh; overflow-y: scroll;">
            <table class="table table-hover" id="fileDiv">
                <thead>
                    <tr style="position: sticky;top: 0;z-index:1">
                        <th class="active" style="width:10%"><input type="checkbox" id="select_all" class="select-all checkbox" name="select-all"></th>
                        <th class="" style="background:#0177bcc2;color:white">Id</th>
                        <th class=" text-center" style="background:#0177bc;color:white">Name</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php if (!empty($employees)) {
                        foreach ($employees as $key => $emp) {
                    ?>
                            <tr class="removeTr">
                                <td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id" value="<?= $emp->emp_id ?>">
                                </td>
                                <td class="success"><?= $emp->emp_id ?></td>
                                <td class="warning "><?= $emp->name_en ?></td>
                            </tr>
                    <?php }
                    } ?>
                    <tr class="removeTrno">
                        <td colspan="3" class="text-center"> No data found</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
	</form>
    <!-- </div> -->
</div>

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

<script type="text/javascript">
    // on load employee
    function grid_emp_list() {
        var unit = document.getElementById('unit_id').value;
        var dept = document.getElementById('dept').value;
        var section = document.getElementById('section').value;
        var line = document.getElementById('line').value;
        var desig = document.getElementById('desig').value;
        var status = document.getElementById('status').value;

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
                        items += `
                            <tr class="removeTr">
                                <td><input type="checkbox" class="checkbox" id="emp_id" name="emp_id[]" value="${value.emp_id }" ></td>
                                <td class="success">${value.emp_id}</td>
                                <td class="warning ">${value.name_en}</td>
                            </tr>`
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
                    $('.desig').append("<option value=''>-- Select District --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.desig').append(opt);
                    });
                }
            });
            // load employee
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
                    $('.line').append("<option value=''>-- Select District --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.line').append(opt);
                    });
                }
            });
            // load employee
            grid_emp_list();
        });

        //section dropdown
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
                    $('.section').append("<option value=''>-- Select District --</option>");
                    $.each(func_data, function(id, name) {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        $('.section').append(opt);
                    });
                }
            });
            // load employee
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
            // load employee
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
    }


</script>

<script>
function changeShift(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}


    var shift_type = document.getElementById('shift_type').value;
    if (shift_type == '') {
        alert('Please select shift type');
        return false;
    }
	var checkboxes = document.getElementsByName('emp_id[]');
	var sql = get_checked_value(checkboxes);

	if (document.getElementsByName('emp_id') == '') {
		alert('Please select employee Id');
		return false;
	}


	url =  hostname + "Setup_con/changeShift/";
	var queryString="emp_id="+sql+"&shift_type="+shift_type;

    ajaxRequest.open("POST", url, true);
 	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 	ajaxRequest.send(queryString);

	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			alert(resp);
		}
	}
}

</script>
