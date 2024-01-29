<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
   body {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }
    .box {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 290px;
      height:440px;
      margin: 19px;
      border: 1px solid #ccc;
      position: relative;
    }

    .container-fluid {
      display: flex;
      flex-wrap: wrap;
    }
    p{
      margin: 1px;
      padding: 1px;
      font-size: 15px;
    }
    .box-img{
      width: 100px;
      height: 110px;
      border: 1px solid black;
      margin: 0 75px;
    }
    .left_content{
      display: flex;
      flex-direction: column;
      align-items: start;
      width:93%;
    }
    .d_flex {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 93%;
      margin-top: 35px;
    }
      @media print {

        @page {
          size: A4;
        }

        .box {
          width: 288px;
          height:338px;
          margin: 19px;
        }
        h6{
          font-size: 22px !important;
        }
        p{
          font-size: 15px;
        }
         .left_content{
          width: 93%;
        }
        .p_padding{
          padding: 0;
          line-height: 18px;
          font-size: 13px !important;
        }
      }
      .page_break{
        page-break-after: always;
      }
  </style>
  <title>Id Card English</title>
</head>

<body>

  <div class="container-fluid">
    <!-- < ?php dd($values)?> -->
    <?php foreach($values as $value){?>
      <div class="page_break" style="margin-left:-10px">
        <div class="box">
          <?php $image =$this->db->select('company_logo')->get('company_infos')->row()->company_logo;?>
          <p><img src="<?php echo base_url('/images'.'/'.$image)?>" style="height: 30px;width: 50px;margin-top:5px"></p>
          <h6>Honeywell Garments Ltd.</h6>
          <img src="<?php echo base_url('/uploads/photo'.'/'.$value->img_source)?>" alt="" class="box-img">
          <p><b><?php echo $value->name_en?></b></p> 
          <p><b><?php echo $value->line_name_en?></b></p>
          <div class="left_content">
            <p>Department : <b><?php echo $value->dept_name?></b></p>
            <p>ID Card No : <b><?php echo $value->emp_id?></b></p>
            <p>Join Date : <b><?php echo date('d-m-Y',strtotime($value->emp_join_date))?></b></p>
            <p>Blood Group: <b><?php echo $value->blood_name?></b></p>
          </div>

          <div class="d_flex">
            <p>Card Holder</p>
            <p> Authorized Signature</p>
          </div>
          <p class="text-center bg-info" style="width:100% ; border-radius: 10px 10px 0 0;position: absolute;bottom: -1px;left: -1px;">www.ajgroupbd.com</p>
        </div>
        <div class="box text-center p_padding" style="line-height: 18px;">
          <p style="margin-top: 10px;"><b>Document Code : HGL/HRD/HR/03/051</b></p>
          <p><b>Validity: Till The Time of Employement</b></p>
          <p>Issue Date: <b><?php echo date('d-m-Y',strtotime($value->emp_join_date))?></b></p>
          <p>Type of Work: <b><?php echo $value->emp_cat_id == 1 ? 'Permanent':'New'?></b></p>
          <p>Card Holder Must Carry This Card At All Time, If the Identity card is lost, the management autharity should be informed</p>
          <p>immediately to the following address, Factory Address:<b> 799, Ambag,Mouza Baghia, Konabari Gazipur-1700.</b></p>
          <p>Contact Number: <b><?php echo $value->personal_mobile?></b></p>
          <p>Emergancy Contact Number: <b><?php echo $value->bank_bkash_no?></b></p>
          <p><?php echo $value->nid_dob_check == 1?'NID':'Birth Certificate'?>: <b><?php echo $value->nid_dob_id?></b></p>
          <p><b>Permanent Address:-</b></p>
          <p>Vill: <b><?php echo $value->per_village?></b>, Post: <b><?php echo $value->post_name_en?></b>,</p>
          <p>Upazila: <b><?php echo $value->upa_name_en?></b>, District: <b><?php echo $value->dis_name_en?></b></p>
          <p class="text-center bg-info" style="width:100% ; border-radius: 10px 10px 0 0;position: absolute;bottom: -1px;left: -1px;height: 26px;"></p>
        </div> 
        <div class="page_break"></div>
      </div>  
      <?php }?>
  </div>   
      

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>