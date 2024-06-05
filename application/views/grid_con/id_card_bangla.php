<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Id Card Bangla</title>
  <style>
body {
  margin: 0;
  padding: 0;
}

.container {
  /* Set width to accommodate both boxes side by side */
  width: 100%;
  font-family: sutonnymj;
}

.box {
  width: 440px;
  height: 265px;
  margin: 15px;
  float: left;
  background-color: #ffffff;
  border: 1px solid #000000;
  box-sizing: border-box;
  position: relative;
}

.logo {
  width: 86px;
  margin: 10px;
  float: left;
  background-color: #ffffff;
  border: 1px solid #000000;
  box-sizing: border-box;
}

p {
  margin: 0;
  padding: 0;
  font-size: 18px;
}

.box-top {
  margin-top: -10px;
  margin-left:10px
}

.box-img {
  position: absolute;
  top: 38px;
  right: 10px;
  width: 106px;
  height: 119px;

}


@media print {
  .printt {
    margin-left: -250px;
  }

  .container {
    width: auto;
  }
}
  </style>
</head>


<body style="line-height:1.4 !important">
  <!-- < ?php dd($values)?> -->
  <div class="container">
    <?php foreach($values as $value ){?>
    <div class="box">
      <div class="d-flex">
        <div class="col-md-3">
          <?php $image =$this->db->where('unit_id', $unit_id)->get('company_infos')->row();?>
          <img src="<?php echo base_url('/images'.'/'.$image->company_logo)?>" alt="logo" height="40px" width="60px" style="margin-top:5px">
        </div>
        <div class="col-md-9 printt mt-2" >
          <h6 style="margin-top:1px"><b><?= $image->company_name_bangla; ?></b></h6>
        </div>
      </div>
      <h4 class="col-md-12 text-center" style="margin-top:-18px"><b>cwiPq cÎ</b></h4>
      <div>
          <img src="<?php echo base_url('/uploads'.'/photo/'.$value->img_source)?>" alt="" class="box-img" style="border:1px solid black">
          <p class="box-top ">AvBwW KvW© bst <span style="font-size:17px"> <b><?php echo $value->emp_id?></b></span></p>
          <p class="box-top"> Bmyy¨i ZvwiL t <span style="font-size:17px"> <b><?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</b></span></p>
          <p class="box-top">bvg t <span style="font-size:12px"><b><?php echo $value->name_bn?></b></span></p>
          <p class="box-top">c`ex t <span style="font-size:12px"><b><?php echo $value->desig_bangla?></b></span></p>
          <p class="box-top"> wefvM/kvLvt <span style="font-size:12px"><b><?php echo $value->sec_name_bn?></b></span></p>
          <p class="box-top"> <span>Kv‡Ri aibt <span style="font-size:12px"><b><?php echo $value->emp_cat_id ==1 ? "স্থায়ী" : "SS"?></b></span></span></p>
          <p class="box-top">jvBbt <span style="font-size:12px"><b><?php echo $value->line_name_bn?></b></span></p>
          <p class="box-top">‡hvM`v‡bi ZvwiLt <b style="font-size:17px"><?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</b></p>
          <img src="<?php echo base_url('/images/'.$image->company_signature)?>" style="width: 18%;position: absolute;margin-top: -34px;right: 20px;">
          <div class="d-flex justify-content-between" style="margin-top: 15px;">
            <p class="box-top mt-2" style="border-top:1px solid black;width:fit-content">MÖnbKvixi ¯^vÿi</p>
            <p class="box-top mt-2" style="margin-right: 22px;border-top:1px solid black;width:fit-content">Aby‡gv`bKvix</p>
          </div>
        </div>
    </div>

    <div class="box" style="line-height:">
      <p class="box-top mt-2" style="font-family:the times roman;font-size:15px;text-align: center;margin-bottom:5px">
        <?php 
          $unit_id= $this->session->userdata('data')->unit_name;
          if($unit_id == 1){
            echo " Document Code : AJFL/HRAC(HR)/03/021 ";
          }else if($unit_id == 2){
            echo "Document Code : LSAL/HR/03/174";
          }else if($unit_id == 4){
            echo "Document Code : HGL/HRD/HR/03/051";
          }
        ?>
      </p>
      <p class="box-top text-center">‡gqv`t PvKzwi _vKvKvjxb ch©šÍ|</p>
      <p style="font-size: 14px; padding: 4px;" class="box-top text-center"><?= $image->company_add_bangla; ?></p>
      <p class="box-top text-center">‡dvb bst 09611677670, 01749087002</p>
      <p class="box-top text-center">D³ cwiPq cÎ nvivBqv †M‡j ZvrÿwbK e¨e¯’vcbv KZ…©cÿ‡K RvbvB‡Z n‡e|</p>
      <p class="box-top text-center">i‡³i MÖæct <spans style="font-family: Arial, Helvetica, sans-serif; font-size:14px"> <b><?php echo $value->blood_name?></b></spans></p>
      <p class="box-top text-center">¯’vqx wVKvbv :  MÖvg : <span style="font-size:15px;font-weight:bold"><?php echo $value->per_village_bn?></span>,WvKNi : <span style="font-size:15px;font-weight:bold"><?php echo $value->post_name_bn?></span></p>
      <p class="box-top text-center"> _vbv :<span style="font-size:15px;font-weight:bold"><?php echo $value->upa_name_bn?></span>, ‡Rjv :<span style="font-size:15px;font-weight:bold"> <?php echo $value->dis_name_bn?></span></p>
      <p class="box-top text-center">Riyix ‡hvMv‡hv‡Mi ‡dvb bst <span style="font-size:19px"><b><?php echo $value->bank_bkash_no?></b></span></p>
      <p class="box-top text-center"> <?php echo $value->nid_dob_check == 1 ? 'RvZxq cwiPq cÎ bst' : 'Rb¥wbeÜb bst'?> <span style="font-size:19px"> <b><?php echo $value->nid_dob_id?></b></span></p>
    </div>
    <?php }?>
  </div>

</body>
</html>
<?php exit(); ?>
