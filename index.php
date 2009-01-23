<?php
	/**
	 * Elgg language tool
	 * 
	 * @package ElggLanguages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;
	
	$offset = (int)get_input('offset');
	$limit = (int)get_input('limit', 10);
	
	admin_gatekeeper();
	set_context('admin');
	// Set admin user for user block
		set_page_owner($_SESSION['guid']);

	$title = elgg_view_title(elgg_echo('languages'));
	
	$translations = array();
	$n = 0;
	foreach ($CONFIG->translations as $k => $v)
	{
		if (($n>=$offset) && ($n<$offset+$limit))
		{
			$tmp = new ElggObject();
			$tmp->subtype = 'language';
			$tmp->title = $k;
			$tmp->completeness = get_language_completeness($k);
	
			$translations[] = $tmp;
		}
		$n++;
	}
	
	$body .= elgg_view_entity_list($translations, count($CONFIG->translations), $offset, $limit, false);
	
	page_draw(elgg_echo('languages'),elgg_view_layout("two_column_left_sidebar", '', $title . $body));
?>