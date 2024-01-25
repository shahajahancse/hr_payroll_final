<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Your New Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <style>
            .table td{
                padding: 0px;
                
            }
            p{
                margin-bottom: 4px;
            }
            @media print{
                .break_page{
                    page-break-before: always;
                    } 
                body{
                    text-align: justify;
                    margin: 0px;
                    
                }
                .vl {
                    margin-left: 100px;
                }
        
                img{
                    width: 20%;
                }    

                .container {
                    size: A4; 
                    margin-top:1px !important;
                    margin-right: 10px !important;
                    padding-left:10px !important;
                    padding:0px !important;
                }
            }

            .title_box{
                display: flex;
                flex-direction: column;
                border: 2px solid black;
                width: 260px;
                align-items: center;
                margin: 0 auto;
             }
             .table th {
                border-top: 1px solid #000000;
            }
            p{
                font-size:21px
            }
            table th,td {
                font-size:21px;
            }
            .potovumi{
                font-size: 20px;
            }
            .vl {
                border-left: 1px solid gray;
                height: 175px;
                position: absolute;
                left: 77%;
                margin-top: 190px;
                transform: rotate(13deg);
            }
        </style>
    </head>

    <body style="">
        <!-- niog -->
        <?php 
            // dd($values);
            $image = $this->db->select('company_logo')->get('company_infos')->row()->company_logo;
            foreach($values as $value){

            
        ?>
        <div class="container break_page" style=" font-family: sutonnymj;">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
            <div class="d-flex mt-2">
                <div class="col-md-4">
                    <p style="font-size:21px !important;line-height:22px !important;">myÎt GBP.wR.Gj/GBP.Avi.wW/G.Gj/5523 <br><span>ZvwiLt <?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</span></p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-center"><b style="border: 2px solid black;padding-left:4px;padding-right:6px;">wb‡qvM cÎ</b></h2>
                </div>
                <div class="col-md-4">
                    <p style="float:right; font-size:21px !important;line-height:22px !important;">kªwgK Kwc</p>
                </div>
            </div>
            <div style="margin-left: 2px;">
                <div class="col-md-6 mt-4">
                    <p style="font-size:21px !important;line-height:22px !important;">cÖwZ,</p>
                    <table>
                        <tr>
                            <th >bvg </th>
                            <td> t </td>
                            <td> <span style="font-size:15px"> <?php echo $value->name_bn?> </span></td>
                        </tr>
                        <tr>
                            <th>eZ©gvb wVKvbv </th>
                            <td> t </td>
                            <td> <span style="font-size:15px"> <?php echo $value->pre_village_bn?>, <?php echo $value->pre_post_name_bn?>, <?php echo $value->pre_upa_name_bn?>, <?php echo $value->pre_dis_name_bn?></span></td>
                        </tr>
                        <tr>
                            <th>¯’vqx wVKvbv </th>
                            <td> t </td>
                            <td> <span style="font-size:15px"> <?php echo $value->per_village_bn?>, <?php echo $value->post_name_bn?>, <?php echo $value->upa_name_bn?>, <?php echo $value->dis_name_bn?></span> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <p style="font-size:21px !important;line-height:21px !important;">
                        <span><?php echo $value->gender == 'Male' ? 'Rbve': 'Rbvev'?>,</span><br>
                        Avcbvi <?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs Zvwi†Li Av‡e`b cÎ Ges cieZx©Kv‡j M„nxZ mv¶vrKvi / cix¶vi cwi‡cÖw¶‡Z Avcbv‡K
                        <?php echo "<span style='font-size:15px'>".$value->desig_bangla ."</span>"?> c‡`, KvW© bst <?php echo $value->emp_id?> , ‡mKkbt <?php echo "<span style='font-size:15px'>".$value->sec_name_bn."</span>"?> ,<span style='font-size:15px'>লাইনt <?php echo $value->line_name_bn?> </span>,‡MÖWt <?php echo $value->grade?> ,wb‡qvM †`Iqv nBj|
                    </p>
                    <p style="font-size:21px !important"><b>kZv©ejxt</b></p>
                    <p style="font-size:21px !important;line-height:21px !important;">1. Avcbvi PvKzixi cÖ_g wZb gvm cÖ‡ekb wnmv‡e Mb¨ nB‡e hvnv D³ cÖ‡ekb †gqv`v‡šÍ Avcbvi Kg© g~j¨vqb ‡k‡l
                        m‡šÍvlRbK we‡ewPZ
                        nB‡j Avcbvi
                        wb‡qvM ¯’vqx Kiv nB‡e| cÖKvk _v‡K †h, KvR m‡šÍvlRbK we‡ewPZ bv nB‡j KZ„©cÿ ‡Kvb c~e© AeMwZ e¨vwZ‡i‡K Avcbvi
                        PvKyixi
                        Aemvb Kivi
                        AwaKvi iv‡Lb| hw` ‡Kvb Ae¯’vq Avcbvi Kv‡Ri gvb m‡šÍvlRbK bv nq Z‡e KZ„©cÿ wkÿvbexkKvj mgq AviI wZb gvm ewa©Z
                        Kwi‡Z
                        cvwi‡eb|</p>
                    <p style="font-size:21px !important;line-height:21px !important;">
                        2. Avcbvi gRyix / †eZb KvVv‡gv wb¤œiæct
                    <table style="line-height: 1.2;">
                        <tr>
                            <th>g~j gRyix</th>
                            <td>t</td>
                            <td></td>
                            <td> <?php $basic = round(($value->salary -(1250+450+750)) / 1.5); echo $basic;?></td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>evox fvov (g~j gRyixi 50%)</th>
                            <td>t</td>
                            <td></td>
                            <td> <?php echo round($basic/2)?> </td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>wPwKrmv fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 750 </td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>hvZvqvZ fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 450</td>
                            <td>UvKv</td>
                        </tr>
                        <tr style="border-bottom:1px solid black">
                            <th>Lv`¨ fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 1250</td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>gvwmK me©‡gvUt</th>
                            <th>t</td>
                            <th></td>
                            <th> <span><?php echo $value->salary?></span></th>
                            <th> UvKv</th>
                            <!-- <th>K_vq : (†lvj nvRvi cvuPkZ UvKv|)</th> -->
                        </tr>
                    </table>
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        3. gwmK gRyix cieZx© gv‡mi mvZ Kg© w`e‡m †h †Kvb w`e‡m cÖ`vb Kiv nB‡e|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        4. Avcbvi Kg©N›Uv n‡e mKvj 8.00 NwUKv nB‡Z weKvj 5.00 NwUKv ch©šÍ, Z‡e KZ„©cÿ cª‡qvR‡b AvBbvbyhvqx AwZwi³
                        mgq KvR Kiv‡Z
                        cvwi‡eb|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        5. mßv‡n GKw`b mvßvwnK QzwU _vK‡e hv ïµevi ev miKvwi wm×všÍ Abyhvqx GjvKv‡f‡` Ab¨ †Kvb w`b n‡Z cv‡i| GQvov
                        cÖwZôv‡b
                        cª‡hvR¨ wbqg Abyhvqx Ab¨vb¨ mKj myweav ‡fvM Kwi‡Z cvwi‡eb|
                    </p>
            
                    <p style="font-size:21px !important;line-height:22px !important;">‰bwgwËK QzwU - 10 (`k) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">cxov QzwU - 14 (†PŠÏ) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">Drme QzwU - 12 (evi) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">evwl©K QzwU - cÖwZ 18 (AvVvi) w`b Kv‡Ri Rb¨ 1 (GK) w`b Z‡e GK ermi PvKzix m¤úb nIqvi ci|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">cÖmywZ Kj¨vb QzwU - 16 (‡lvj) mßvn, cÖm‡ei m¤¢ve¨ ZvwiL Gi c~‡e© AÎ cÖwZôv‡b Aby¨b 06 (Qq) gvm wbiwew”Qbœ
                        fv‡e Kg©iZ _vK‡j|</p>
            
                    <p style="font-size:21px !important;line-height:22px !important;"> 6. PvKyix nB‡Z Ae¨nwZ : ¯’vqx kÖwgK PvKzix Qvovi †ÿ‡Î 60 (lvU) w`‡bi AwMÖg †bvwUk w`‡Z nB‡e, Ab¨_vq ‡bvwUk
                        †gqv‡`i
                        mgcwigvb A_©
                        gvwjK‡K cª`vb Kwi‡Z nB‡e , gvwjK KZ…©K PvKzix Aemv‡bi †ÿ‡Î 120 w`‡bi †bvwUk A_ev mgcwigvb gRyix cÖ`vb Kwi‡Z
                        n‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">7. cÖwZ Kg©w`e‡m ga¨vý weiwZ wn‡m‡e 1(GK) N›Uv bvgvR / LvIqv / wekÖv‡gi Rb¨ cÖ`vb Kiv n‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">8. Avcbv‡K GKwU Qwe m¤^wjZ AvBwW KvW© cÖ`vb Kiv nB‡e hvnv Avcbvi cwiPq cÎ wnmv‡e Mb¨ nB‡e Ges Kg©‡ÿ‡Î Bnv
                        Mjvq Szwj‡q
                        cÖ`k©b Kwi‡Z
                        nB‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">9. Avcbvi wb‡qvM ¯’vqx nB‡j Avcwb hw` KL‡bv †Kvb Am`vPi‡bi Aciv‡a †`vlx cªgvwbZ nb Z‡e KZ…©cÿ cªPwjZ
                        AvBbvbyhvqx Avcbvi
                        weiæ‡× eiLv¯Ímn AvBbvbyM †h †Kvb kvw¯ÍgyjK e¨e¯’v Mªnb Ki‡Z cvwi‡eb|</p>
                    <p style="font-size:21px !important;line-height:22px !important;"> 10. ‡Kv¤úvbxi cª‡qvR‡b G‡R MÖæ‡ci AvIZvaxb Ab¨ †h †Kvb KviLvbv / BDwbU / wefv‡M Avcbv‡K e`jx Kwi‡Z cvwi‡eb|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">11. PvKyix‡Z _vKv Kvjxb Avcwb AÎ cªwZôv‡b e¨e¯’vw`/bxwZgvjv msµvšÍ ‡Mvcbxq Z_¨vw` ‡Kvb e¨w³, e¨emv cÖwZôv‡bi
                        A_ev Ab¨
                        Kv‡iv wbKU
                        cÖKvk Kwi‡Z cvwi‡eb bv|</p>
                    <p style="font-size:21px !important;line-height:22px !important;"> 12. KZ…©cÿ †h †Kvb mgq †Kvb c~e© †bvwUk QvovB Avcbvi PvKyixi kZv©ejx †`‡ki cªPwjZ kªg AvB‡bi weavb mv‡c‡ÿ
                        cwieZ©b/cwiea©b Kivi
                        ‰ea AwaKvi msiÿb K‡ib|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">13. evsjv‡`k kÖg AvB‡bi Av‡jv‡K Avcbvi evrmwiK †eZb e„w× Kiv nB‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">14. Avcbvi PvKyixi Ab¨vb¨ kZv©ejx ‡`‡ki kªg AvBb I †Kv¤úvbxi wbqg Abyhvqx wbqwš¿Z nB‡e|</p>
            
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="d-flex">
                <div class="col-md-6">
                    <p>........................</p>
                    <p style="font-size:21px !important;">KZ©„c‡ÿi ¯^vÿi</p>
                </div>
                <div class="col-md-6 justify-content-end">
                   <table style="margin-left:206px">
                    <tr>
                        <td> <p style="font-size:21px !important;line-height:18px;white-space:nowrap">¯^vÿit ................ √.......................</p>
                   </td>
                    </tr>
                    <tr>
                        <td> <p style="font-size:21px !important;line-height:18px;">bvgt <span style="font-size:15px"><?php echo $value->name_bn?></span></p>
                  </td>
                    </tr>
                    <tr><td>  <p style="font-size:21px !important;line-height:18px;">c`ext <span style="font-size:15px"><?php echo $value->desig_bangla?></span></p></td></tr>
                   </table>
                </div>
            </div>
        </div>
      
      
        <div class="container break_page" style=" font-family: sutonnymj;">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
            <div class="d-flex mt-2">
                <div class="col-md-4">
                    <p style="font-size:21px !important;line-height:22px !important;">myÎt GBP.wR.Gj/GBP.Avi.wW/G.Gj/5523 <br><span>ZvwiLt <?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</span></p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-center"><b style="border: 2px solid black;padding-left:4px;padding-right:6px;">wb‡qvM cÎ</b></h2>
                </div>
                <div class="col-md-4">
                    <p style="float:right; font-size:21px !important;line-height:22px !important;">Awdm Kwc</p>
                </div>
            </div>
            <div style="margin-left: 2px;">
                <div class="col-md-6 mt-4">
                    <p style="font-size:21px !important;line-height:22px !important;">cÖwZ,</p>
                    <table>
                        <tr>
                            <th >bvg </th>
                            <td> t </td>
                            <td><span style="font-size:15px"> <?php echo $value->name_bn?> </span></td>
                        </tr>
                        <tr>
                            <th>eZ©gvb wVKvbv </th>
                            <td> t </td>
                            <td> <span style="font-size:15px"> <?php echo $value->pre_village_bn?>, <?php echo $value->pre_post_name_bn?>, <?php echo $value->pre_upa_name_bn?>, <?php echo $value->pre_dis_name_bn?></span></td>
                        </tr>
                        <tr>
                            <th>¯’vqx wVKvbv </th>
                            <td> t </td>
                            <td> <span style="font-size:15px"> <?php echo $value->per_village_bn?>,<?php echo $value->post_name_bn?>, <?php echo $value->upa_name_bn?>, <?php echo $value->dis_name_bn?></span> </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <p style="font-size:21px !important;line-height:21px !important;">
                        <span><?php echo $value->gender == 'Male' ? 'Rbve': 'Rbvev'?>,</span><br>
                        Avcbvi <?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs Zvwi†Li Av‡e`b cÎ Ges cieZx©Kv‡j M„nxZ mv¶vrKvi / cix¶vi cwi‡cÖw¶‡Z Avcbv‡K
                        <?php echo "<span style='font-size:15px'>".$value->desig_bangla ."</span>"?> c‡`, KvW© bst <?php echo $value->emp_id?> , ‡mKkbt <?php echo "<span style='font-size:15px'>".$value->sec_name_bn."</span>"?> ,<span style='font-size:15px'>লাইনt <?php echo $value->line_name_bn?> </span>,‡MÖWt <?php echo $value->grade?> ,wb‡qvM †`Iqv nBj|
                    </p>
                    <p style="font-size:21px !important"><b>kZv©ejxt</b></p>
                    <p style="font-size:21px !important;line-height:21px !important;">1. Avcbvi PvKzixi cÖ_g wZb gvm cÖ‡ekb wnmv‡e Mb¨ nB‡e hvnv D³ cÖ‡ekb †gqv`v‡šÍ Avcbvi Kg© g~j¨vqb ‡k‡l
                        m‡šÍvlRbK we‡ewPZ
                        nB‡j Avcbvi
                        wb‡qvM ¯’vqx Kiv nB‡e| cÖKvk _v‡K †h, KvR m‡šÍvlRbK we‡ewPZ bv nB‡j KZ„©cÿ ‡Kvb c~e© AeMwZ e¨vwZ‡i‡K Avcbvi
                        PvKyixi
                        Aemvb Kivi
                        AwaKvi iv‡Lb| hw` ‡Kvb Ae¯’vq Avcbvi Kv‡Ri gvb m‡šÍvlRbK bv nq Z‡e KZ„©cÿ wkÿvbexkKvj mgq AviI wZb gvm ewa©Z
                        Kwi‡Z
                        cvwi‡eb|</p>
                    <p style="font-size:21px !important;line-height:21px !important;">
                        2. Avcbvi gRyix / †eZb KvVv‡gv wb¤œiæct
                    <table style="line-height: 1.2;">
                        <tr>
                            <th>g~j gRyix</th>
                            <td>t</td>
                            <td></td>
                            <td> <?php $basic = round(($value->salary -(1250+450+750)) / 1.5); echo $basic;?></td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>evox fvov (g~j gRyixi 50%)</th>
                            <td>t</td>
                            <td></td>
                            <td> <?php echo round($basic/2)?> </td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>wPwKrmv fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 750 </td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>hvZvqvZ fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 450</td>
                            <td>UvKv</td>
                        </tr>
                        <tr style="border-bottom:1px solid black">
                            <th>Lv`¨ fvZv</th>
                            <td>t</td>
                            <td></td>
                            <td> 1250</td>
                            <td>UvKv</td>
                        </tr>
                        <tr>
                            <th>gvwmK me©‡gvUt</th>
                            <th>t</td>
                            <th></td>
                            <th> <span><?php echo $value->salary?></span></th>
                            <th> UvKv</th>
                            <!-- <th>K_vq : (†lvj nvRvi cvuPkZ UvKv|)</th> -->
                        </tr>
                    </table>
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        3. gwmK gRyix cieZx© gv‡mi mvZ Kg© w`e‡m †h †Kvb w`e‡m cÖ`vb Kiv nB‡e|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        4. Avcbvi Kg©N›Uv n‡e mKvj 8.00 NwUKv nB‡Z weKvj 5.00 NwUKv ch©šÍ, Z‡e KZ„©cÿ cª‡qvR‡b AvBbvbyhvqx AwZwi³
                        mgq KvR Kiv‡Z
                        cvwi‡eb|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">
                        5. mßv‡n GKw`b mvßvwnK QzwU _vK‡e hv ïµevi ev miKvwi wm×všÍ Abyhvqx GjvKv‡f‡` Ab¨ †Kvb w`b n‡Z cv‡i| GQvov
                        cÖwZôv‡b
                        cª‡hvR¨ wbqg Abyhvqx Ab¨vb¨ mKj myweav ‡fvM Kwi‡Z cvwi‡eb|
                    </p>
            
                    <p style="font-size:21px !important;line-height:22px !important;">‰bwgwËK QzwU - 10 (`k) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">cxov QzwU - 14 (†PŠÏ) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">Drme QzwU - 12 (evi) w`b (c~b© †eZbmn)</p>
                    <p style="font-size:21px !important;line-height:22px !important;">evwl©K QzwU - cÖwZ 18 (AvVvi) w`b Kv‡Ri Rb¨ 1 (GK) w`b Z‡e GK ermi PvKzix m¤úb nIqvi ci|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">cÖmywZ Kj¨vb QzwU - 16 (‡lvj) mßvn, cÖm‡ei m¤¢ve¨ ZvwiL Gi c~‡e© AÎ cÖwZôv‡b Aby¨b 06 (Qq) gvm wbiwew”Qbœ
                        fv‡e Kg©iZ _vK‡j|</p>
            
                    <p style="font-size:21px !important;line-height:22px !important;"> 6. PvKyix nB‡Z Ae¨nwZ : ¯’vqx kÖwgK PvKzix Qvovi †ÿ‡Î 60 (lvU) w`‡bi AwMÖg †bvwUk w`‡Z nB‡e, Ab¨_vq ‡bvwUk
                        †gqv‡`i
                        mgcwigvb A_©
                        gvwjK‡K cª`vb Kwi‡Z nB‡e , gvwjK KZ…©K PvKzix Aemv‡bi †ÿ‡Î 120 w`‡bi †bvwUk A_ev mgcwigvb gRyix cÖ`vb Kwi‡Z
                        n‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">7. cÖwZ Kg©w`e‡m ga¨vý weiwZ wn‡m‡e 1(GK) N›Uv bvgvR / LvIqv / wekÖv‡gi Rb¨ cÖ`vb Kiv n‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">8. Avcbv‡K GKwU Qwe m¤^wjZ AvBwW KvW© cÖ`vb Kiv nB‡e hvnv Avcbvi cwiPq cÎ wnmv‡e Mb¨ nB‡e Ges Kg©‡ÿ‡Î Bnv
                        Mjvq Szwj‡q
                        cÖ`k©b Kwi‡Z
                        nB‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">9. Avcbvi wb‡qvM ¯’vqx nB‡j Avcwb hw` KL‡bv †Kvb Am`vPi‡bi Aciv‡a †`vlx cªgvwbZ nb Z‡e KZ…©cÿ cªPwjZ
                        AvBbvbyhvqx Avcbvi
                        weiæ‡× eiLv¯Ímn AvBbvbyM †h †Kvb kvw¯ÍgyjK e¨e¯’v Mªnb Ki‡Z cvwi‡eb|</p>
                    <p style="font-size:21px !important;line-height:22px !important;"> 10. ‡Kv¤úvbxi cª‡qvR‡b G‡R MÖæ‡ci AvIZvaxb Ab¨ †h †Kvb KviLvbv / BDwbU / wefv‡M Avcbv‡K e`jx Kwi‡Z cvwi‡eb|
                    </p>
                    <p style="font-size:21px !important;line-height:22px !important;">11. PvKyix‡Z _vKv Kvjxb Avcwb AÎ cªwZôv‡b e¨e¯’vw`/bxwZgvjv msµvšÍ ‡Mvcbxq Z_¨vw` ‡Kvb e¨w³, e¨emv cÖwZôv‡bi
                        A_ev Ab¨
                        Kv‡iv wbKU
                        cÖKvk Kwi‡Z cvwi‡eb bv|</p>
                    <p style="font-size:21px !important;line-height:22px !important;"> 12. KZ…©cÿ †h †Kvb mgq †Kvb c~e© †bvwUk QvovB Avcbvi PvKyixi kZv©ejx †`‡ki cªPwjZ kªg AvB‡bi weavb mv‡c‡ÿ
                        cwieZ©b/cwiea©b Kivi
                        ‰ea AwaKvi msiÿb K‡ib|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">13. evsjv‡`k kÖg AvB‡bi Av‡jv‡K Avcbvi evrmwiK †eZb e„w× Kiv nB‡e|</p>
                    <p style="font-size:21px !important;line-height:22px !important;">14. Avcbvi PvKyixi Ab¨vb¨ kZv©ejx ‡`‡ki kªg AvBb I †Kv¤úvbxi wbqg Abyhvqx wbqwš¿Z nB‡e|</p>
            
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="d-flex">
                <div class="col-md-6">
                    <p>........................</p>
                    <p style="font-size:21px !important;">KZ©„c‡ÿi ¯^vÿi</p>
                </div>
                <div class="col-md-6 justify-content-end">
                   <table style="margin-left:206px">
                    <tr>
                        <td> <p style="font-size:21px !important;line-height:18px;white-space:nowrap">¯^vÿit ................ √.......................</p>
                   </td>
                    </tr>
                    <tr>
                        <td> <p style="font-size:21px !important;line-height:18px;">bvgt <span style="font-size:15px"><?php echo $value->name_bn?></span></p>
                  </td>
                    </tr>
                    <tr><td>  <p style="font-size:21px !important;line-height:18px;">c`ext <span style="font-size:15px"><?php echo $value->desig_bangla?></span></p></td></tr>
                   </table>
                </div>
            </div>
        </div>    
        <!-- jogdan --> 
        <div class="container break_page" style="font-family:sutonnymj;">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/002</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
            <!-- <div class="row"> -->
                <br>
            
            <h2 class="text-center mt-2"><b style="border: 2px solid black;padding-left:6px;padding-right:6px;">Kv‡R †hvM`vb cÎ</b></h2>
            <!-- </div> -->
            <div class="row mt-4">
                <div class="col-md-6 mt-4">
                    <table>
                        <tr>
                            <th>AvBwWt </th>
                            <td>  </td>
                            <td><?php echo $value->emp_id ?></td>
                        </tr>
                        <tr>
                            <th>ZvwiLt </th>
                            <td> </td>
                            <td><?php echo date("d-m-Y",strtotime($value->emp_join_date))?> Bs</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 mt-3">
        
                    <p style="font-size:21px;">eivei,</p>
                    <p style="font-size:21px;">cwiPvjK/wbev©nx cwiPvjK/gnve¨e¯’vcK/KviLvbv e¨e¯’vcK</p>
                    <p style="font-size:21px;">KviLvbvi bvgt nvwbI‡qj Mv‡g©›Um wjwg‡UW</p>
                    <p style="font-size:21px;">wVKvbvt 799 (cyivZb cøU bs-1010/1011) AvgevM, †gŠRv evwNqv, ‡Kvbvevox, MvRxcyi|</p>
                    <p style="font-size:22px;" class="mt-4"><b>welqt Kv‡R †hvM`vb cÎ</b></p>
        
                    <p style="font-size:21px;" class="mt-4"><?php echo $value->gender == 'Male' ? 'Rbve': 'Rbvev'?>,</p>
                    <p style="font-size:21px;"> Avcbvi wbKU †_‡K cªvß wb‡qvM cÎ AvBwW bs <?php echo $value->emp_id?> Bs ZvwiL <?php echo date("d-m-Y",strtotime($value->emp_join_date))?> Bs Gi ‡cªwÿ‡Z Rvbv‡bv
                        hv‡”Q †h Avwg A`¨ <?php echo date("d-m-Y",strtotime($value->emp_join_date))?> Bs ZvwiL n‡Z Avcbvi wkícÖwZôv‡b Dc‡i D‡jwLZwb‡qvM c‡Îi kZ©
                        †gvZv‡eK <span style="font-size:15px"><?php echo $value->desig_bangla?></span> c‡` †hvM`vb Kijvg|</p>
        
                    <p style="font-size:21px;" class="mt-4"> AZGe Avcbvi wbKU Av‡e`b GB †h, Avgvi `vwLjK„Z Kv‡R †hvM`vb cÎwU MÖnY K‡i evwaZ Ki‡eb|</p>
        
        
                    <p style="font-size:21px;" class="mt-4">ab¨ev`v‡šÍ</p>
                                        <br>
                    <br>
                    <br>  
                    <p style="font-size:21px;" class="mt-4">Avcbvi wek¦¯Í</p>
                </div>

                <div class="col-md-6">
                    <p style="font-size:21px;">¯^vÿit ................ √.......................</p>
                    <p style="font-size:21px;">bvgt <span style="font-size:15px"><?php echo $value->name_bn?></span></p>
                    <p style="font-size:21px;">c`ext <span style="font-size:15px"><?php echo $value->desig_bangla?></span></p>
                </div>
            </div>
        </div>
            <br>
    
        <!-- potovumi -->

        <div class="container break_page" style=" font-family: sutonnymj;">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/005</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
            <br>
            <div class="title_box mt-2">
                <h3 style="font-family:Arial;border-bottom:1px solid black;padding-left:2px;padding-right:2px">Background Check</h3>
                <h3>cUf~wg wbixÿb</h3>
            </div>
        
            <div class="row">
                <div class="col-md-6 mt-4">
                    <table>
                        <tr>
                            <th>ZvwiLt </th>
                            <td>  </td>
                            <td><?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
        
                    <p style="font-size:21px">1| bvgt <span style="font-size:15px"><?php echo $value->name_bn?></span></p>
                    <p style="font-size:21px">2| wcZvi bvgt <span style="font-size:15px"><?php echo $value->father_name?></span></p>
                    <p style="font-size:21px">3| gvZvi bvgt <span style="font-size:15px"><?php echo $value->mother_name?></span></p>
                    <p style="font-size:21px">4| ¯’vqx wVKvbvt  <span style="font-size:15px"><?php echo $value->per_village_bn?>,<?php echo $value->post_name_bn?>, <?php echo $value->upa_name_bn?>, <?php echo $value->dis_name_bn?></span> |</p>
                    <p style="font-size:21px">     wbR †gvevBj bs <span><?php echo $value->personal_mobile?></span>  AwfeveK †gvevBj bs <span><?php echo $value->refer_mobile?></span>  bwgwb †gvevBjBs <span><?php echo $value->nomi_mobile?></span></p>
                    <p style="font-size:21px">5| wj½t <span style="font-size:15px"><?php echo $value->gender == 'Male' ? 'পুরুষ':'নারী'?></span></p>
                    <p style="font-size:21px">6| ‰eevwnK Ae¯’vt <span><?php 
                                                if($value->marital_status == 'Unmarried'){
                                                    echo 'AweevwnZ' ;
                                                }else{
                                                   echo 'weevwnZ ,' ;
                                                   echo ' ¯¿xi bvgt '.$value->spouse_name;
                                                   echo ', mšÍv‡bi weeiYt ';
                                                   echo ' ‡Q‡jt '.$value->m_child; 
                                                   echo ', ‡g‡qt '.$value->f_child; 
                                                   echo ', ‡gvU mšÍvbt '.$value->f_child + $value->m_child; 
                                                }  
                                              ?>
                                        </span>
                    </p>
                    <p style="font-size:21px">7| eZ©gvb wVKvbvt <span style="font-size:15px"><?php echo $value->pre_village_bn?>,<?php echo $value->pre_post_name_bn?>, <?php echo $value->pre_upa_name_bn?>, <?php echo $value->pre_dis_name_bn?></span>|</p>
                    <p style="font-size:21px">8| fvovwUqv n‡j - </p>
                    <p style="font-size:21px"> evwoi gvwj‡Ki bvgt  <span style="font-size:15px"><?php echo $value->pre_home_owner?></span></p>
                    <p style="font-size:21px"> †dvb / †gvevBj bs (hw` _v‡K)/t <span><?php echo $value->home_own_mobile?></span></p>
        
                    <p style="font-size:21px">9| ‡idv‡iÝKvixi / Awfeve‡Ki bvgt<span style="font-size:15px"><?php echo $value->refer_name?></span>
                        <!-- <p>‡ckv t ............«Referees_job»|</p> -->
                    <p style="font-size:21px"> wVKvbvt <span style="font-size:15px"><?php echo $value->refer_village?>,<?php echo $value->ref_post_name_bn?>, <?php echo $value->ref_upa_name_bn?>, <?php echo $value->ref_dis_name_bn?></span>|</p>
                    <p style="font-size:21px"> †gvevBjt <span><?php echo $value->refer_mobile?></span></p>
                    <br>                            
                    <p style="width:160px;border-bottom: 1px solid black;font-size:21px"><b>wbixÿbKvixi gšÍe¨t</b></p>
                    <p style="font-size:21px">Avwg m‡iRwg‡b/†gvevBj †dv‡bi gva¨‡g †idv‡iÝKvix e¨w³i mv‡_ †hvMv‡hvM K‡i wb‡¤œv³ Z_¨w` mwVK †cjvg:</p>
                    <p style="font-size:21px">1| Dc‡iv³ bvg wVKvbv mwVK|</p>
                    <p style="font-size:21px">2| Av‡e`bKvix Av`vj‡Z `ÛcÖvß bq e‡j Rvbv hvq|</p>
                    <p style="font-size:21px">3| †m gv`Kvm³ bq e‡j †idv‡iÝKvix Rvbvq|</p>
                    <br>
        
                    <p style="font-size:21px">wbixÿbKvixi ¯^vÿit ............................................................</p>
        
                    <p style="font-size:21px">bvgt ..........................................................................</p>
                    <p style="font-size:21px">c`ext .........................................................................</p>
                    <p style="font-size:21px"> ZvwiLt........................................................................</p>
        
        
                </div>
            </div>
        </div>
            <br>
            <br>
            <br>
        <!-- abedon -->

        <div class="container-fluid break_page" style=" font-family: sutonnymj;margin-left:-15px">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/003</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
                <br>
            <!-- <div class="row"> -->
            <h2 class="text-center mt-2"><b style="border: 2px solid black;padding-left:4px;padding-right:4px;">Av‡e`b cÎ</b></h2>
            <!-- </div> -->
            <div class="row" style="margin-left:14px;">
                <div class="col-md-6 mt-4">
                    <table>
                        <tr>
                            <th>ZvwiLt </th>
                            <td>  </td>
                            <td><?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
        
                    <p style="font-size:21px">eivei,</p>
                    <p style="font-size:21px">cwiPvjK/wbev©nx cwiPvjK/gnve¨e¯’vcK/KviLvbv e¨e¯’vcK</p>
                    <p style="font-size:21px">KviLvbvi bvgt nvwbI‡qj Mv‡g©›Um wjwg‡UW</p>
                    <p style="font-size:21px">wVKvbvt 799 (cyivZb cøU bs-1010/1011) AvgevM, †gŠRv evwNqv, ‡Kvbvevox, MvRxcyi|</p>
                    <p style="font-size:21px" class="mt-3">welqt c‡` PvKzixi Rb¨ Av‡e`b |</p>
        
                    <p style="font-size:21px" class="mt-3"><?php echo $value->gender == 'Male' ? 'Rbve': 'Rbvev'?>,</p>
                    <p style="font-size:21px"> h_vwenxZ m¤§vb cÖ`k©b c~e©K weYxZ wb‡e`b GB †h, Avwg Avcbvi KviLvbvq <span style='font-size:15px'><?php echo $value->sec_name_bn?></span> c‡`
                        †hvM`vb Ki‡Z
                        B”QzK| D³ c‡`i GKRb cÖv_x© wnmv‡e Avgvi Rxeb e„ËvšÍ Avcbvi my-we‡ePbvi Rb¨ `vwLj Kijvg|</p>
        
                    <p style="font-size:21px" class="mt-3">GZGe, wb¤œ cÖ`Ë Z_¨vejx hvPvB K‡i Avgv‡K D³ c‡` wb‡qvM `vb Ki‡j Avwg Avcbvi wbKU K…ZÁ _vKe|</p>
        
                    <p style="font-size:21px">1| bvgt <span style='font-size:15px'><?php echo $value->name_bn?></p>
                    <p style="font-size:21px">2| wcZvt <span style='font-size:15px'><?php echo $value->father_name?></span></p>
                    <p style="font-size:21px">3| eZ©gvb wVKvbvt <span style="font-size:15px"><?php echo $value->pre_village_bn?>, <?php echo $value->post_name_bn?>,<?php echo $value->upa_name_bn?>, <?php echo $value->dis_name_bn?></span>| </p>
                    <p style="font-size:21px">4| ¯’vqx wVKvbvt <span style="font-size:15px"><?php echo $value->per_village_bn?>,<?php echo $value->pre_post_name_bn?>, <?php echo $value->pre_upa_name_bn?>, <?php echo $value->pre_dis_name_bn?></span>| </p>
                    <p style="font-size:21px">5| wkÿvMZ †hvM¨Zv <span style="font-size:15px"><?php echo $value->education?></span> </p>
                    <p style="font-size:21px">6| R¤œ ZvwiLt <?php echo $value->emp_dob?> Bs </p>
                    <p style="font-size:21px">7| ag©t <span style="font-size:21px"><?php echo $value->religion == 'Islam' ?'Bmjvg':($value->religion == 'Hindu' ? 'wn›`y':($value->religion=='Christian' ?'wLª÷vb':'‡eŠ×')) ?></span> </p>
                    <p style="font-size:21px">8| RvZxqZvt  Kg©xi †gvevBj bs <span><?php echo $value->bank_bkash_no?></span></p>
                    <p style="font-size:21px">9| AwfÁZvt </p>
        
                    <table class="table" style="border:1px solid black"  border="1">
                        <tr>
                            <th style="padding:0px !important;border:1px solid black" class="text-center">µwgK bs</th>
                            <th style="padding:0px !important;border:1px solid black" class="text-center">AwfÁZvi c~b© weeib</th>
                            <th style="padding:0px !important;border:1px solid black" class="text-center">cÖwZôv‡bi bvg</th>
                            <th style="padding:0px !important;border:1px solid black" class="text-center">PvKzixi mgqKvj</th>
                        </tr>
                        <tr>
                            <td class="text-center">1.</td>
                            <td class="text-center"><span style="font-size:15px"><?php echo $value->exp_dasignation?></span></td>
                            <td class="text-center"><span style="font-size:15px"><?php echo $value->exp_factory_name?></span></td>
                            <td class="text-center"><span style="font-size:15px"><?php echo $value->exp_duration?></span></td>
                        </tr>
                    </table>
        
        
        
        
                    <p style="font-size:21px">10| †idv‡iÝt (1) bvgt <?php echo $value->refer_name?></p>
                    <p style="font-size:21px">wVKvbvt <span style="font-size:15px"><?php echo $value->refer_village?>, <?php echo $value->ref_post_name_bn.', '.$value->ref_upa_name_bn.', '.$value->ref_dis_name_bn?></span></p>
                    <p style="font-size:21px"> †dvbt <?php echo $value->refer_mobile?></p>
        
        
        
                    <div style="float: right;">
                        <p style="font-size:21px">¯^vÿit ................ √.......................</p>
                        <p style="font-size:21px">bvgt <span style="font-size:15px"><?php echo $value->name_bn?></span></p>
                        <p style="font-size:21px">c`ext <span style="font-size:15px"><?php echo $value->desig_bangla?></span></p>
                                            <br>                    <br>
                    </div>

                    <div style="float: left;border: 1px solid black;display: block; width: 100%; margin-top: 5px;">
                        <p style="margin-top: -25px;font-size:21px">Awdm KZ…©K c~iYxqt</p>
                        <div class="d-flex">
                            <div class="col-md-6">
                                <p style="font-size:21px">gšÍe¨t </p>
                            </div>
                            <div class="col-md-6" style="float: right;">
                                <p style="font-size:21px">Kg©KZ©vi ¯^vÿit</p>
                                <p style="font-size:21px"> bvgt ..............................................</p>
                                <p style="font-size:21px">c`ext ..............................................</p>
                            </div>
                        </div>

                    </div>
                </div>                
            </div>
        </div>

        <br>
        <br>
        <br>
        <!-- nominee -->
        <div class="container-fluid break_page" style="margin-left:-10px">
            <div class="d-flex flex-row justify-content-between">
                <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date :15.01.2022</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/007</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
                <br>
            <div class="d-flex flex-column align-items-center">
                <h2 class="mt-2" style="border: 2px solid black;padding-left:4px;padding-right:4px;">dig bs-41</h2>
                <p>[ aviv 19, 131 (1) (K), 155 (2), 234, 264, 265 I 273 Ges wewa 118 (1) 136, 232 (2), 262 (1), 289 (1) I 321
                    (1) `ªóe¨ ]</p>
                <p>Rgv I wewfbœ Lv‡Z cÖvc¨ A_© cwi‡kv‡ai †Nvlbv I g‡bvq‡bi dig|</p>
            </div>
            <br>
            <div>
                <p> 1| KviLvbv / cÖwZôv‡bi bvg t nvwbI‡qj Mv‡g©›Um wjwg‡UW|</p>
                <p> 2| KviLvbv / cÖwZôv‡bi wVKvbv t 799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                <div class="d-flex flex-row">
                    <p> 3| kÖwg‡Ki bvg I wVKvbvt</p>
                    <p> bvgt <span style='font-size:15px'> <?php echo $value->name_bn?> </p>
                    <p>,MÖvgt <span style="font-size:15px"> <?php echo $value->per_village_bn?></span> </p>
                    <p>, WvKNit  <span style="font-size:15px"> <?php echo $value->pre_post_name_bn?></span> </p>
                    <p>,_vbvt   <span style="font-size:15px"> <?php echo $value->pre_upa_name_bn?> </p>
                    <p>, ‡Rjvt <span style="font-size:15px"> <?php echo $value->pre_dis_name_bn?></span> </p>
                  
                </div>
                <p>4| wj½t <span style="font-size:15px"><?php echo $value->gender == "Male"? "পুরুষ":"নারী"?></span></p>
                <p>5| Rb¥ ZvwiLt <?php echo date("d-m-Y",strtotime($value->emp_dob))?> Bs</span></p>
                <p>6| mbv³ KiY wPý (hw` _v‡K)t ------------------------------------ |</p>
                <div class="d-flex">
                    <p>7| ¯’vqx wVKvbvt  MÖvgt <span style="font-size:15px"><?php echo $value->per_village_bn?></span></p>
                    <p>,WvKNit <span style="font-size:15px"><?php echo $value->pre_post_name_bn?></span></p>
                    <p>,_vbvt <span style="font-size:15px"><?php echo $value->pre_upa_name_bn?></span></p>
                    <p>,‡Rjvt <span style="font-size:15px"><?php echo $value->pre_dis_name_bn?></span></p>

                    
                </div>
                <p>8| PvKwi‡Z wbhyw³i ZvwiLt <span><?php echo date("d-m-Y",strtotime($value->emp_join_date))?> Bs</span> </p>
                <p>9| c‡`i bvgt <span style="font-size:15px"><?php echo $value->desig_bangla?></span></p>
            </div>
            <div>
                <p style="line-height:20px">Avwg GZ`Øviv †Nvlbv Kwi‡ZwQ †h, Avgvi g„Zy¨ nB‡j ev Avgvi AeZ©gv‡b, Avgvi AbyK~‡j Rgv I wewfbœLv‡Z cÖvc¨ UvKv
                    MÖn‡bi Rb¨
                    Avwg wb¤œewb©Z e¨w³‡K/e¨w³Mb‡K g‡bvbqb `vb Kwi‡ZwQ Ges wb‡`©k w`w”Q †h, D³ UvKv wb¤œewb©Z c×wZ‡Z g‡bvbxZ
                    e¨w³‡`i g‡a¨
                    e›Ub Kwi‡Z nB‡e|
                </p> <br>

                <div class="vl"></div>
                <table class="table" border="1">
                    <tr>
                        <th class="text-center" style="width: 20%;">g‡bvbxZ e¨w³ ev e¨w³‡`i bvg, wVKvbv I Qwe (bwgbxi Qwe I
                            ¯^vÿi kÖwgK KZ…©K mZ¨vwqZ) Gb AvB wW bs </th>
                        <th class="text-center" style="width: 6%;">m`m¨‡`i mwnZ g‡bvbxZ e¨w³‡`i m¤úK©</th>
                        <th class="text-center" style="width: 6%;vertical-align: middle;">eqm</th>
                        <th class="text-center" style="width: 26%;vertical-align: middle;" colspan="2">cÖ‡Z¨K g‡bvbxZ e¨w³‡K †`q Ask</th>
                    </tr>
                    <tr>
                        <td class="text-center">(1)</td>
                        <td class="text-center">(2)</td>
                        <td class="text-center">(3)</td>
                        <td class="text-center" colspan="2">(4)</td>
                    </tr>
                    <tr>
                        <td class="" ><span style="font-size:15px"><?php echo $value->nominee_name?></span></td>
                        <td class="text-center">
                            <?php 
                                if($value->nomi_relation == 1){
                                    echo "‡Q‡j";
                                }else if($value->nomi_relation ==2){
                                    echo "‡g‡q";
                                }else if($value->nomi_relation ==3){
                                    echo "‡gv";
                                }else if($value->nomi_relation ==4){
                                    echo "evev";
                                }else if($value->nomi_relation ==5){
                                    echo "fvB";
                                }else if($value->nomi_relation ==6){
                                    echo "‡evb";
                                }else if($value->nomi_relation ==7){
                                    echo "¯¿x";
                                }else if($value->nomi_relation ==8){
                                    echo "¯^vgx";
                                }else {
                                    echo " bvB";
                                }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php 
                                $nomi_age = $value->nomi_age;
                                $timestamp_nomi_age = strtotime($nomi_age);
                                $current_year = date('Y');
                                echo $age = date('Y') - date('Y', $timestamp_nomi_age);
                            ?>
                        eQi</td>
                        <td class="text-center" style="width:10%">RgvLvZ</td>
                        <td style="width:10%;text-align:center">100% Ask</td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;">MÖvgt <span style="font-size:15px !important"><?php echo $value->nominee_vill ?></span></td>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="width:10%">e‡KqvLvZ</td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;">‡cv÷t <span style="font-size:15px !important"> <?php echo $value->nomi_post_name_bn ?></span></td>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="width:10%">cÖwf‡W›U dvÛ</td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;">_vbvt <span style="font-size:15px !important"><?php echo $value->nomi_upa_name_bn ?></span></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">exgv</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-left:5px;">‡Rjvt <span style="font-size:15px !important"><?php echo $value->nomi_dis_name_bn ?></span></td>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="width:10%">`~N©Ubvi ÿwZc~iY</td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td>
                        <td></td>
                        <td></td>
                        <td class="text-center">jf¨vsk</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="width:10%">Ab¨vb¨</td>
                        <td style="width:10%"></td>
                    </tr>
                </table>
                <br><br>
                <div>
                    <p>cÖZ¨qb Kwi‡ZwQ †h, Avgvi Dcw¯’wZ‡Z Rbve  -----------------------------------------------, wjwce× weeiY mgyn cvV Kwievi ci D³ †Nvlbv ¯^vÿi Kwi‡Z‡Qb|</p>
                </div>
                <br>

                <div>
                    <p>g‡bvbqb cÖ`vbKvix kÖwg‡Ki ¯^vÿi, wUcmwn I ZvwiLt -----------------------√-----------------------------
                    </p>
                </div>
                <br>
                <br><br>
                <div class="d-flex justify-content-between">
                    <div class="flex-column align-items-start">
                        <p>................................................. </p>
        
                        <p>ZvwiLmn g‡bvbxZ e¨w³M‡Yi </p>
                        <p> ¯^vÿi A_ev wUcmwn </p>
                        <p> (kÖwgK KZ…©K mZ¨vwqZ Qwe) </p>
                    </div>
        
                    <div class="flex-column align-items-end">
                        <p>................................................. </p>
                        <p>gvwj‡Ki ev cÖwaKvicÖvß Kg©KZ©vi ¯^vÿi</p>
                        <p>ZvwiLt ......................... </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- account  -->

        <div class="container break_page" style="margin-left:-10px">
            <div class="d-flex flex-row justify-content-between p_screen">
                <p class="p_screen" style="font-family: Arial, Helvetica, sans-serif;">Effective Date :15.01.2022</p>
                <p class="p_screen" style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
                <p class="p_screen" style="font-family: Arial, Helvetica, sans-serif;">Document Code :HGL/HRD/HR/03/028</p>
            </div>
            <div class="d-flex">
                <div class="col-md-2">
                    <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
                </div>
                <div class="col-md-12">
                 <h1 class="text-center" style="margin-left: -420px;;">nvwbI‡qj Mv‡g©›Um wjwg‡UW </h1>
                </div>
                </div>
                <div class="col-md-12"  style="border-bottom: 1px solid black!important;">
                    <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                </div>
            <div>
        
            <div>
                <br>
                <p>ZvwiL : <?php echo date('d-m-Y',strtotime($value->emp_join_date))?> Bs</p><br><br>
                <p>eivei,</p>
                <p>e¨e¯’vcbv cwiPvjK</p>
                <p>KviLvbvi bvgt nvwbI‡qj Mv‡g©›Um wjwg‡UW .</p>
                <p>wVKvbvt 799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi-1700|</p>
                <p>welqt weKvk bv¤^v‡i ‡eZbvw` cÖ`v‡bi Rb¨ Av‡e`b cÎ</p>
                <br>
                <p><?php echo $value->gender == 'Male' ? 'Rbve': 'Rbvev'?>,</p>
            
                <p>Avwg <span style='font-size:15px'><?php echo $value->name_bn?></span>,c`ext <span style='font-size:15px'><?php echo $value->desig_bangla?></span>,KvW© bst <span><?php echo $value->emp_id?></span>, ‡mKkbt <span style='font-size:15px'><?php echo $value->sec_name_bn?></span>,<span style='font-size:15px'>লাইনt <?php echo $value->line_name_bn?> </span></p>
                <p>Avwg Avgvi hveZxq ‡eZbvw` wb‡gœv³ weKvk bv¤^v‡i cÖ`v‡bi Rb¨ Aby‡iva KiwQ|</p>
                <p>weKvk b¤^it <span><?php echo $value->bank_bkash_no?></span></p>
                <br><br><br><br>
                <div class="d-flex" style="margin-left: -15px;">
                    <div class="col-md-6">
                        <p>¯^vÿi Ges wUcmBt...................√.............</p>
                        <p>bvgt <span style='font-size:15px'><?php echo $value->name_bn?></p>
                        <p>c`ext <span style='font-size:15px'><?php echo $value->sec_name_bn?></span></p>
                    </div>
                    <div class="col-md-6">
                        <p>........................</p>
                        <p>KZ©„c‡ÿi ¯^vÿi</p>
                   </div>
                </div>

            </div>
        </div>
    <?php }?>
    </body>

</html>
