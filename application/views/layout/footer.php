
  <!-- BEGIN CORE JS FRAMEWORK-->
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/boostrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/breakpoints.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
  <!-- END CORE JS FRAMEWORK -->

  <!-- BEGIN PAGE LEVEL JS -->
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/ios-switch/ios7-switch.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>

  <script src="<?=base_url()?>awedget/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>


  <script src="<?=base_url()?>awedget/assets/plugins/jquery-superbox/js/superbox.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

  <!-- BEGIN PAGE DATATABLE -->
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
  <script src="<?=base_url()?>awedget/assets/plugins/jquery-datatable/extra/js/TableTools.min.js" type="text/javascript" ></script>
  <script src="<?=base_url()?>awedget/assets/plugins/datatables-responsive/js/datatables.responsive.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- <script src="<?=base_url()?>awedget/assets/js/datatables.js" type="text/javascript"></script> -->
  <script src="<?=base_url()?>awedget/assets/js/tabs_accordian.js" type="text/javascript"></script>
  <script src="<?=base_url()?>awedget/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <script src="<?=base_url()?>awedget/assets/js/messages_notifications.js" type="text/javascript"></script>
  <!-- BEGIN CORE TEMPLATE JS -->
  <script src="<?=base_url()?>awedget/assets/js/core.js" type="text/javascript"></script>
  <!-- <script src="<?=base_url()?>awedget/assets/js/chat.js" type="text/javascript"></script>  -->
  <script src="<?=base_url()?>awedget/assets/js/demo.js" type="text/javascript"></script>

  <script src="<?=base_url()?>awedget/assets/croper/js/cropper.min.js"></script>
  <script src="<?=base_url()?>awedget/assets/croper/js/main.js"></script>

  <!-- END CORE TEMPLATE JS -->
  <!-- <script src="<?=base_url()?>awedget/assets/js/dashboard_v2.js" type="text/javascript"></script> -->
  <script type="text/javascript">
    $(document).ready(function () {
        // $(".live-tile,.flip-list").liveTile();
        $(".source").select2();
    });
  </script>

  <script src="<?=base_url()?>awedget/assets/js/jquery.bongabdo.js"></script>
  <!-- <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script> -->
  <script type="text/javascript">
    var iFrameID = document.getElementById('idIframe');
     // iFrameID.style.backgroundColor = 'green';
    function iframeLoaded() {
        var iFrameID = document.getElementById('idIframe');

          if(iFrameID){
          // iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
          var autoheight = iFrameID.contentWindow.document.body.scrollHeight;
          if(autoheight < '500'){
            iFrameID.height = "500px";
          }else{
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
          }
      }
    }
  </script>
<script>
  // $(function () {
  //   CKEDITOR.replace('editor1');
  // });


  $(function() {
    // Call SuperBox - that's it!
    $('.superbox').SuperBox();
  });


    // Designation Dropdown
    $('#office').change(function(){
      $("#employee > option").remove();
      var office_id = $('#office').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_employee_by_office/" + office_id,
        success: function(func_data)
        {
          $.each(func_data['union'],function(id,ut_name)
          {
            var opt = $('<option />');
            opt.val(id);
            opt.text(ut_name);
            $('#employee').append(opt);
          });

        }
      });
    });

    // estimated Budget check
    $(".exits").hide();
    $('#checking_lrb').change(function(){
      var fiscal_year = $('#checking_lrb').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_lrb_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });
    $('#checking_sa').change(function(){
      var fiscal_year = $('#checking_sa').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_sa_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });
    $('#checking_la').change(function(){
      var fiscal_year = $('#checking_la').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_la_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });

    $('#checking_upazila').change(function(){
      var fiscal_year = $('#checking_upazila').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_upazila_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });

    $('#checking_circle').change(function(){
      var fiscal_year = $('#checking_circle').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_circle_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });

    $('#checking_union').change(function(){
      var fiscal_year = $('#checking_union').val();
      $.ajax({
        type: "POST",
        url: hostname +"common/ajax_get_union_estimated_exits_by_fiscal_year/" + fiscal_year,
        success: function(fiscal_year)
        {
          if(fiscal_year){
            $(".used").hide();
            $(".exits").show();
          }else{
            $(".exits").hide();
            $(".used").show();
          }
        }
      });
    });


    // Jquery Onload
    $(document).ready(function() {
      // console.log( "run!" );

      //Datepicker
      $('.datetime').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
      });




      $('#letter_form_submit').on('click',function(){
        //alert("hh");
        var division_id = $('#division').val();
        if(division_id == null || typeof(division_id) == 'undefined' || division_id == '')division_id = '0';

        var district_id = $('#district').val();
        if(district_id == null || typeof(district_id) == 'undefined' || district_id == '')district_id = '0';

        var upazila_id = $('#upazila').val();
        if(upazila_id == null || typeof(upazila_id) == 'undefined' || upazila_id == '')upazila_id = '0';

        var union_id = $('#union').val();
        if(union_id == null || typeof(union_id) == 'undefined' || union_id == '')union_id = '0';

        var office_id = $('#offices').val();
        if(office_id == null || typeof(office_id) == 'undefined' || office_id == '')office_id = '0';

        var budget_fiscal_year_id = $('#budget_fiscal_year').val();
        if(budget_fiscal_year_id == null || typeof(budget_fiscal_year_id) == 'undefined' || budget_fiscal_year_id == '')budget_fiscal_year_id = '0';

        var budget_file_id = $('#budget_files').val();
        if(budget_file_id == null || typeof(budget_file_id) == 'undefined' || budget_file_id == '')budget_file_id = '0';
        $.ajax({
          type: "POST",
          url: "budget_setting/budget_letter_add/",
          data: { "division_id": division_id, "district_id": district_id, "upazila_id" : upazila_id, "union_id" : union_id, "office_id" : office_id, "budget_fiscal_year_id" : budget_fiscal_year_id, "budget_file_id" : budget_file_id },
          success: function(data)
            {

            }
          });
      });
    });

function loadOffices(data){
   $.each(data,function(id,name)
    {
      var opt = $('<option />');
      opt.val(id);
      opt.text(name);
      $('.office_val').append(opt);
    });
}
</script>

<script>
      setTimeout(function() {
        $('#mydivdanger').fadeOut('fast');
      }, 4000); // <-- time in milliseconds

      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
      }
    function printSpecificContents(id)
    {
          var divContents = document.getElementById(id).innerHTML;
          var printWindow = window.open('', '', 'height=800,width=1000');
          printWindow.document.write(divContents);

          printWindow.print();

    }
</script>

<script type="text/javascript">
  function subTotal(sl, sl2){
      var sum = 0;
      $(".sum_"+sl).each(function(){
          sum += +$(this).val();
      });

      $("#sum_"+sl).val(sum);

      var extra = $(".before_extra_"+sl2).val()-0;
      var budget = $(".single_"+sl2).val()-0;
      var after_extra = extra-budget;

      if(extra<budget){
          alert('বাজেট লিমিটেড ।');
          $(".single_"+sl2).val(0);
          var extra = $(".before_extra_"+sl2).val()-0;
          var budget = $(".single_"+sl2).val()-0;
          var after_extra = extra-budget;
      }

      $(".after_extra_"+sl2).val(after_extra);

      var extra = 0;
      $(".after_extra").each(function(){
          extra += +$(this).val();
      });
      $("#after_extra").val(extra);

      var sum = 0;
      $(".sum").each(function(){
          sum += +$(this).val();
      });
      $("#sum").val(sum);

  }

</script>

<script type="text/javascript">
  $(".sum").on("keyup", function() {
    var sum = 0;
    $(".sum").each(function(){
        sum += +$(this).val();
    });
    $("#sum").val(sum);
    var bangla_converted_number=en2bn(sum);
    var convert_in_word =convertNumberToWords(sum);
    $("#total-amount").html(bangla_converted_number + ' ('+convert_in_word+')');
    $(".edit-text").val($(".default-text").html());

    var extra = 0;
    $(".after_extra").each(function(){
        extra += +$(this).val();
    });
    $("#after_extra").val(extra);
  });
</script>

<script type="text/javascript">
  $(".edit-text").on("keyup", function() {
      $(".default-text").html($(".edit-text").val());
  });

  function en2bn(sum){
    var finalEnlishToBanglaNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};

    String.prototype.getDigitBanglaFromEnglish = function() {
        var retStr = this;
        for (var x in finalEnlishToBanglaNumber) {
             retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
        }
        return retStr;
    };

    var english_number=String(sum);

    var bangla_converted_number=english_number.getDigitBanglaFromEnglish();

    return bangla_converted_number;
  }

</script>


<!-- Privious year calculation -->
<script type="text/javascript">
  function subreceived(sl, sl2){
      var remaining=$(".received_"+sl2).val()-$(".expenditure_"+sl2).val();
      $(".remaining_"+sl2).val(remaining);

      var sub_received = 0;
      $(".received_"+sl).each(function(){
          sub_received += +$(this).val();
      });

      $("#received_"+sl).val(sub_received);

      var sub_remaining=$("#received_"+sl).val()-$("#expenditure_"+sl).val();
      $("#remaining_"+sl).val(sub_remaining);


      var total_received = 0;
      $(".received").each(function(){
          total_received += +$(this).val();
      });

      $("#received").val(total_received);

      var total_remaining=$("#received").val()-$("#expenditure").val();
      $("#remaining").val(total_remaining);

  }

  function subexpenditure(sl, sl2){
      var remaining=$(".received_"+sl2).val()-$(".expenditure_"+sl2).val();
      $(".remaining_"+sl2).val(remaining);

      var sub_received = 0;
      $(".expenditure_"+sl).each(function(){
          sub_received += +$(this).val();
      });

      $("#expenditure_"+sl).val(sub_received);

      var sub_remaining=$("#received_"+sl).val()-$("#expenditure_"+sl).val();
      $("#remaining_"+sl).val(sub_remaining);


      var total_received = 0;
      $(".expenditure").each(function(){
          total_received += +$(this).val();
      });

      $("#expenditure").val(total_received);

      var total_remaining=$("#received").val()-$("#expenditure").val();
      $("#remaining").val(total_remaining);

  }

  function update() {
    $("#notification_div").html('Loading..');
    $.ajax({
      type: 'GET',
      url: '',
      timeout: 2000,
      success: function(data) {
        //console.log(data);
        //$("#some_div").html(data);
        $("#notification_div").html('');
        window.setTimeout(update, 10000);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        $("#notification_div").html('Timeout contacting server..');
        window.setTimeout(update, 60000);
      }
  });
}

 $(document).ready(function () {
    $('.memorandum_no').bind('keydown', function(e){

        var num = this.value;

        if(e.keyCode== 32){
          e.preventDefault();
        }

        if(e.key!= 0 && e.key != 1 && e.key!= 2 && e.key!= 3 && e.key!= 4 && e.key!= 5 && e.key!= 6 && e.key!= 7 && e.key!= 8 && e.key!= 9 && e.keyCode!= 8 && e.keyCode!= 9 && e.keyCode!= 16 && e.keyCode!= 37 && e.keyCode!= 38 && e.keyCode!= 39 && e.keyCode!= 40){
          e.preventDefault();
        }

        if(num.length >= 5 && e.keyCode!= 8 && e.keyCode!= 9 && e.keyCode!= 16 && e.keyCode!= 37 && e.keyCode!= 38 && e.keyCode!= 39 && e.keyCode!= 40){
          e.preventDefault();
        }

    });
    // update();
  });

</script>

<script language="javascript" type="text/javascript">
     $(window).load(function() {
       $('#loading').hide();
    });

    function convertNumberToWords(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return words_string;
    }

</script>


<script>
 $(document).ready(function() {

    $("#main-menu ul > li").click(function(e) {
        $(this).siblings('li.active').removeClass("active");
        $(this).find('li.open').removeClass("open");
        $(this).addClass("active");
     });


    $('.anchor_cls').on('click', function(){
      $('#main-menu ul > li').siblings('ul li').find("a.mactive").removeClass("mactive");
      $(this).parent().siblings().find('.mactive').removeClass('mactive');
      $(this).addClass('mactive');
    });
 });
 </script>
 
</body>
</html>
