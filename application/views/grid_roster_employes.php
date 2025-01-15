<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Daily Roster Report</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />

</head>

<style>

 

      /*  .sal .trd td {
	     	padding: 4px;
	    }
     }

    .sal .trd td {
     	padding: 8px;
    }*/
        table {
            width: 80%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
      /*  th, td {
            padding: 4px;
            text-align: left;
        }*/
         @media print {
     	  table {
	            width: 100%;
	            border-collapse: collapse;
	        }
	        .shift-name {
	            page-break-after: always;
	        }
	              .print-table {
            height: 100%; /* Set the maximum height for the table */
        }

        .print-table tr {
            height: 25px; /* Set the height of each row */
        	/*margin-bottom: 20px;*/
        }
    }
   		 }
</style>

<body>
	<?php $this->load->view("head_english"); ?>
        <div style="text-align: center; font-weight: bold;">Date : <?php echo $firstdate; ?></div>
	      <br><br>
        <?php
			// Your array of data
			$groupedData = array();
			foreach ($values as $item) {
			    $shiftName = $item->shift_name;
			    if (!isset($groupedData[$shiftName])) {
			        $groupedData[$shiftName] =array();
			    }
			    $groupedData[$shiftName][] = $item;
			}
		?>
	<?php foreach ($groupedData as $shiftName => $shiftData) { ?>
        <table class="print-table" border="1" style="margin: 0 auto;">
            <tr>
                <td colspan="9"  style="text-align: center; margin-bottom: 20px;">
				    Shift Name: <?php echo $shiftName; ?>
				</td>
            </tr>
            <tr>
                <th>Sl.</th>
                <th>ID</th>
                <th>Full Name</th>
                <th>Designation</th>
                <th>Join Date</th>
                <!-- <th>Department Name</th> -->
                <th>Section</th>
                <th>Line</th>
            </tr>
            <?php $i=1; foreach ($shiftData as $item) { ?>
                <tr>
                    <td><?php echo $i++?></td>
                    <td><?php echo $item->emp_id; ?></td>
                    <td><?php echo $item->emp_full_name; ?></td>
                    <td><?php echo $item->desig_name; ?></td>
                    <td><?php echo $item->emp_join_date; ?></td>
                    <!-- <td><?php echo $item->dept_name; ?></td> -->
                    <td><?php echo $item->sec_name; ?></td>
                    <td><?php echo $item->line_name; ?></td>
                </tr>
            <?php } ?>
        </table>
        <!-- <div class="shift-name"></div> -->
    <?php } ?>
</body>
</html>