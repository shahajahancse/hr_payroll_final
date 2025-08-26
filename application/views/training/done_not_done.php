<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Training Report</title>

</head>

<body>
    <h1 style="text-align: center;line-height: 1px;font-family:SutonnyMJ">
        <?php 
        echo $unit_name_bangla = $this->db->where("unit_id",$unit_id)->get('company_infos')->row()->company_name_bangla; 
        ?> 
    </h1>
    <h3 style="text-align: center;line-height: 1px;font-family:SutonnyMJ">
    <?php echo $unit_add_bangla = $this->db->where("unit_id",$unit_id)->get('company_infos')->row()->company_add_bangla;?>
        </h3>
    <?php   $this->db->where('training_type.id', $training_id);
        $training=$this->db->get('training_type')->row();
    ?>
    <div style="text-align: center;font-weight: bold;font-size: 18px;" class="unicode-to-bijoy" > cªwk¶‡Yi bvgt <?= $training->title_bn ?></div>

    <?php if ($type==0) { ?>
        <h3 align="center" height="auto" style="padding: 0;margin: 7px;" class="unicode-to-bijoy"> cªwk¶Y সম্পূর্ণকারীর তালিকা</h3>
        <table class="heading" border="1" cellspacing="0" align="center" height="auto">
            <thead>
                <tr>
                    <th class='unicode-to-bijoy'>ক্রমিক নং</th>
                    <th class='unicode-to-bijoy'>কার্ড নাম্বার</th>
                    <th class='unicode-to-bijoy'>লাইন</th>
                    <th class='unicode-to-bijoy'>নাম</th>
                    <th class='unicode-to-bijoy'>পদবী</th>
                    <th class='unicode-to-bijoy'>ফ্লোর</th>
                    <th class='unicode-to-bijoy'>তারিখ</th>
                    <th class='unicode-to-bijoy' >মন্তব্য</th>
                </tr>
            </thead>
            <tbody style="text-center">
                <?php foreach ($done as $key => $value) { ?>
                    <tr style="text-center">
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $key + 1; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->emp_id2; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->emp_name_bn; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->line_name_bn; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->desig_bangla; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->area; ?></td>
                        <td class='unicode-to-bijoy' style="text-center"><?php echo $value->date; ?></td>
                        <td class='unicode-to-bijoy' style="padding: 30px 100px;"><?php echo $value->time; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else{ ?>
        <h3 align="center" height="auto" style="padding: 0;margin: 7px;">Not Done Training List</h3>
        <table class="heading" border="1" cellspacing="0" align="center" height="auto">
            <thead>
                <tr>
                    <th class='unicode-to-bijoy'>ক্রমিক নং</th>
                    <th class='unicode-to-bijoy'>কার্ড নাম্বার</th>
                    <th class='unicode-to-bijoy'>নাম</th>
                    <th class='unicode-to-bijoy'>লাইন</th>
                    <th class='unicode-to-bijoy'>পদবী</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($not_done as $key => $value) { ?>
                <tr>
                    <td class='unicode-to-bijoy'><?php echo $key + 1; ?></td>
                    <td class='unicode-to-bijoy'><?php echo $value->emp_id2; ?></td>
                    <td class='unicode-to-bijoy'><?php echo $value->emp_name; ?></td>
                    <td class='unicode-to-bijoy'><?php echo $value->line_name_bn; ?></td>
                    <td class='unicode-to-bijoy'><?php echo $value->desig_bangla; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <script src="<?=base_url()?>js/unicode_to_bijoy.js" type="text/javascript"></script>
    <?php echo "<script>applyUnicodeToBijoy()</script>"?>

</body>

</html>