<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Continuous <?php echo $status; ?> Report</title>
    <link rel="stylesheet" type="text/css" href="../../../../../../css/SingleRow.css" />

    <style>
        @media print {
            .page_break {
                page-break-before: always;
            }
            @page {
                size: auto;
                margin: 00mm;
            }
        }

        .print_src {
            width: 75%;
            margin: 0 auto;
			white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 0px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class='print_src'>
        <?php 
        $counter = 0; // Initialize row counter
        foreach ($values as $key => $row) { 

            // If it's the first row or after every 60 rows, print the heading and table headers again
            if ($counter % 60 == 0) {
                if ($counter != 0) {
                    echo "<div class='page_break'></div>"; // Page break for print
                }

                // Print heading on every new page
                $this->load->view("head_english");
                echo "<div align='center'>
                        <span style='font-size:13px; font-weight:bold;'>
                            {$status} Report from " . date("d-M-Y", strtotime($start_date)) . " - TO - " . date("d-M-Y", strtotime($end_date)) . "
                        </span>
                      </div><br>";

                // Start table with thead
                echo "<table>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Emp ID</th>
                                <th>Name</th>
                                <th>Line</th>
                                <th>Leave Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Total Leave</th>
                                <th>Purpose</th>
                            </tr>
                        </thead>
                        <tbody>";
            }

            // Convert leave type
            $leave_types = [
                'cl' => 'Casual Leave',
                'sl' => 'Sick Leave',
                'ml' => 'Maternity Leave',
                'wp' => 'Without Pay',
                'el' => 'Earn Leave',
                'do' => 'Day Off Leave'
            ];
            $leave_type = isset($leave_types[$row->leave_type]) ? $leave_types[$row->leave_type] : 'Other';

            // Print table row
            echo "<tr>
                    <td>" . ($key + 1) . "</td>
                    <td>{$row->emp_id}</td>
                    <td>{$row->name_en}</td>
                    <td>{$row->line_name_en}</td>
                    <td>{$leave_type}</td>
                    <td>" . date('Y-m-d', strtotime($row->leave_start)) . "</td>
                    <td>" . date('Y-m-d', strtotime($row->leave_end)) . "</td>
                    <td>{$row->total_leave}</td>
                    <td>{$row->leave_descrip}</td>
                  </tr>";

            $counter++;

            // Close the table every 60 rows to ensure a new page starts
            if ($counter % 60 == 0) {
                echo "</tbody></table>";
            }
        } 

        // Close the last table if it's not already closed
        if ($counter % 60 != 0) {
            echo "</tbody></table>";
        }
        ?>
    </div>
</body>
</html>

<?php exit(); ?>
