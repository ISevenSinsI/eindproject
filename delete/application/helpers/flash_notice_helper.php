<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

/**
 * Flash Notice Helper
 *
 * The temporary informational messages you see after an action has occurred
 * (Built with native PHP Sessions)
 *
 * <code>
 * <?php
 * // Add messages from Anywhere in your app
 * FlashNotice::add('Oops, an Error occurred', 'error');
 * FlashNotice::add("Welcome Back, {$User['name']}", 'info');
 * // In the view (like your templates Header) display the notices
 * FlashNotice::display();
 * // Make sure to copy the Css and images into your project and include the FlashNotice Css.
 * // Use the Javascript of your choice to make the FlashNotice Box disappear
 * // 	when the close buttons are clicked.
 * // That's It!
 * </code>
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Andy Blackwell <web@andyblackwell.com>
 * @link		www.andyblackwell.com
 * @version		1.0
 */
class FlashNotice {
    const INPUT_ERROR = 'input_error';
    /**
     * @access private
     * @staticvar array $types Different display message types
     */
    static private $types = array('info', 'success', 'warning', 'error', FlashNotice::INPUT_ERROR);
    static private $CI;

    static private function getSession() {
        if (!isset(self::$CI)) {
            self::$CI = get_instance();
        }
        if (!isset(self::$CI->session)) {
            self::$CI->load->library('session');
        }
        return self::$CI->session;
    }

    static public function getTypes() {
        return self::$types;
    }

    static public function setStatus($status) {
        $session = self::getSession();
        $session->set_userdata('FlashNotice_status', $status);
    }

    /**
     * Add Message to Flash Notice log
     *
     * Takes a string and appends it to the Flash Notice Message array
     * Message $type defaults to 'success' but can be changed to any of the $types declared above
     *
     * @static
     * @access	public
     * @param	string $notice message to be displayed
     * @param	string $type message type - info, success, warning, error
     * @return	void
     */
    static public function add($notice, $type = 'success') {
        $session = self::getSession();
        $type = trim(strtolower($type)); // Make lowercase, trim whitespace
        $notice = trim($notice); // trim whitespace
        //$notice = strip_tags($notice); // Only text please...removes php/html tags to keep layout from breaking
        // Make sure everything checks out...
        // -a string is a string and nothing else
        // -only allow the defined message types (anything else would break the css styling)
        if (
                !is_string($notice)
                OR !is_string($type)
                OR !in_array($type, self::$types)
        ) {
            return false;
        }

        // If the Session variable 'FlashNotice' isn't set
        // then set it up as an empty array
        if ($session->userdata('FlashNotice') === false) {
            $session->set_userdata('FlashNotice', array());
        }

        $FlashNotice = $session->userdata('FlashNotice');
        // For each of the defined message types
        // Check if it exists inside the 'FlashNotice' variable
        // If not, then set it up as an empty array
        foreach (self::$types as $valid_type) {
            if (!isset($FlashNotice[$valid_type])) {
                $FlashNotice[$valid_type] = array();
                $session->set_userdata('FlashNotice', $FlashNotice);
            }
        }

        // Store the message inside the correct message-type array in the Session
        $FlashNotice[$type][] = $notice;
        $session->set_userdata('FlashNotice', $FlashNotice);
        $session->sess_write();
    }

    /**
     * Display Flash Notice Messages
     *
     * Displays the HTML for the Flash Notice Message if any messages have been stored
     * then destroys the Session Variable it is stored in, so it only displays once
     *
     * @static
     * @access	public
     * @return	void
     */
    static public function display($view = 'FlashNotice', $return = false) {
        $result = '';
        $session = self::getSession();

        $anyMessages = false; // will update to TRUE if there happen to be any Notices at all
        // If the 'FlashNotice' hasn't even been set yet,
        // then no messages have been saved and we skip this block
        if ($session->userdata('FlashNotice') !== false) {
            $FlashNotice = $session->userdata('FlashNotice');
            $types = FlashNotice::getTypes();
            foreach ($types as $type) {
                $anyMessages = false;
                if (count($FlashNotice[$type]) > 0) {
                    $anyMessages = true;
                    // All we need is one to print the Notice
                    break;
                }
            }
            if ($anyMessages) {
                $result = self::$CI->load->view($view, $return);
            }
        }
        // Destoys the 'FlashNotice' Session var
        self::destroy();
        return $result;
    }

    static public function messages() {
        $session = self::getSession();
        $messages = array();

        // If the 'FlashNotice' hasn't even been set yet,
        // then no messages have been saved and we skip this block
        if ($session->userdata('FlashNotice') !== false) {
            $FlashNotice = $session->userdata('FlashNotice');
            $types = FlashNotice::getTypes();

            foreach ($types as $type) {
                foreach ($FlashNotice[$type] as $message) {
                    $messages[$type][] = $message;
                }
            }
        }


        // If the 'FlashNotice' hasn't even been set yet,
        // then no messages have been saved and we skip this block
        if ($session->userdata('FlashNotice_dm_error') !== false) {
            $FlashNotice = $session->userdata('FlashNotice_dm_error');

            $messages[FlashNotice::INPUT_ERROR] = $FlashNotice;
        }
        
        // If the 'FlashNotice' hasn't even been set yet,
        // then no messages have been saved and we skip this block
        if ($session->userdata('FlashNotice_status') !== false) {
            $FlashNotice = $session->userdata('FlashNotice_status');

            $messages['status'] = $FlashNotice;
        }
        
        // If the 'FlashNotice' hasn't even been set yet,
        // then no messages have been saved and we skip this block
        if ($session->userdata('FlashNotice_extra') !== false) {
            $FlashNotice = $session->userdata('FlashNotice_extra');

            $messages['extra'] = $FlashNotice;
        }

        // Destoys the 'FlashNotice' Session var
        self::destroy();

        return $messages;
    }

    static public function messages_json() {
        return json_encode(self::messages());
    }

    static public function messages_html() {
        $result = '';

        foreach (self::messages() as $type => $messages_array) {
            foreach ($messages_array as $message) {
                $result .= $message . '<br />';
            }
        }

        return $result;
    }

    /**
     * Private Method
     * Destroy FlashNotice Session var
     *
     * Deletes the Session variable which contains the Flash Notice Messages
     *
     * @access	private
     * @return	void
     */
    static private function destroy() {
        $session = self::getSession();
        $session->unset_userdata('FlashNotice');
        $session->unset_userdata('FlashNotice_dm_error');
        $session->unset_userdata('FlashNotice_status');
        $session->unset_userdata('FlashNotice_extra');
        $session->sess_write();
    }

    static function to_json($status = null) {
        $data = array('status' => 0, 'messages' => array(), FlashNotice::INPUT_ERROR => '');
        $my_status = 1;
        $messages = self::messages();
        $input_errors = array();
        $status_messages = array();
        $extra = '';
       

        // Differentiate between status messages and input_errors.
        foreach ($messages as $type => $message) {
            switch ($type) {
                case 'input_error':
                    $input_errors = $message;
                    break;
                case 'error':
                    $my_status = 0;
                    $status_messages[] = $message;
                    break;
                case 'status':
                    $status = $message;
                    break;
                case 'extra':
                    foreach($message as $key => $value)
                    {
                        $data[$key] = $value;
                    }
                    break;
                default:
                    $status_messages[] = $message;
                    break;
            }
        }

        if (is_null($status)) {
                $status = $my_status;
        }
        
        $data['status'] = $status;
        $data['input_error'] = $input_errors; 
        $data['messages'] = $status_messages; 

        return json_encode($data);
    }

    static function add_dm_error(DM_Error_Object $dm_error) {
        $session = self::getSession();

        if ($session->userdata('FlashNotice_dm_error') === false) {
            $session->set_userdata('FlashNotice_dm_error', array());
        }

        $FlashNotice = $session->userdata('FlashNotice_dm_error');

        foreach ($dm_error->all as $name => $message) {
            $FlashNotice[$name] = $message;
        }

        $session->set_userdata('FlashNotice_dm_error', $FlashNotice);
    }

    static function add_extra($key, $value) {
        $session = self::getSession();

        if ($session->userdata('FlashNotice_extra') === false) {
            $session->set_userdata('FlashNotice_extra', array());
        }

        $FlashNotice = $session->userdata('FlashNotice_extra');
        $FlashNotice[$key] = $value;
    
        $session->set_userdata('FlashNotice_extra', $FlashNotice);
    }
}
