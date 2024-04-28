<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>
        Separation Report
    </title>
</head>
<body>
<?php 
    $data['unit_id'] = $unit_id;
    $this->load->view("head_english",$data);
?>
    <?php 
    $done_list = array();
    $not_done_list = array();

        foreach ($emp_id as $key => $emp) {
            $this->db->select('emp_id');
            $this->db->from('training_management');
            $this->db->where('emp_id', $emp);
            $this->db->where('training_id', $training_id);
            $done = $this->db->get()->result();
            if (!empty($done)) {
                $done_list[] = $emp;
            } else {
                $not_done_list[] = $emp;
            }
        }
        if ($type==0) {
            
            $this->db->select('training_management.*,pr_units.unit_name,training_type.title as training_name,pr_emp_per_info.name_en as emp_name');
            $this->db->from('training_management');
            $this->db->join('pr_units', 'pr_units.unit_id = training_management.unit_id');
            $this->db->join('training_type', 'training_type.id = training_management.training_id');
            $this->db->join('pr_emp_com_info', 'pr_emp_com_info.id = training_management.emp_id');
            $this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id', 'left');
            $this->db->where_in('training_management.emp_id', $done_list);
            $this->db->where('training_management.training_id', $training_id);
            $done= $this->db->get()->result();
            ?>
            <h3  align="center" height="auto">Done Training List</h3>
            <table class="heading"  border="1" cellspacing="0" align="center" height="auto">
                <thead>
                    <tr>
                        <th style="width: 200px;">Employee Name</th>
                        <th style="width: 200px;">Training Name</th>
                        <th style="width: 200px;">Unit Name</th>
                        <th style="width: 200px;">Date</th>
                        <th style="width: 200px;">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($done as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value->emp_name; ?></td>
                            <td><?php echo $value->training_name; ?></td>
                            <td><?php echo $value->unit_name; ?></td>
                            <td><?php echo $value->date; ?></td>
                            <td><?php echo $value->time; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php }elseif ($type==1) {
        $this->load->model('grid_model');
        $not_done=$this->grid_model->grid_employee_information2($not_done_list);
            ?>
            <h3  align="center" height="auto" >Not Done Training List</h3>
            <table class="heading" border="1" cellspacing="0"  align="center" height="auto">
                <thead>
                    <tr>
                        <th style="width: 200px;">SL.</th>
                        <th style="width: 200px;">Employee ID</th>
                        <th style="width: 200px;">Employee Name</th>
                        <th style="width: 200px;">Line Name</th>
                        <th style="width: 200px;">Designation Name</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($not_done as $key => $value) {
                        ?>
                        <tr>
                        <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value->emp_id; ?></td>
                            <td><?php echo $value->name_en; ?></td>
                            <td><?php echo $value->line_name_en; ?></td>
                            <td><?php echo $value->desig_name; ?></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php }
        ?>
</body>
</html>