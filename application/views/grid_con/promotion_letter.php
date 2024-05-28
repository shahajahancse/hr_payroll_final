<!doctype html>
<html lang="en">

<head>
    <title>Promotion Letter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:SutonnyMJ
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }
        p{
            font-size: 19px;
        }
    </style>
</head>

<body>
      <?php foreach($values as $row){?>
    <div class="container w-75">
        <?php $unit_id= $this->session->userdata('data')->unit_name; if($unit_id ==1){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :03.10.2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : AJFL/HRAC(HR)/03/033</p>
        </div>
        <?php } else if($unit_id == 2){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :01-01-2020</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : LSAL/HR/03/127</p>
        </div>
        <?php }else if($unit_id == 4){?>
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>
        <?php }?>
        <div class="mt-3">
            <?php  $com_info = $this->db->where('unit_id', $unit_id)->get('company_infos')->row(); ?>
            <div class="d-flex">
                <img src="<?php echo base_url('/images/AJ_Logo_copy4.png')?>" alt="Logo" style="width: 60px;height: 50px;position: absolute;">
                <h4 class="text-center" style="margin:0 auto"><?= $com_info->company_name_bangla ?></h4>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h6"><?= $com_info->company_add_bangla ?></p>
        </div>
        <div class="d-flex">
              <div class="col-md-6">
                  <?php echo ($unit_id == 1) ? 'G‡RGdGj' : (($unit_id == 2) ? 'GjGmGGj' : 'GBPwRGj') ?>/GBPAviwW/cÖ†j/<?php echo date('m/Y')?>/ <?php echo $row->letter_id?>
              </div>
            <div class="col-md-6 text-right">ZvwiLt <?php echo date('d/m/Y')?> Bs</div>
        </div>

        <div>
            <h3 class="text-center" style="border-bottom: 2px solid black;width: 124px;margin: 0 auto;line-height: 18px;">AeMwZ cÎ</h3>
        </div>

        <div class="ml-3" style="line-height: 10px;">
                <p class="mt-3">cÖwZ,</p>
                <p>bvgt <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->name_bn.'</span>'?></p>
                <p>c`ext <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_desig_name.'</span>'?></p>
                <p>KvWt <?php echo $row->emp_id?></p>
                <p>‡mKkbt <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_sec_name.'</span>'?></p>
                <p>jvBbt <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_line_name.'</span>'?></p>
                <p>‡hvM`vbt <span style="font-family:SutonnyMJ;font-size:19px"><?php echo date('d/m/Y',strtotime($row->effective_month))?></span> Bs</p>
        </div>
        <br>
        <h5 class="ml-3"><b>welq t c‡`vbœwZ cÖm‡½|</b></h5>
        <br>
        <div class="ml-3">
            <p class="text-justify">
                <span><?php echo $row->gender == "Male"? 'Rbve':'Rbvev'?>,</span><br>
                Avcbvi AeMwZi Rb¨ Rvbv‡bv hv‡”Q ‡h, ‡Kv¤úvbx KZ©…c¶ Avcbvi Kg©`¶Zvq mš‘ó n‡q Avcbv‡K <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->prev_desig_name.'</span>'?> c`, ‡M«Wt <?php echo '<span style="font-family:SutonnyMJ;font-size:19px">'.$row->prev_grade_name.'</span>';?>  ‡_‡K
                <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_desig_name.'</span>'?> c‡`, jvBbt <?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_line_name.'</span>'?> , ‡M«Wt <?php echo '<span style="font-family:SutonnyMJ;font-size:19px">'.$row->new_grade_name.'</span>';?> G c‡`vbœwZ ‡`Iqvi wm×všÍ M…nxZ n‡q‡Q| Avcbvi c~‡e©i ‡eZb <?php echo $row->prev_salary?>
                UvKvi mv‡_ AviI<?php echo ($row->new_salary - $row->prev_salary)?> UvKv e…w× K‡i ‡gvU ‡eZb <?php echo $row->new_salary?> UvKv avh© Kiv nBj| hv A`¨  <?php echo $row->effective_month?> Bs ZvwiL n‡Z Kvh©Ki Kiv n‡e|
                Avcbvi ‡eZb e…w×i c~‡e©i I eZ©gvb gRyix KvVv‡gv Abyhvqx Zyjbvg~jK Z_¨ejx wbgœiæc|
            </p>

            <div>
               <table class="table table table-bordered text-center p-0" style="font-size: 19px">
                    <tr>
                        <th>weeib </th>
                        <th>‡eZb e„w×i c~‡e©i gRyix KvVv‡gv</th>
                        <th>eZ©gvb gRyix KvVv‡g</th>
                    </tr>
                    <tr>
                        <td>c`ex</td>
                        <td><?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->prev_desig_name.'</span>'?></td>
                        <td><?php echo '<span style="font-family:SutonnyMJ;font-size:14px">'.$row->new_desig_name.'</span>'?></td>
                    </tr>
                    <tr>
                        <td>‡MÖW</td>
                        <td><?php echo $row->prev_grade_name =="None"? 'প্রযোজ্য নয়': $row->prev_grade_name?></td>
                        <td><?php echo $row->new_grade_name =="None"? 'প্রযোজ্য নয়': $row->new_grade_name?></td>
                    </tr>
                    <tr>
                        <td>g~j gRyix</td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><?php echo  $prev_basic =round(($row->prev_salary - (1250+750+450))/ 1.5) ; ?></td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><?php echo  $new_basic =round(($row->new_salary  - (1250+750+450))/ 1.5); ?></td>
                    </tr>
                    <tr>
                        <td>evox fvov (g~j gRyix 50%)</td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><?php echo round((($prev_basic/2)))?></td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><?php echo round((($new_basic/2)))?></td>
                    </tr>
                    <tr>
                        <td>wPwKrmv fvZv</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">750</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">750</td>
                    </tr>
                    <tr>
                        <td>hvZvqZ fvZv</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">450</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">450</td>
                    </tr>
                    <tr>
                        <td>Lv`¨ fvZv</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">1250</td>
                        <td style="font-family:SutonnyMJ;font-size:19px">1250</td>
                    </tr>
                    <tr>
                        <td><b>me©‡gvU gRyix</b></td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><b><?php echo $row->prev_salary?></b></td>
                        <td style="font-family:SutonnyMJ;font-size:19px"><b><?php echo $row->new_salary?></b></td>
                    </tr>
                    <tr>
                        <td>Ifvi UvBg fvZvi nvi / N›Uv cÖwZ</td>
                        <td><?php echo round($prev_basic/104,2)?></td>
                        <td><?php echo round($new_basic/104,2)?></td>
                    </tr>
                </table>
                <p>Avkv Kwi fwel¨‡Z Avcwb Avcbvi AwaKZi Kg©`¶Zvi cwiPq w`‡eb Ges ‡Kv¤úvbxi DË‡ivËi mg…w×‡Z Avi mqvnK f~wgKv cvjb Ki‡eb|</p>
            </div>

            <div style="line-height: 10px;">
<div style="line-height: 10px;">
                <p style="margin-bottom: 117px !important;">ab¨ev`v‡šÍ,</p>
                <hr style="border: 1px solid black; width: 340px;float:left;display: block;"><br>
                <br><br>
                <p class="mt-2">wefvMxq cÖavb (GBPAvi, GWwgb GÛ Kgcøv‡qÝ)</p>
                <p>nvwbI‡qj Mv‡g©›Um wjwg‡UW|</p>
                <p class="mt-5">Abywjwct</p>
                <p>1| MÖæc ‡Rbv‡ij g¨v‡bRvi (GBPAvi, GWwgb GÛ Kgcøv‡qÝ)</p>
                <p>2| ‡Rbv‡ij g¨v‡bRvi (cÖ‡R± ‡nW)</p>
                <p>3| wefvMxq c«avb</p>
                <p>4| e¨w³MZ bw_</p>
                <!-- <p class="text-justify">cÖvwß ¯^xKvit Avwg GB c‡Îi mKj welq mg~n c‡o, ey‡S Ges ‡g‡b wb‡q ¯^-Áv‡b wb‡¤œ Gi Abywjwc‡Z ¯^vÿi K‡i 1 (GK) Kwc MÖnb Kwi |</p> -->
                <p class="text-right mt-5">MÖnbKvixi ¯^vÿi............................................</p>
            </div>
            </div>
        </div>
    </div>
    <div style="page-break-after: always"></div>
    <?php }?>
</body>
</html>
<?php exit(); ?>
