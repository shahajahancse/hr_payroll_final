// ===========================================
// Salary Structure
// ===========================================
function salary_structure_cal(){
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }

   var gsal = document.getElementById('gross_sal').value;
   //==================================BGMEA Salary Rule=================================
   today = new Date().toISOString().slice(0, 10);
   if (today > '2023-12-01') {
      var mallow = 750;
      var trans_allow = 450;
      var lunch_allow = 1250;
   } else {
      var mallow = 600;
      var trans_allow = 350;
      var lunch_allow = 900;
   }

   document.getElementById('medical').value = mallow;
   document.getElementById('trans_allow').value = trans_allow;
   document.getElementById('food').value = lunch_allow;

   var bsal = Math.round((gsal - (mallow + trans_allow + lunch_allow)) / 1.5);
   document.getElementById('basic_sal').value = bsal;

   // var hrent = Math.round(bsal * 0.5);
   var hrent = Math.round(gsal - (mallow + trans_allow + lunch_allow + bsal));
   document.getElementById('house_rent').value = hrent;
   //==================================LOCAL Salary Rule==================================
}
