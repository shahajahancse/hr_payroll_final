<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Employee Status Report</title>

<!-- Bootstrap 4.6 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">

<style>
/* Force table borders visible */

.bordered {
    border: 1px solid black;
    border-collapse: collapse;
	font-size:14px;
	border-radius:3px;
	margin: 0 auto;
	width: 80%;
}
.bordered td, .bordered th {
    border: 1px solid #060606ff;
	padding: 5px;
	
}
.bordered th {
   background: #ffffffff;
}

</style>
</head>

<body class="container my-4">

    <div class="text-center mb-4">
        <?php $this->load->view("head_english"); ?>
        <h5 style="text-align:center">Employee Status Report <?php echo date("F-Y", strtotime($month)) ?></h5>
    </div>

    <div class="table-responsive">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Line</th>
                    <th>Section</th>
                    <th>Designation</th>
                    <th>Current Status</th>
                    <th>Salary Status</th>
                    <th>Salary Status Com</th>
                </tr>
            </thead>
            <tbody>
				<?php
					$statusMap = [
						1 => 'Regular',
						2 => 'Left',
						3 => 'Resign'
					];
				?>

				<?php foreach ($values as $k => $row): ?>
					<tr>
						<td><?= $k+1 ?></td>
						<td><?= $row->emp_id ?></td>
						<td><?= $row->name_en ?></td>
						<td><?= $row->line_name_en ?></td>
						<td><?= $row->sec_name_en ?></td>
						<td><?= $row->desig_name ?></td>

						<!-- pr_emp_com_info.emp_cat_id -->
						<td style="text-align:center">
							<select class="form-control form-control-sm status-select" 
									data-id="<?= $row->emp_id ?>" 
									data-table="pr_emp_com_info"
									data-field="emp_cat_id">
								<?php foreach ($statusMap as $key => $label): ?>
									<option value="<?= $key ?>" <?= ($row->emp_cat_id == $key ? 'selected' : '') ?>>
										<?= $label ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>

						<!-- pay_salary_sheet.emp_status -->
						<td style="text-align:center">
							<select class="form-control form-control-sm status-select" 
									data-id="<?= $row->emp_id ?>" 
									data-table="pay_salary_sheet"
									data-field="emp_status">
								<?php foreach ($statusMap as $key => $label): ?>
									<option value="<?= $key ?>" <?= ($row->emp_status == $key ? 'selected' : '') ?>>
										<?= $label ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>

						<!-- pay_salary_sheet_com.emp_status -->
						<td style="text-align:center">
							<select class="form-control form-control-sm status-select" 
									data-id="<?= $row->emp_id ?>" 
									data-table="pay_salary_sheet_com"
									data-field="emp_status">
								<?php foreach ($statusMap as $key => $label): ?>
									<option value="<?= $key ?>" <?= ($row->emp_status_com == $key ? 'selected' : '') ?>>
										<?= $label ?>
									</option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
				<?php endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Bootstrap 4.6 JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on("change", ".status-select", function () {
    let empId = $(this).data("id");        
    let table = $(this).data("table");    
    let field = $(this).data("field");    
    let value = $(this).val();       


	if (!confirm("Are you sure you want to change the status?")) {
		// reset the dropdown back to previous value if cancelled
		$(this).val($(this).data("old-value"));
		return false; 
    }      
	
    $.ajax({
        url: "<?= site_url('grid_con/update_status') ?>", 
        type: "POST",
        data: { emp_id: empId, table: table, field: field, value: value },
        success: function (response) {
            alert("Updated successfully.");
			// check_status();
        },
        error: function () {
            alert("Failed to update. Try again.");
        }
    });
});

$(document).on("focus", ".status-select", function () {
    $(this).data("old-value", $(this).val());
});
</script>


</body>
</html>
