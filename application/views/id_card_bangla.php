<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>A4 Page with Boxes</title>
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
  height: 250px;
  margin: 20px;
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
  width: 90px;
  height: 100px;
  /* border: 1px solid #000000; */
}

  </style>
</head>

<!-- per_village,
per_post
per_thana
per_district
per_village_bn -->
<body>
  <!-- < ?php dd($values)?> -->
  <div class="container">
    <?php foreach($values as $value ){?>
    <div class="box">
      <div class="d-flex">
        <div class="col-md-3">
          <img src="<?php echo base_url('/uploads/logo.png')?>" alt="logo" height="50px" width="80px">
        </div>
        <div class="col-md-9 ">
          <h3 class=""><b>nvwbI‡qj Mv‡g©›Um wjwg‡UW</b></h3>
          <h4 style="margin-top: -10px;margin-left: 56px;"><b>cwiPq cÎ</b></h4>
        </div>
      </div>
        <div class="ml-2">
                  <img src="<?php echo base_url('/uploads'.'/'.$value->img_source)?>" alt="" class="box-img" style="border:1px solid black">
                  <p class="box-top ">AvBwW KvW© bst <span style="font-size:16px"> <b><?php echo $value->emp_id?></b></span></p>
                  <p class="box-top"> Bmyy¨i ZvwiL t <span style="font-size:16px"> <b><?php echo $value->emp_join_date?></b></span></p>
                  <p class="box-top">bvg t <span style="font-size:12px"><b><?php echo $value->name_bn?></b></span></p>
                  <p class="box-top">c`ex t <span style="font-size:12px"><b><?php echo $value->desig_bangla?></b></span></p>
                  <p class="box-top"> wefvM/kvLvt <span style="font-size:12px"><b><?php echo $value->sec_name_bn?></b></span></p>
                  <p class="box-top"> <span>Kv‡Ri aibt <span style="font-size:12px"><b><?php echo $value->emp_cat_id ==1 ? "স্থায়ী" : "SS"?></b></span></span></p>
                  <p class="box-top">jvBbt <b><?php echo $value->line_name_bn?></b></p>
                  <p class="box-top">‡hvM`v‡bi ZvwiLt <b style="font-size:16px"><?php echo $value->emp_join_date?></b></p>
                  <div class="d-flex justify-content-between">
                      <p class="box-top mt-2">MÖnbKvixi ¯^vÿi</p>
                      <p class="box-top mt-2" style="margin-right: 22px;">Aby‡gv`bKvix</p>
                  </div>
        </div>
    </div>

    <div class="box text-center">
      <p class="box-top mt-2">‡gqv`t PvKzwi _vKvKvjxb ch©šÍ|</p>
      <p class="box-top">cÖwZôv‡bi wVKvbvt 799, (cyivZb cøU bs- 1010/1011), AvgevM,‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi -1700|</p>
      <p class="box-top">‡dvb bst 09611677670, 01749087002</p>
      <p class="box-top">D³ cwiPq cÎ nvivBqv †M‡j ZvrÿwbK e¨e¯’vcbv KZ…©cÿ‡K RvbvB‡Z n‡e|</p>
      <p class="box-top">i‡³i MÖæct <spans style="font-family: Arial, Helvetica, sans-serif; font-size:14px"> <?php echo $value->blood_name?></spans></p>
      <p class="box-top">¯’vqx wVKvbv :  MÖvg : <span style="font-size:12px;font-weight:bold"><?php echo $value->per_village_bn?></span>,WvKNi : <span style="font-size:12px;font-weight:bold"><?php echo $value->post_name_bn?></span><br>
        _vbv :<span style="font-size:12px;font-weight:bold"><?php echo $value->upa_name_bn?></span>, ‡Rjv :<span style="font-size:12px;font-weight:bold"> <?php echo $value->dis_name_bn?></span>
      </p>
      <p class="box-top">Riyix ‡hvMv‡hv‡Mi ‡dvb bst <span style="font-size:16px"><b><?php echo $value->bank_bkash_no?></b></span></p>
      <p class="box-top">RvZxq cwiPq cÎ bst <span style="font-size:16px"> <b><?php echo $value->nid_dob_id?></b></span></p>
    </div>
    <?php }?>
  </div>

</body>
</html>
