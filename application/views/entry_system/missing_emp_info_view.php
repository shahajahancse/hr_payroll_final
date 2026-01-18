<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Info Missing</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 0;
    }
    .table td, .table th {
        padding: 3px;
        font-size: 12px;
    }
</style>
</head>
<body>
<div class="select_2 mt-1 pl-3 pr-2">
    <div class="row">
        <div class="col-md-12 text-center">
            <h5>Employee Information Missing</h5>
            <p>Name: <?= htmlspecialchars($emp_data[0]->name_en) ?>, ID: <?= htmlspecialchars($emp_data[0]->prev_emp_id) ?></p>
        </div>
        <table class="table table-bordered" style="width: 100%;border-collapse: collapse;" border="1">
            <thead>
                <tr>
                    <th>Efective Month</th>
                    <th>Type</th>
                    <th>Prev Dept</th>
                    <th>Prev Section</th>
                    <th>Prev Line</th>
                    <th>Prev Desig</th>
                    <th>New Dept</th>
                    <th>New Section</th>
                    <th>New Line</th>
                    <th>New Desig</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($emp_data as $info): ?>
                <tr>
                    <td><?= date('d M, Y', strtotime($info->effective_month)) ?></td>
                    <td><?= $info->status == 1 ? "Incre" : ($info->status == 2 ? "Promo" : "")?></td>
                    <td><select class="select2-dept"   name = "prev_dept_<?= $info->id ?>"></select></td>
                    <td><select class="select2-section"name = "prev_section_<?= $info->id ?>"></select></td>
                    <td><select class="select2-line"   name = "prev_line_<?= $info->id ?>"></select></td>
                    <td><select class="select2-desig"  name = "prev_desig_<?= $info->id ?>"></select></td>
                    <td><select class="select2-dept"   name = "new_dept_<?= $info->id ?>"></select></td>
                    <td><select class="select2-section"name = "new_section_<?= $info->id ?>"></select></td>
                    <td><select class="select2-line"   name = "new_line_<?= $info->id ?>"></select></td>
                    <td><select class="select2-desig"  name = "new_desig_<?= $info->id ?>"></select></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
// Initialize Select2 with pre-selected option
function initSelect2(selector, url, selectedId, selectedText = '') {
    if (selectedId && selectedText) {
        let option = new Option(selectedText, selectedId, true, true);
        $(selector).append(option).trigger('change');
    }

    $(selector).select2({
        width: '100%',
        placeholder: 'Select an option',
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return { results: data };
            }
        }
    });
}

// AJAX function to update field
function updateField(id, field, value) {
    $.ajax({
        url: "<?= base_url('entry_system_con/update_missing_field') ?>",
        type: "POST",
        data: { id: id, field: field, value: value },
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status === 'success') {
                console.log(field + ' updated successfully for ID ' + id);
            } else {
                console.error('Update failed: ' + response.msg);
            }
        },
        error: function () {
            console.error('Error connecting to server.');
        }
    });
}

<?php foreach ($emp_data as $info): ?>
// Initialize Select2 fields
initSelect2('select[name="prev_dept_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_departments") ?>', <?= $info->prev_dept ?: 'null' ?>, '<?= addslashes($info->prev_dept_name) ?>');
initSelect2('select[name="new_dept_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_departments") ?>', <?= $info->new_dept ?: 'null' ?>, '<?= addslashes($info->new_dept_name) ?>');

initSelect2('select[name="prev_section_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_sections") ?>', <?= $info->prev_section ?: 'null' ?>, '<?= addslashes($info->prev_section_name) ?>');
initSelect2('select[name="new_section_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_sections") ?>', <?= $info->new_section ?: 'null' ?>, '<?= addslashes($info->new_section_name) ?>');

initSelect2('select[name="prev_line_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_lines") ?>', <?= $info->prev_line ?: 'null' ?>, '<?= addslashes($info->prev_line_name) ?>');
initSelect2('select[name="new_line_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_lines") ?>', <?= $info->new_line ?: 'null' ?>, '<?= addslashes($info->new_line_name) ?>');

initSelect2('select[name="prev_desig_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_designations") ?>', <?= $info->prev_desig ?: 'null' ?>, '<?= addslashes($info->prev_desig_name) ?>');
initSelect2('select[name="new_desig_<?= $info->id ?>"]', '<?= base_url("entry_system_con/get_designations") ?>', <?= $info->new_desig ?: 'null' ?>, '<?= addslashes($info->new_desig_name) ?>');

// Attach onchange handlers
$('select[name="prev_dept_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'prev_dept', $(this).val());
});
$('select[name="prev_section_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'prev_section', $(this).val());
});
$('select[name="prev_line_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'prev_line', $(this).val());
});
$('select[name="prev_desig_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'prev_desig', $(this).val());
});

$('select[name="new_dept_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'new_dept', $(this).val());
});
$('select[name="new_section_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'new_section', $(this).val());
});
$('select[name="new_line_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'new_line', $(this).val());
});
$('select[name="new_desig_<?= $info->id ?>"]').on('change', function() {
    updateField(<?= $info->id ?>, 'new_desig', $(this).val());
});
<?php endforeach; ?>
</script>
</body>
</html>
