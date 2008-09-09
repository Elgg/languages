<?php
	/**
	 * Elgg language tool
	 * 
	 * @package ElggLanguages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;
	
	admin_gatekeeper();
	set_context('admin');
	
	$offset = (int)get_input('offset');
	$limit = (int)get_input('limit', 10);
	$langcode = get_input('langcode');
	
	$title = elgg_view_title(elgg_echo($langcode));
	
	$missing = get_missing_language_keys($langcode);
	
	$missing_obj = array();
	$n = 0;
	foreach ($missing as $code)
	{
		if (($n>=$offset) && ($n<$offset+$limit))
		{
			$tmp = new ElggObject();
			$tmp->subtype = 'missinglanguage';
			$tmp->title = $code;
			$tmp->description = elgg_echo($code, 'en');
	
			$missing_obj[] = $tmp;
		}
		$n++;
	}
	
	$body .= elgg_view_entity_list($missing_obj, count($missing), $offset, $limit, false);
	
	page_draw(elgg_echo($langcode),elgg_view_layout("two_column_left_sidebar", '', $title . $body));
?>