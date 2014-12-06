<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Purify HTML.
 *
 * @see http://codeigniter.com/wiki/htmlpurifier/
 * @param string $dirty_html
 * @return string Clean HTML.
 */
function purify($dirty_html)
{
	if (is_array($dirty_html))
 	{
		foreach ($dirty_html as $key => $val)
		{
			$dirty_html[$key] = purify($val);
		}

		return $dirty_html;
	}

	if (trim($dirty_html) === '')
	{
		return $dirty_html;
	}

	require_once(dirname(__FILE__) . '/HTMLPurifier/HTMLPurifier.auto.php'); 
	require_once(dirname(__FILE__) . '/HTMLPurifier/HTMLPurifier.func.php');

	$config = HTMLPurifier_Config::createDefault();

	$config->set('HTML.Doctype', 'XHTML 1.0 Strict');

	return HTMLPurifier($dirty_html, $config);
}

function purify_id($id)
{
    $id = (int)$id;
    
    return $id < 0 ? 0 : $id;
}
?>