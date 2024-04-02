<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            @media print {
                @page {
                    size: A4 landscape;
                }
            }
            p{
                font-size: 14px;
                line-height: 8px;
                
            }
        </style>
    </head>
        <body class="container">
            <br>
			<?php foreach($values as $value){ ?>
            <div class="d-flex">
                <div class="flex-fill" style="height:90vh;width:60vw;border: 3px solid black;">
                        <div class="text-center" >
                            <br><br><br><br><br><br>
                            <h5>Document Code-HGL/HRD(HR)/03/010</h5>
                            <br><br>
                            <h1>সার্ভিসবহি </h1>
                            <br>
                            <h4>ফরম-৭ </h4>
                            <p>[ধারা ৭ এবং বিধি ২০ (১) ও (২) দ্রষ্টব্য]</p>
                        </div>
                </div>
                <div style="width:10% !important"></div>
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <div style="padding: 10px 0px 0px 5px;position: relative;">

                        <p>ফরম নং - ৭(ক)</p>
                        <p>প্রথম ভাগ</p>
                        <p>শ্রমিককে সনাক্তকরণের তথ্য:</p>
                        <p>১। শ্রমিকের নাম: <?php echo $value->name_bn?></p>
                        <p>২। পিতার নাম: <?php echo $value->father_name?></p>
                        <p>৩। মাতার নাম: <?php echo $value->mother_name?></p>
                        <p>৪। স্বামী/স্ত্রীর নাম (প্রযোজ্য ক্ষেত্রে): <?php echo $value->spouse_name?></p>
                        <p>৫। স্থায়ী ঠিকানা গ্রামঃ <?php echo $value->per_village?>, রাস্তা ..................</p>
                        <p>   &nbsp;&nbsp;&nbsp;&nbsp; ডাকঘরঃ<?php echo $value->per_post_name_bn?>, থানা ঃ <?php echo $value->per_upa_name_bn?></p>
                        <p>   &nbsp;&nbsp;&nbsp;&nbsp; জেলা ঃ<?php echo $value->per_dis_name_bn?></p>
                        <p>৬। বর্তমান ঠিকানা: <?php echo $value->pre_village.', '.$value->pre_post_name_bn.', '.$value->pre_upa_name_bn.', '.$value->pre_dis_name_bn?></p>
                        <p>৭। জন্ম তারিখ/বয়স: <?php echo $value->emp_dob?></p>
                        <p>৮। জাতীয় পরিচয় পত্র নং (যদি থাকে): <?php echo $value->nid_dob_id?></p>
                        <p>৯।  শিক্ষাগত যোগ্যতা: <?php echo $value->education==''? 'নাই' : $value->education?></p>
                        <p>১০। প্রশিক্ষণ বা বিশেষ দক্ষতা (যদি থাকে): <?php echo $value->exp_factory_name.','. $value->exp_duration.','.$value->exp_dasignation ?></p>
                        <p>১১। উচ্চতা: </p> 
						<p>১২। রক্তের গ্রুপ (যদি থাকে): <?php echo $value->blood == 'None'? 'নাই' : $value->blood?></p>
                        <p>১৩। সনাক্ত করিবার জন্য বিশেষ কোনচিহ্ন (যদি থাকে): নাই</p>
                        <p>১৪। সার্ভিস বহি খুলিবার তারিখ: ২৯-১২-২০২০ ইং</p>
                        <p>১৫। বাম হাতের বৃদ্ধাঙ্গুলীর ছাপ: </p>
                        <div style="position: absolute; top: 10px;right: 10px;">
                            <img style="border: 3px solid black;" src="<?php echo base_url('uploads/photo/'.$value->img_source.'')?>" alt="" width="100px" height="130px">
                        </div>
                        <br>
                        <br> 
                        <p><span>শ্রমিকের স্বাক্ষর:</span>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <span>মালিক/ব্যবস্থাপনা কর্তৃপক্ষের স্বাক্ষর:</span></p>
                    </div>
                
                </div>
            </div>
            <div style="margin-bottom: 20px;page-break-after: always;"></div>
           
            <div class="d-flex">
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;"> ফরম নং - ৭(খ)</p>
                    <h6 class="text-center"> দ্বিতীয়ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;"> মালিকের ও চাকুরীর তথ্যসমূহঃ</p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center">
                                <th>কারখানা/প্রতিষ্ঠানেরনাম ও ঠিকানা </th>
                                <th>মালিক/ব্যবস্থাপনা কর্তৃপক্ষেরনাম</th>
                            </tr>
                            <tr class="text-center">
                                <th>১</th>
                                <th>২</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>হানিওয়েলগার্মেন্টস লিঃ<br>
                                    ৭৯৯ (১০১০/১০১১) আমবাগ, কোনাবাড়ী, গাজীপুর-১৭০০।</td>
                                    <td>মোঃআবদুররহিম<br>
                                    সহঃম্যানেজার (এইচ.আর.ডি)<br>
                                    হানিওয়েলগার্মেন্টস লিঃ</td>
                                </tr>

                            </tbody>
                    </table>
                    
                </div>
                <div style="width:1% !important"></div>
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px">ফরম নং - ৭(খ)</p>
                    <h6 class="text-center"> দ্বিতীয়ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px">মালিকের ও চাকুরীর তথ্যসমূহঃ</p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center">
                                <th>যোগদানের তারিখ</th>
                                <th>চাকরিত্যাগ/ অবসানেরতারিখ</th>
                                <th>ত্যগ/অবসানেরধরন/কারন </th>
                                <th>মালিক/প্রাধিকারপ্রাপ্ত ব্যক্তির স্বাক্ষর</th>
                                <th>শ্রমিকের স্বাক্ষর/টিপসই </th>


                                  
                            </tr>
                            <tr class="text-center">
                                <th>৩</th>
                                <th>৪</th>
                                <th>৫</th>
                                <th>৬</th>
                                <th>৭</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td style="white-space: nowrap;"><?php echo date('d-m-Y',strtotime($value->emp_join_date))?> ইং</td>
                                <td><?php echo $value->left_date=='' ? '':date('d-m-Y',strtotime($value->left_date))?> </td>
                                <td>সেচ্ছায়</td>
                                <td>    </td>
                                <td>    </td>
                            </tr>
                    
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-bottom: 20px;page-break-after: always;"></div>


            <div class="d-flex">
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> তৃতীয়ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> সার্ভিস রেকর্ড ও মজুরি এবং ভাতাসংক্রান্ত তথ্য</p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center">
                                <th>বর্তমান পদে চাকুরী আরম্ভের তারিখ</th>
                                <th>চাকুরীর পদ ও কার্ড নম্বর</th>
                                <th colspan="4">মাসিক মজুরির হার</th>
                            </tr>
                            <tr class="text-center">
                                <th>১</th>
                                <th>২</th>
                                <th colspan="4" >৩</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td>মূল মজুরী</td>
                                <td>বাড়ী ভাড়া ভাতা</td>
                                <td>চিকিৎসা ভাতা</td>
                                <td>বোনাস (যদি থাকে)</td>
                            </tr>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td>টাকা</td>
                                <td>টাকা</td>
                                <td>টাকা</td>
                                <td>টাকা</td>
                               
                            </tr>
                            <tr class="text-center">
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
            
                </div>

                <div style="width:1% !important"></div>
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> তৃতীয়ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> সার্ভিস রেকর্ড ও মজুরি এবং ভাতাসংক্রান্ত তথ্য</p>
                    <table class="table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center"> 
                                <th>অন্যান্য ভাতা</th>
                                <th>মোট, প্রভিডেন্ট ফান্ড (যদি থাকে)</th>
                                <th>শ্রমিকের প্রদেয় চাঁদা</th>
                                <th>মালিকের প্রদেয় চাঁদা</th>
                                <th>ত্যগ/অবসানের ধরন/কারন </th>
                                <th>মালিক/প্রাধিকার প্রাপ্ত ব্যক্তির স্বাক্ষর</th>
                                <th>শ্রমিকের স্বাক্ষর/টিপসই </th>
                            </tr>
                            <tr class="text-center">
                                <th>৩</th>
                                <th>৪</th>
                                <th>৫</th>
                                <th>৬</th>
                                <th>৭</th>
                                <th>৮</th>
                                <th>৯</th>
                            </tr>
                            <tr class="text-center">
                                <th>টাকা</th>
                                <th>টাকা</th>
                                <th>টাকা</th>
                                <th>টাকা</th>
                                <th>টাকা</th>
                                <th>টাকা</th>
                                <th>টাকা</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>২৯-১২-২০২০ ইং</td>
                                <td>২৯-১২-২০২০ ইং</td>
                                <td>সেচ্ছায়</td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-bottom: 20px;page-break-after: always;"></div>
            
            <div class="d-flex">
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> চতুর্থ ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> ছুটির রেকর্ডঃ </p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center">
                                <th colspan="4">ভোগকৃত বার্ষিক ছুটির বিবরণ</th>
                            </tr>
                            <tr  class="text-center" >
                                <th>হইতে</th>
                                <th>পর্যন্ত</th>
                                <th>মোট</th>
                                <th>অভোগকৃত পাওনা ছুটি</th>
                            </tr>
                            <tr  class="text-center" >
                                <th>১</th>
                                <th>২</th>
                                <th>৩</th>
                                <th>৪</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            
                        </tbody>
                    </table>
            
                </div>
                <div style="width:1% !important"></div>
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> চতুর্থ ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> ছুটির রেকর্ডঃ </p>
                    <table class="table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr class="text-center"> 
                                <th colspan="3">নগদায়নকৃত ছুটির বিবরণ</th>
                                <th rowspan="2">মালিক/প্রধিকার প্রাপ্ত ব্যক্তির স্বাক্ষর</th>
                                <th rowspan="2">শ্রমিকের স্বাক্ষর/টিপসই </th>
                            </tr>
                            <tr class="text-center">
                                <th>মোট</th>
                                <th>তারিখ</th>
                                <th>অবশিষ্ট পাওনা ছুটি</th>
                            </tr>
                            <tr class="text-center">
                                <th>৫</th>
                                <th>৬</th>
                                <th>৭</th>
                                <th>৮</th>
                                <th>৯</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                                <th>-</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div style="margin-bottom: 20px;page-break-after: always;"></div>
            <div class="d-flex">
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> পঞ্চম ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> আচরণের রেকর্ডঃ </p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr  class="text-center" >
                                <th>তারিখ</th>
                                <th>আচরণ বিষয়ক বিবরণ</th>
                                <th>মালিক/প্রধিকার প্রাপ্ত ব্যক্তির স্বাক্ষর</th>
                                <th>শ্রমিকের স্বাক্ষর/টিপসই</th>
                            </tr>
                            <tr  class="text-center" >
                                <th>১</th>
                                <th>২</th>
                                <th>৩</th>
                                <th>৪</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            
                        </tbody>
                    </table>
            
                </div> 
                <div style="width:1% !important"></div>
                <div class="flex-fill" style="height:90vh;width:60vw;border: 1px solid black;">
                    <p style="padding: 5px 0px 0px 5px;">ফরম নং - ৭(গ)</p>
                    <h6 class="text-center" style="font-weight:700;"> পঞ্চম ভাগ</h6>
                    <p style="padding: 5px 0px 0px 5px;font-weight:600;"> আচরণের রেকর্ডঃ </p>
                    <table class=" table-sm" style="font-size: 0.8em;width: 100%;" border="1">
                        <thead>
                            <tr  class="text-center" >
                                <th>তারিখ</th>
                                <th>আচরণ বিষয়ক বিবরণ</th>
                                <th>মালিক/প্রধিকার প্রাপ্ত ব্যক্তির স্বাক্ষর</th>
                                <th>শ্রমিকের স্বাক্ষর/টিপসই</th>
                            </tr>
                            <tr  class="text-center" >
                                <th>১</th>
                                <th>২</th>
                                <th>৩</th>
                                <th>৪</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            
                        </tbody>
                    </table>
            
                </div> 
            </div>

			<?php }?>
            <!-- <div style="page-break-after: always;"></div> -->
        </body>
    </body>
</html>
