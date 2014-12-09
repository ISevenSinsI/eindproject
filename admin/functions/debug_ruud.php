<?php

if (!function_exists('d'))
{
	function d($object = null, $title = '')
	{
		return Debug::dieObject($object, $title);
	}
}

if (!function_exists('dm'))
{
	function dm($object, $title = '', $line = 0)
	{
		return Debug::dieMail($object, $title, $line);
	}
}

if (!function_exists('p'))
{
	function p($object, $title = '')
	{
		return Debug::dieObject($object, $title, false);
	}
}

if (!function_exists('m'))
{
	function m($object, $title = '', $line = 0)
	{
		return Debug::dieMail($object, $title, $line, false);
	}
}


class Debug
{
	const TAG_NAME = 'pre';
	const CLASS_NAME = 'debug-code';
	const CSS_STYLE = 'background:#272822;color:#f8f8f2;overflow:auto;padding:.5em';
	const MAIL_SUBJECT = 'Debug';
	const MAIL_FROM_USER = 'debug';
	const MAIL_FROM_NAME = 'Debug';
	private static $_enabled = false;
	private static $_printedStyle = false;

	public static function enable($enable = true)
	{
		self::$_enabled = $enable;
	}

	public static function disable()
	{
		self::enable(false);
	}

	public static function isEnabled()
	{
		return self::$_enabled;
	}

	public static function dieObject($object = null, $title = '', $exit = true)
	{
		if (!self::isEnabled())
			return $object;

		if (!$exit ||
			$object !== null)
			echo self::getStyle().self::title($title).self::wrap(print_r($object, true));

		if ($exit)
			exit;

		return $object;
	}

	public static function dieMail($object, $title = '', $line = 0, $exit = true)
	{
		if (!self::isEnabled())
			return $object;

		$additionalHeaders = array(
			self::MAIL_FROM_NAME.' '.$_SERVER['SERVER_NAME'].' <'.self::MAIL_FROM_USER.'@'.$_SERVER['SERVER_NAME'].'>' => 'From',
			'1.0' => 'MIME-Version',
			'text/html; charset=UTF-8' => 'Content-Type',
		);

		/* Mail */
		$to = self::MAIL_TO;

		if (is_array($to))
			$to = implode(', ', $to);

		$subject = '['.self::MAIL_SUBJECT.'] '.($title ? $title.' - ' : '').$_SERVER['SERVER_NAME'];
		$message = str_replace("\n", "\r\n", self::title(__FILE__.($line ? ':'.$line : '')).self::wrap(print_r($object, true), true));
		$additional_headers = '';

		foreach ($additionalHeaders as $value => $name)
			$additional_headers .= $name.': '.$value."\r\n";

		mail($to, $subject, $message, $additional_headers);

		if ($exit)
			exit;

		return $object;
	}

	private static function getStyle()
	{
		if (self::$_printedStyle)
			return;

		self::$_printedStyle = true;
		return '<style type="text/css">'.self::TAG_NAME.'.'.self::CLASS_NAME.'{'.self::CSS_STYLE.'}</style>'."\n";
	}

	private static function title($title)
	{
		if (!$title)
			return;

		return '<p>'.htmlentities($title, false, 'UTF-8').'</p>';
	}

	private static function wrap($output, $inlineStyles = false)
	{
		return self::openWrap($inlineStyles).htmlentities($output, false, 'UTF-8').self::closeWrap();
	}

	private static function openWrap($inlineStyles = false)
	{
		return '<'.self::TAG_NAME.' '.($inlineStyles ? 'style="'.self::CSS_STYLE.'"' : 'class="'.self::CLASS_NAME.'"').'>';
	}

	private static function closeWrap()
	{
		return '</'.self::TAG_NAME.'>'."\n";
	}
}