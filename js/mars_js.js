function daily_attendance_summary(){
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate ==''){
		alert("Please select date");
		return;
	}
	
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){
		alert("Please select Unit");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select'){
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_attendance_summary/"+firstdate+"/"+category+"/"+unit_id;
	
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}
/*
function daily_attendance_summary_test(){
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate ==''){
		alert("Please select date");
		return;
	}
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){
		alert("Please select Unit");
		return;
	}
	var category = document.getElementById('category').value;
	if(category =='Select'){
		alert("Please select Category options");
		return;
	}
	hostname = window.location.href;
hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_attendance_summary_test/"+firstdate+"/"+category+"/"+unit_id;
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}*/
function daily_attendance_summary_test(){
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate ==''){
		alert("Please select date");
		return;
	}
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){
		alert("Please select Unit");
		return;
	}
	var category = document.getElementById('category').value;
	if(category =='Select'){
		alert("Please select Category options");
		return;
	}
	
	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_attendance_summary_test/"+firstdate+"/"+category+"/"+unit_id;
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}

function daily_ot_summary(){
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate ==''){
		alert("Please select date");
		return;
	}
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select'){
		alert("Please select Unit");
		return;
	}
	var category = document.getElementById('category').value;
	if(category =='Select'){
		alert("Please select Category options");
		return;
	}
	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_ot_summary/"+firstdate+"/"+category+"/"+unit_id;
	daily_att_sum = window.open(url,'daily_att_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_att_sum.moveTo(0,0);
}


function daily_costing_summary()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select')
	{
		alert("Please select Unit");
		return;
	}
	
	/*var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}*/
	
	
	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_costing_summary/"+firstdate+"/"+unit_id;
	
	daily_costing_sum = window.open(url,'daily_costing_sum',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_costing_sum.moveTo(0,0);
}
	
	
//////////////////daily_logout_report////////////
function daily_logout_report()
{
	var firstdate = document.getElementById('firstdate').value;	
	if(firstdate =='')
	{
		alert("Please select date");
		return;
	}
	
	var unit_id = document.getElementById('grid_start').value;
	if(unit_id =='Select')
	{
		alert("Please select Unit");
		return;
	}
	
	var category = document.getElementById('category').value;
	if(category =='Select')
	{
		alert("Please select Category options");
		return;
	}
	
	
	hostname = window.location.href;
	hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
	url =  hostname + "index.php/mars_con/daily_logout_report/"+firstdate+"/"+category+"/"+unit_id;
	
	daily_logout = window.open(url,'daily_logout',"menubar=1,resizable=1,scrollbars=1,width=1600,height=800");
	daily_logout.moveTo(0,0);
}


