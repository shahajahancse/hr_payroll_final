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
if ( ! function_exists('get_all_emp_id'))
{
	function get_all_emp_id($emp_cat = array(), $unit_id = null)
	{
		$CI =& get_instance();
      	$CI->db->select('emp_id');
      	$CI->db->from('pr_emp_com_info'); 
      	$CI->db->where_in('pr_emp_com_info.emp_cat_id',$emp_cat);
		if ($unit_id != null) {
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
