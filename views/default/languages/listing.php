<?php
	/**
	 * Elgg languages
	 * 
	 * @package ElggLanguages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */
	
	global $CONFIG;
	
	$entity = $vars['entity'];
	
	$icon = elgg_view(
			'graphics/icon', array(
			'entity' => $entity,
			'size' => 'small',
		  )
		);

	$info .= "<p><b><a href=\"{$CONFIG->url}pg/languages/language/{$entity->title}/\">" . elgg_echo($entity->title) . "</a></b></p>";
	
	if ($entity->title!='en') $info .= "<div>" . (float)$entity->completeness . "% ". elgg_echo('complete') ."</div>";

	echo elgg_view_listing($icon, $info);
?>