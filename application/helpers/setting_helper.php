<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yura Loginov
 * @link		https://github.com/yuraloginoff/codeigniter-debug-helper.git
 */

// ------------------------------------------------------------------------

/**
 * Readable print_r
 *
 * get employee id
 *
 * @access	public
 * @param	mixed 
 */

if ( ! function_exists('gov_holiday'))
{
	function gov_holiday($date1, $date2, $type = null)
	{
		// Check if session data is set
        if (!isset($_SESSION['data']->unit_name)) {
            return null; // or handle the error as needed
        }
		$CI =& get_instance();
		$CI->db->where('unit_id', $_SESSION['data']->unit_name);
		$CI->db->where("date BETWEEN '$date1' AND '$date2'");
		$gd = $CI->db->get('pr_gov_holiday')->num_rows();
		
		if (!empty($gd)) {
			$date = date("Y-m-d", strtotime("+1 days".$date2));
			$date = rec_gov_holiday($date);
			$date = date("Y-m-d", strtotime("+$gd days".$date));
		} else {
			$date = $date2;
			$date = date("Y-m-d", strtotime("+1 days".$date2));
			$date = rec_gov_holiday($date);
		}
		$date = date("Y-m-d", strtotime("-1 days".$date));
		return $date;
	}
}

if ( ! function_exists('rec_gov_holiday'))
{
	function rec_gov_holiday($date)
	{
		// dd(date('d-m-Y', $date));
		$CI =& get_instance();
		$CI->db->where('unit_id', $_SESSION['data']->unit_name);
		$CI->db->where("date", $date);
		$gd = $CI->db->get('pr_gov_holiday')->num_rows();
		if (!empty($gd)) {
			$date = date("Y-m-d", strtotime("+1 days".$date));
			$date = rec_gov_holiday($date);
		}
		return $date;
	}
}

if ( ! function_exists('coff_day'))
{
	function coff_day($date)
	{
		$CI =& get_instance();
		$CI->db->where('work_off_date', $date)->where('unit_id',$_SESSION['data']->unit_name);
		$gd = $CI->db->get('attn_holyday_off')->row();
		if (!empty($gd)) {
			$date = date("Y-m-d", strtotime("+1 days".$date));
			$date = coff_day($date);
		}
		return $date;
	}
}


if ( ! function_exists('get_all_emp_id'))
{
	function get_all_emp_id($emp_cat = array(), $unit_id = 0)
	{

		// dd($emp_cat.'---'.$unit_id);
		
		$CI =& get_instance();
      	$CI->db->select('emp_id');
      	$CI->db->from('pr_emp_com_info'); 
      	$CI->db->where_in('pr_emp_com_info.emp_cat_id',$emp_cat);
		if ($unit_id != 0) {
			$CI->db->where('pr_emp_com_info.unit_id',$unit_id);
		}
		$query = $CI->db->get()->result_array();


		$data = array();
		array_walk($query, function($entry) use (&$data) {
		    $data[] = $entry["emp_id"];
		});
		return $data;
	}

}
if ( ! function_exists('add_days_skipping_fridays'))
{
	function add_days_skipping_fridays($date, $days,$emp_id) {
		$current_date = strtotime($date);
		$days_added = 0;
		while ($days_added < $days) {
			$current_date = strtotime('+1 day', $current_date);
			// Check if the current day is not Friday
			if (date('N', $current_date) != 5) {
				$CI =& get_instance();
				$holiday_date = $CI->db->where('emp_id',$emp_id)->where('holiday_date',$current_date)->get('pr_holiday')->row();
				if(empty($holiday_date)){
					$days_added++;
				}
			}
		}
		$dayss  = date('Y-m-d', strtotime($date. ' +'.$days.' days'));
		// dd($dayss);
		$gov_holiday= $CI->db->where('date >=',$date)->where('date <=',$dayss)->where('unit_id',$_SESSION['data']->unit_name)->get('pr_gov_holiday')->result();
		$count = count($gov_holiday);
		if($count > 0) {
			$current_date = strtotime('+' . $count . ' days', $current_date);
			// $current_date = strtotime($current_date,'+' . $count . ' days');
			// $current_date = strtotime('+' . $count . ' days', strtotime($current_date));
		}
		// dd(date('d/m/Y', $current_date));

		return date('d/m/Y', $current_date);
	}

}



// ------------------------------------------------------------------------

/**
 * Readable print_r
 *
 * get employee id
 *
 * @access	public
 * @param	mixed 
 */
if ( ! function_exists('check_acl_list'))
{
	function check_acl_list($user_id, $acl_level = NULL)
	{
		$CI =& get_instance();
		$CI->db->select("acl_id");
		$CI->db->where('username_id',$user_id);
		$query = $CI->db->get('member_acl_level')->result_array();

	 	$data = array();
		array_walk($query, function($entry) use (&$data) {
		    $data[] = $entry["acl_id"];
		});

		if (!empty($acl_level) && in_array($acl_level, $data)) {
			return true;
		} else if (!empty($acl_level)) {
			return false;
		} else {
			return $data;
		}
	}
}

// ------------------------------------------------------------------------



