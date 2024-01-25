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
    <!-- niog -->
    <div class="container break_page">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>

        <?php 
            $image = $this->db->select('company_logo')->get('company_infos')->row()->company_logo;
        ?>

        <div class="d-flex justify-content-between mt-3">
                <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 8%">
            <!-- <div class="col-md-12"> -->
                <h1 class="">Honeywell Garments Ltd. </h1>
            <!-- </div> -->
            <br>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">799,(Old Plot No-1010/1011) Ambag,Mouza Baghia, Konabari, Gazipur -1700</p>
        </div>
        <div>

        <div class="d-flex mt-2">
        <div class="col-md-4 ">
            <p>Ref: HGL/HRD/AL/10069</p>
            <p>Date :</p>
        </div>

        <div class="col-md-8">
            <p  style="float:right">Office Copy</p>
        </div>
        </div>
        <br>
        <?php foreach($values as $value){?>
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
    <div class="container break_page">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>

        <?php 
            $image = $this->db->select('company_logo')->get('company_infos')->row()->company_logo;
        ?>

        <div class="d-flex justify-content-between mt-3">
            <!-- <div class="col-md-2 "> -->
                <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 8%;">
            <!-- </div> -->
            <!-- <div class="col-md-9"> -->
                <h1 class="">Honeywell Garments Ltd. </h1>
            <!-- </div> -->
            <!-- <div class="col-md-1"></div> -->
            <br>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">799,(Old Plot No-1010/1011) Ambag,Mouza Baghia, Konabari, Gazipur -1700</p>
        </div>
        <div>

        <div class="d-flex mt-2">
        <div class="col-md-4 ">
            <p>Ref: HGL/HRD/AL/10069</p>
            <p>Date :</p>
        </div>

        <div class="col-md-8">
            <p  style="float:right">Employee Copy</p>
        </div>
        </div>
        <br>
        <?php foreach($values as $value){?>
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