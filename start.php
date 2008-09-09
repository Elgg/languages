<?php
	/**
	 * Elgg languages
	 * 
	 * @package ElggLanguages
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */

	/**
	 * Initialise the languages tool
	 *
	 */
	function languages_init()
	{
		global $CONFIG;
		
		// Register a page handler, so we can have nice URLs
		register_page_handler('languages','languages_page_handler');
		
	}
	
	/**
	 * Adding the languages to the admin menu
	 *
	 */
	function languages_pagesetup()
	{
		if (get_context() == 'admin' && isadminloggedin()) {
			global $CONFIG;
			add_submenu_item(elgg_echo('languages'), $CONFIG->wwwroot . 'pg/languages/');
		}
	}
	
	/**
	 * languages page.
	 *
	 * @param array $page Array of page elements, forwarded by the page handling mechanism
	 */
	function languages_page_handler($page) 
	{
		global $CONFIG;
		
		if (isset($page[0]))
		{
			switch ($page[0])
			{
				case 'language' :
					if (isset($page[1]))
					{
						set_input('langcode', $page[1]);
						
						include($CONFIG->pluginspath . "languages/language.php"); 
					}
				break;
				default: include($CONFIG->pluginspath . "languages/index.php"); 
			}
		}
		else
			include($CONFIG->pluginspath . "languages/index.php"); 
	}
	
	
	
	// Initialise the languages tool
	register_elgg_event_handler('init','system','languages_init');
	register_elgg_event_handler('pagesetup','system','languages_pagesetup');
	
?>