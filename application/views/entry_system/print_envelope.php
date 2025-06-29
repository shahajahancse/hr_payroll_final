<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Envelope</title>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    @media print {
        @page {
            size: 926px 416px;
            margin: 0; /* Remove default margins */
        }
        body {
            display: block;
            justify-content: space-between;
            align-items: center;
            height: 100vh; /* Full height to center content vertically */
        }
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
        justify-content: center;  
        align-items: center;      
        height: 80vh;     
        
        
            display: block;
            justify-content: space-between;
            align-items: center;
            height: 100vh; 
    }
    .order-box {
        width: 926px;  
        height: 416px; 
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }
    .left-section {
        /* width: 50%; */
        width: 100%;
        font-size: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .logo {
        display: flex;
        align-items: center;
    }
    .logo img {
        width: 90px;
        height: 50px;
        margin-right: 10px;
    }
    .company-details {
        font-weight: bold;
        margin-bottom: 5px;
        font-family: 'SutonnyMJ'
    }
    .company-address {
        font-size: 18px;
        color: #555;
        font-family: 'SutonnyMJ'
    }
    .right-section {
        width: 100%;
        place-content: center !important;
    }
    .form-table {
        width: 90%;
        /* height: 70vh; */
        border-collapse: collapse;
    }
    .form-table td {
        padding: 2px;
        font-size: 16px !important;
        vertical-align: middle;
    }
    .form-table th {
        padding: 2px;
        vertical-align: middle;
    }
</style>
</head>
<body>
    <?php
		$unit_id = $this->session->userdata('data');
		if ($unit_id->unit_name== 0) {
			echo "Please Login as unit user (Not allow Super admin)";
			exit();
		}
        $com_info = $this->db->where('unit_id',$unit_id->unit_name)->get('company_infos')->row()
    ?>

    <div class="order-box" style="height: 416px; width: 926px;">
        <div class="container">
            <!-- Left Section with Logo and Company Details -->
            <div class="left-section">
                <div class="logo">
                    <img src="<?php echo base_url('images/AJ_Logo_copy5.png')?>" alt="Logo">
                    <div>
                        <div class="company-details"><?=$com_info->company_name_bangla ?></div>
                        <div class="company-address">
                            <?=$com_info->company_add_bangla ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section with Form using Table -->
            <div class="right-section">
                <table class="form-table" style='margin-left: 40px;line-height: 30px'>
                    <tr>
                        <td><strong>প্রাপক,</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="form-label">নাম</td>
                        <td class="colon">: <?= $info->name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">পিতার নাম</td>
                        <td class="colon">: <?= $info->father_name ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>বর্তমান ঠিকানা</strong></td>
                    </tr>
                    <tr>
                        <td class="form-label">গ্রাম</td>
                        <td class="colon">: <?= $info->pre_village_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">পোস্ট অফিস</td>
                        <td class="colon">: <?= $info->pre_post_name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">থানা</td>
                        <td class="colon">: <?= $info->pre_upa_name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">জেলা</td>
                        <td class="colon">: <?= $info->pre_dis_name_bn ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="clear-fix"></div>

    <div class="order-box" style="height: 416px; width: 926px;">
        <div class="container">
            <!-- Left Section with Logo and Company Details -->
            <div class="left-section">
                <div class="logo">
                    <img src="<?php echo base_url('images/AJ_Logo_copy5.png')?>" alt="Logo">
                    <div>
                        <div class="company-details"><?=$com_info->company_name_bangla ?></div>
                        <div class="company-address">
                            <?=$com_info->company_add_bangla ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section with Form using Table -->
            <div class="right-section">
                <table class="form-table" style='margin-left: 40px;line-height: 30px'>
                    <tr>
                        <td><strong>প্রাপক,</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="form-label">নাম</td>
                        <td class="colon">: <?= $info->name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">পিতার নাম</td>
                        <td class="colon">: <?= $info->father_name ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>স্থায়ী ঠিকানা</strong></td>
                    </tr>
                    <tr>
                        <td class="form-label">গ্রাম</td>
                        <td class="colon">: <?= $info->per_village_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">পোস্ট অফিস</td>
                        <td class="colon">: <?= $info->per_post_name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">থানা</td>
                        <td class="colon">: <?= $info->per_upa_name_bn ?></td>
                    </tr>
                    <tr>
                        <td class="form-label">জেলা</td>
                        <td class="colon">: <?= $info->per_dis_name_bn ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div style="page-break-after: always"></div>
</body>
</html>
