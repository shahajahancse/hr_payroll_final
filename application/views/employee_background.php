<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Background</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .table-wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .table-custom {
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            padding: 1rem;
        }

        .table {
            width: 100%;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.2rem;
        }

        .table th, .table td {
            vertical-align: middle !important;
            padding: 0.75rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .section-title {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 1.3rem;
            font-weight: bold;
        }

        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-custom">
                <div class="section-title">Personal Information</div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <!-- < ?php dd($values)?> -->
                      
                        <tr>
                            <th style='width:25%'>Employee ID</th><td style='width:25%'><?= $values->emp_id?></td>
                            <th style='width:25%'>Employee Name</th><td style='width:25%;white-space:nowrap'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Father's Name</th><td style='width:25%'><?= $values->father_name?></td>
                            <th style='width:25%'>Mother's Name</th><td style='width:25%'><?= $values->mother_name?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Date of Birth</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Gender</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Present Address</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Permanent Address</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Marital Status</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Spouse Name</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Blood Group</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Religion</th><td style='width:25%'> <?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Phone Number</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>NID/Birth Certificate</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Education</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Height</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>Male Child</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>Female Child</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th style='width:25%'>বিভাগ</th><td style='width:25%'><?= $values->name_en?></td>
                            <th style='width:25%'>পদবী</th><td style='width:25%'><?= $values->name_en?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="section-title mt-4">Official Information</div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Department</th><td><?= $values->name_en?></td>
                            <th>Section</th><td><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th>Line</th><td><?= $values->name_en?></td>
                            <th>Designation</th><td><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th>Employee Status</th><td><?= $values->name_en?></td>
                            <th>Employee Type</th><td><?= $values->name_en?></td>
                        </tr>
                        <tr>
                            <th>Joining Date</th><td><?= $values->name_en?></td>
                            <th>Current Salary</th><td><?= $values->name_en?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
