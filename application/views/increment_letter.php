<!doctype html>
<html lang="en">

<head>
    <title>Increment Letter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #000000;
            padding:2px;
        }
        p{
            font-size:19px
        }
    </style>
</head>

<body style="font-family: SutonnyMJ">
    <?php foreach($values as $row){?>
    <div class="container w-75">
        <div class="d-flex flex-row justify-content-between">
            <p style="font-family: Arial, Helvetica, sans-serif;">Effective Date : 15.01.2022</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Version # 00</p>
            <p style="font-family: Arial, Helvetica, sans-serif;">Document Code : HGL/HRD/HR/03/008</p>
        </div>
        <div class="d-flex">
            <div class="col-md-2">
                <?php $image = $this->db->select('company_logo')->get('company_infos')->row()->company_logo?>
                <img src="<?php echo base_url('/images'.'/'.$image)?>" alt="Logo" style="max-width: 50%;">
            </div>
            <div class="col-md-12">
                <p class="text-center" style="margin-left: -420px;font-family: SutonnyMJ;font-size: 35px">nvwbI‡qj Mv‡g©›Um wjwg‡UW</p>
            </div>
        </div>
        <div class="col-md-12" style="border-bottom: 1px solid black!important;">
            <p class="text-center h5">799, (cyivZb cøU bs- 1010/1011), AvgevM, ‡gŠRv evwNqv, ‡Kvbvevox, MvRxcyi -1700|</p>
        </div>
        <div class="d-flex">
            <div class="col-md-6">myÎt GBPwRGj/GBPAviwW ১৫৯১/<?php echo date('d/m',strtotime($row->effective_month))?></div>
            <div class="col-md-6 text-right">ZvwiLt <?php echo date('d/m/Y')?> Bs</div>
        </div>

        <div>
            <h3 class="text-center" style="border-bottom: 2px solid black;width: 124px;margin: 0 auto;line-height: 18px">AeMwZ cÎ</h3>
        </div>

        <div class="ml-3" style="line-height: 10px;">
                <p class="mt-3">cÖwZ,</p>
                <p>bvgt <?php echo $row->name_bn?></p>
                <p>c`ext <?php echo $row->new_desig_name?></p>
                <p>KvWt <?php echo $row->emp_id?></p>
                <p>‡mKkbt <?php echo $row->new_sec_name?></p>
                <p>jvBbt <?php echo $row->new_line_name?></p>
                <p>‡hvM`vbt <span style="font-family:SutonnyMJ;font-size:19px"><?php echo date('m/Y',strtotime($row->effective_month))?></span> ইং</p>           
        </div>

            <!-- [name_bn] => আব্দুল মতিন
            [emp_join_date] => 1996-07-01
            [current_grade] => 1
            [prev_dept_name] => 
            [prev_sec_name] => প্রদ
            [prev_line_name] => dd
            [prev_desig_name] => 
            [prev_grade_name] => None
            [new_dept_name] => 
            [new_sec_name] => প্রদ
            [new_line_name] => dd
            [new_desig_name] => 
            [new_grade_name] => None
            [emp_id] => 2023-10-01
            [prev_salary] => 21000
            [new_salary] => 22000 -->


        <span class="ml-3"><b style="font-fmaily : SutonnyMJ;font-size: 19px">welq t evrmwiK †eZb e„w× cÖm‡½|</b></span>
        <div class="ml-3">
            <p class="text-justify" >
                <span><?php echo $row->gender == "Male"? 'Rbve':'Rbvev'?>,</span><br>
            ï‡f”Qv wb‡eb, Avcbvi AeMwZi Rb¨ Rvbv‡bv hv‡”Q †h, Avcbvi PvKzixi †gqv` GK ermi c~b© nIqvq ewb©Z welq ev¯Íevq‡bi j‡ÿ¨ 
KZ…©cÿ <span style="font-family:SutonnyMJ;font-size:19px"><?php echo $row->effective_month?> Bs</span>  ZvwiL n‡Z Avcbvi eZ©gvb gvwmK ‡gvU †eZb  <span style="font-family:SutonnyMJ;font-size:19px"><?php echo $row->prev_salary?></span> UvKvi m‡½ <span style="font-family:SutonnyMJ;font-size:19px"><?php echo ($row->new_salary - $row->prev_salary) ?></span> UvKv †hvM K‡i †gvU <span style="font-family:SutonnyMJ;font-size:19px"><?php echo $row->new_salary?></span>
            UvKvq DbœxZ Kiv nj| <br>
            D‡jøL¨, c~e©eZx© eQi GB e„w× µge×©gvb nv‡i e„w× ‡c‡q Ges Avcbvi eZ©gvb †MÖW I c`ex, wb‡qvM c‡Îi gRyix As‡ki gRyix KvVv‡gv 
wb‡Pi †Uwe‡j wjwLZ cwiewZ©Z gRyix web¨vm Kjvg Abyhvqx n‡e| Av‡iv D‡jøL, _v‡K †h, wb‡qvM c‡Îi Ab¨vb¨ kZ©vejx AcwiewZ©Z 
_vK‡e<br>
            KZ©„cÿ Avkv K‡ib †h, Avcwb mZZv, AvšÍwiKZv I wbôvi mv‡_ KvR K‡i Av‡iv DbœwZ Ki‡eb|
Avcbvi ‡eZb e„w×i c~‡e©i I eZ©gvb gRyix KvVv‡gv Abyhvqx Zzjbvg~jK Z_¨vejx wb¤œiƒct
            </p>

            <div>
                <table class="table table table-bordered text-center p-0">
                    <tr>
                        <th>weeib </th>
                        <th>‡eZb e„w×i c~‡e©i gRyix KvVv‡gv</th>
                        <th>eZ©gvb gRyix KvVv‡g</th>
                    </tr>
                    <tr>
                        <td>c`ex</td>
                        <td><?php echo $row->prev_desig_name?></td>
                        <td><?php echo $row->new_desig_name?></td>
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
            </div>

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
                <p class="text-justify">cÖvwß ¯^xKvit Avwg GB c‡Îi mKj welq mg~n c‡o, ey‡S Ges ‡g‡b wb‡q ¯^-Áv‡b wb‡¤œ Gi Abywjwc‡Z ¯^vÿi K‡i 1 (GK) Kwc MÖnb Kwi |</p>
                <p class="text-right mt-5">MÖnbKvixi ¯^vÿi.......................................................................</p>
            </div>
        </div>
    </div>
    <?php }?>
    <br>
</body>
</html>

