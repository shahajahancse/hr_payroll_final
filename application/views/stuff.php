<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your New Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        @media print{
        .break_page{
            page-break-before: always;
            }

        }
        p{
            margin-bottom: 5px !important;
        }
        h3{
            font-size: 1.5rem;
        }
        body {
            font-family: "The Times Roman";
        }
        p{
            font-size: 18px !important;
        }
    </style>
</head>

<body style="margin: 0px auto">
        <?php foreach($values as $value){?>
    <!-- niog -->
    <div class="container break_page">
        <?php $unit_id= $this->session->userdata('data')->unit_name; if($unit_id ==1){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :03.10.2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : AJFL/HRAC(HR)/03/006</p>
        </div>
        <?php } else if($unit_id == 2){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :01-01-2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code :  LSAL/HR/03/083</p>
        </div>
        <?php }else if($unit_id == 4){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/006</p>
        </div>
        <?php }?>
        <div class="mt-3">
            <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
            <div class="d-flex">
                <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="width: 60px;height: 50px;position: absolute;">
                <h4 class="text-center" style="margin:0 auto"><?= $com_info->company_name_english ?></h4>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h6"><?= $com_info->company_add_english ?></p>
        </div>
        <div>

        <div class="d-flex mt-2">
        <div class="col-md-4 ">
            <p>Ref: <?php echo $unit_id == 1? 'AJFL': ($unit_id == 2?'LSAL': ($unit_id == 4? 'HGL':'') ) ?>/HRD/AL/10069</p>
            <p>Date : <?php echo date('d/m/Y',strtotime($value->emp_join_date))?></p>
        </div>

        <div class="col-md-8">
            <p  style="float:right">Office Copy</p>
        </div>
        </div>
        <br>

        <div style="margin-left:15px ;">
            <p>To,</p> 
            <p><b> <?php echo $value->gender == 'Male' ? 'Mr.':'Mrs.'?>  <?php echo $value->name_en?></b></p>
            <p>Present Address: Vill: <?php echo $value->pre_village?>, Post: <?php echo $value->pre_dis_name_en?>, Thana: <?php echo $value->pre_upa_name_en?>, Dist: <?php echo $value->pre_post_name_en?></p>
            <p>Permanent Address: Vill: <?php echo $value->per_village?>, Post: <?php echo $value->post_name_en?>, Thana: <?php echo $value->upa_name_en?>, Dist: <?php echo $value->dis_name_en?> </p>
            <p>Mobile Number: <?php echo $value->personal_mobile?></p>
            <br>
            <p><b>Subject: Appointment Letter</b></p>
            <br>
            <p><b>Dear <?php echo $value->gender == 'Male' ? 'Mr.':'Mrs.'?> <?php echo $value->name_en?></b></p> 
            
            <p>
                With reference to your interest about our company and subsequent interview with us, the
                Management of Honeywell Garments Limited is pleased to appoint you as 
                <b><?php echo $value->desig_name?></b> id no: <b><?php echo $value->emp_id?></b> in Template from the date of <b><?php echo date('d-m-Y',strtotime($value->emp_join_date))?></b> under
                the following terms and conditions.
            </p>
            <p style="line-height:1.3">1. Your position name is <b>"<?php echo $value->desig_name?>"</b> in <b><?php echo $value->line_name_en?></b>, <b><?php echo $value->sec_name_en?></b> section for Honeywell Garments Limited, 799, (Old Plot No -1010/1011) Ambag, Mouza Baghia, Konabari, Gazipur-1700. </p>
            <p style="line-height:1.3">2. Your probationary period will be 06 (Six) month. </p>
            <p style="line-height:1.3">3. After successful completion of probation period you will be issued service confirmation letter. </p>
            <p style="line-height:1.3">4. Your appraisal will be made at the end of calendar year of your service. </p>
            <p style="line-height:1.3">5. You will get one day off per week. but definitely that day will be fixed by the company. </p>
            <p style="line-height:1.3">6. Your leaves and holidays entitlement will be as per company's "Leave Policy". </p>
            <p style="line-height:1.3">7. Your salary deduction of tax as per government rules.</p>
            <p style="line-height:1.3">8. Your consolidated salary shall be as follow:</p>

            <table>
                <tr>
                    <th>Basic</th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td> 
                     <td>&nbsp;&nbsp;<?php $basic = round(($value->salary -(1250+450+750)) / 1.5); echo $basic;?></td>
                     <td>&nbsp;&nbsp;TK</td>
                </tr>
                <tr>
                    <th> House Rent </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;<?php echo round($basic/2)?> </td>
                     <td>&nbsp;&nbsp;TK</td>

                </tr>
                <tr>
                    <th>Medical </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;750 </td>
                     <td>&nbsp;&nbsp;TK</td>
                                      
                </tr>
                <tr>
                    <th>Transport </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;450 </td>
                     <td>&nbsp;&nbsp;TK</td>
                 </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Food </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;1250 </td>
                     <td>&nbsp;&nbsp;TK </td>
                </tr>
                <tr>
                    <th>Total  Salary </th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                    <td>&nbsp;&nbsp;<b><?php echo $value->salary?></b></td>
                    <td>&nbsp;&nbsp;TK </td>
                </tr>
            </table>

            <p style="line-height:1.3">9. You need to follow the company rules regulations and policies. Breaking of any such may cause the termination of
            your service of AJ Group.</p>
            
          
            <p style="line-height:1.3">10. At least 2 (two) months’ notice in writing must be given if you intend to discontinue your employment with the
            company at any time. Company also can discontinue your service by providing two months’ notice period or pay two
            months’ basic salary.</p>
            <p>Thank you to be a member of AJ Group family.</p>
            <br>
            <p>Thanking You </p>
            <br><br>
            <p>
                Maminul Islam
            </p>
            <p>Group - General Manager</p>
            <p>HR. Admin Compliance</p>
            <p>AJ Group.<span style="float:right">Signature...................√.............</span></p>
            <p style="line-height:1.3">CC: 1) Personal File.</p>
            <p style="line-height:1.3">2) HRD Department.</p>
            <p style="line-height:1.3">3) Accounts Department.</p>
            
        </div>
        <?php }?>
    </div>
      <br> 
      
    <?php foreach($values as $value){?>
      
    <div class="container break_page">
       <?php $unit_id= $this->session->userdata('data')->unit_name; if($unit_id ==1){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :03.10.2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : AJFL/HRAC(HR)/03/006</p>
        </div>
        <?php } else if($unit_id == 2){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :01-01-2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code :  LSAL/HR/03/083</p>
        </div>
        <?php }else if($unit_id == 4){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/006</p>
        </div>
        <?php }?>
        <div class="mt-3">
            <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
            <div class="d-flex">
                <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="width: 60px;height: 50px;position: absolute;">
                <h4 class="text-center" style="margin:0 auto"><?= $com_info->company_name_english ?></h4>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h6"><?= $com_info->company_add_english ?></p>
        </div>
        <div>

        <div class="d-flex mt-2">
        <div class="col-md-4 ">
            <p>Ref: <?php echo $unit_id == 1? 'AJFL': ($unit_id == 2?'LSAL': ($unit_id == 4? 'HGL':'') ) ?>/HRD/AL/10069</p>
            <p>Date : <?php echo date('d/m/Y',strtotime($value->emp_join_date))?></p>
        </div>

        <div class="col-md-8">
            <p  style="float:right">Employee Copy</p>
        </div>
        </div>
        <br>
        <div style="margin-left:15px ;">
            <p>To,</p> 
            <p><b> <?php echo $value->gender == 'Male' ? 'Mr.':'Mrs.'?>  <?php echo $value->name_en?></b></p>
            <p>Present Address: Vill: <?php echo $value->pre_village?>, Post: <?php echo $value->pre_dis_name_en?>, Thana: <?php echo $value->pre_upa_name_en?>, Dist: <?php echo $value->pre_post_name_en?></p>
            <p>Permanent Address: Vill: <?php echo $value->per_village?>, Post: <?php echo $value->post_name_en?>, Thana: <?php echo $value->upa_name_en?>, Dist: <?php echo $value->dis_name_en?> </p>
            <p>Mobile Number: <?php echo $value->personal_mobile?></p>
            <br>
            <p><b>Subject: Appointment Letter</b></p>
            <br>
            <p><b>Dear  <?php echo $value->gender == 'Male' ? 'Mr.':'Mrs.'?>  <?php echo $value->name_en?></b></p> 
            
            <p>
                With reference to your interest about our company and subsequent interview with us, the
                Management of Honeywell Garments Limited is pleased to appoint you as 
                <b><?php echo $value->desig_name?></b> id no: <b><?php echo $value->emp_id?></b> in Template from the date of <b><?php echo date('d-m-Y',strtotime($value->emp_join_date))?></b> under
                the following terms and conditions.
            </p>
            <p>1. Your position name is <b>"<?php echo $value->desig_name?>"</b> in <b><?php echo $value->line_name_en?></b>, <b><?php echo $value->sec_name_en?></b> section for Honeywell Garments Limited, 799, (Old Plot No -1010/1011) Ambag, Mouza Baghia, Konabari, Gazipur-1700. </p>
            <p>2. Your probationary period will be 06 (Six) month. </p>
            <p>3. After successful completion of probation period you will be issued service confirmation letter. </p>
            <p>4. Your appraisal will be made at the end of calendar year of your service. </p>
            <p>5. You will get one day off per week. but definitely that day will be fixed by the company. </p>
            <p>6. Your leaves and holidays entitlement will be as per company's "Leave Policy". </p>
            <p>7. Your salary deduction of tax as per government rules.</p>
            <p>8. Your consolidated salary shall be as follow:</p>

            <table>
                <tr>
                    <th>Basic</th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;:</td> 
                     <td>&nbsp;&nbsp;<?php $basic = round(($value->salary -(1250+450+750)) / 1.5); echo $basic;?></td>
                     <td>&nbsp;&nbsp;TK</td>
                </tr>
                <tr>
                    <th> House Rent </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;<?php echo round($basic/2)?> </td>
                     <td>&nbsp;&nbsp;TK</td>

                </tr>
                <tr>
                    <th>Medical </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;750 </td>
                     <td>&nbsp;&nbsp;TK</td>
                                      
                </tr>
                <tr>
                    <th>Transport </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;450 </td>
                     <td>&nbsp;&nbsp;TK</td>
                 </tr>
                <tr style="border-bottom: 1px solid black;">
                    <th>Food </th>
                     <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td> 
                     <td>&nbsp;&nbsp;1250 </td>
                     <td>&nbsp;&nbsp;TK </td>
                </tr>
                <tr>
                    <th>Total  Salary </th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;: </td>
                    <td>&nbsp;&nbsp;<?php echo $value->salary?></td>
                    <td>&nbsp;&nbsp;TK </td>
                </tr>
            </table>

            <p>9. You need to follow the company rules regulations and policies. Breaking of any such may cause the termination of
            your service of AJ Group.</p>
            
          
            <p>10. At least 2 (two) months’ notice in writing must be given if you intend to discontinue your employment with the
            company at any time. Company also can discontinue your service by providing two months’ notice period or pay two
            months’ basic salary.</p>
            <p>Thank you to be a member of AJ Group family.</p>
            <p>Thanking You </p>
            <p>
                Maminul Islam
            </p>
            <p>Group - General Manager</p>
            <p>HR. Admin Compliance</p>
            <p>AJ Group.<span style="float:right">Signature...................√.............</span></p>
            <p>CC: 1) Personal File.</p>
            <p>2) HRD Department.</p>
            <p>3) Accounts Department.</p>
            
        </div>
        <?php }?>
    </div>

</body>
</html>