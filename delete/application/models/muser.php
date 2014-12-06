<?php

class MUser extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    public function get($id)
    {
        $user = new User();
        $user->where("id", $id);
        $user->include_related("role")->get();

        $data = array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "role" => $user->role_name,
            "phone" => $user->phone,
            "address" => $user->address,
            "zipcode" => $user->zipcode,
            "city" => $user->city,
            "country" => $user->country,
        );


        return $data;
    }
    public function get_all()
    {
        $data = array();

        $user = new User();

        foreach($user->include_related("role")->get() as $_user)
        {
            $data[$_user->id] = $_user->to_array();
            $data[$_user->id]["role"] = $_user->role_name;
        }

        return $data;
    }
    public function get_current_user_id()
    {
        return $_SESSION["user"]["id"];
    }
    function is_logged_in() {
        if ( isset( $_SESSION["user"]["id"] ) ) {
            return $_SESSION["user"]["id"] > 0;
        }
    }

    /**
     * Login user.
     *
     * @param string  $email
     * @param string  $password
     * @return bool True if successfull login, false otherwise.
     */

    function login( $email, $password ) {
        $user = new User();
        $user
        ->where( "email", $email )
       ->where( "password", $this->_prepare_password( $password ) )
        ->get();

        if ( $user->exists() ) {
            $_SESSION["user"] = $user->to_array();

            return true;
        }

        return false;
    }

    /**
     * Logout user
     */
    function logout() {
        unset( $_SESSION["user"] );

        return true;

    }

    /**
     * Reset password for $email.
     *
     * @param string  $email
     * @return string If user exists and email ok => new password, empty string otherwise.
     */
    function reset_password( $email, $length = 8 ) {
        $this->load->library();

        $new_password = substr( md5( time() ), 10, $length );

        $user = new User();
        $user->where( 'email', $email );

        if ( $user->get()->exists() ) {
            $user->password = $this->_prepare_password( $new_password );
            $user->save();
            $this->mail_password( $email, $new_password );
            return true;
        }
        return false;
    }

    /**
     * Mail password for $user.
     *
     * @param string  $mail
     * @param string  $password (plain)
     * @return boolean
     */
    function mail_password( $email, $password ) {


        $html = "
            Geachte meneer / mevrouw ,<br />
            <br />
            U heeft aangegeven dat u uw wachtwoord voor Ter Aa evenementen systeem bent vergeten. <br />
            <br />
            In deze e-mail vindt u een nieuw wachtwoord, wij raden u aan om het<br />
            wachtwoord zo snel mogelijk aan te passen.<br />
            <br />
            U kunt inloggen met onderstaande gegevens:<br />
            <br />
            Gebruikersnaam: {$email}<br />
            Wachtwoord: {$password}<br />
            <br />
            Klik <a href=\"". site_url() ."\">hier</a> om direct in te loggen.<br />
            <br />
            Met vriendelijke groet,<br />
            <br />
            Ter Aa<br />
        ";

        // load library and configuration
        $this->load->config( 'email' );
        $this->load->library( 'email', $this->config->item( 'email' ) );

        // configure email
        $this->email->from( 'noreply@Teraa.com', 'Ter Aa' );
        $this->email->to( $email );

        $this->email->subject( "Nieuw wachtwoord voor Ter Aa evenementen systeem" );
        $this->email->message( $html );

        // send email
        $this->email->send();
    }

    function welcome_user( $name, $email, $password ) {
        $html = "
            Beste {$name},<br />
            <br />
            U kunt inloggen met onderstaande gegevens:<br />
            <br />
            Gebruikersnaam: {$email}<br />
            Wachtwoord: {$password}<br />
            <br />
            Klik <a href=\"". site_url() ."\">hier</a> om direct in te loggen.<br />
            <br />
            Met vriendelijke groet,<br />
            <br />
            Ter Aa
        ";

        // load library and configuration
        $this->load->config( 'email' );
        $this->load->library( 'email', $this->config->item( 'email' ) );

        // configure email
        $this->email->from( 'noreply@teraa.com', 'Ter Aa' );
        $this->email->to( $email );

        $this->email->subject( "Welkom bij Tera Aa evenenten systeem" );
        $this->email->message( $html );

        // send email
        $this->email->send();

    }

    /**
     * Generates a new password
     *
     * @return string
     */
    function generate_password() {
        $this->load->helper( 'string' );
        return random_string();
    }

    /**
     * Deletes a user
     *
     * @param int     $id
     * @return bool
     */
    function delete( $id ) {
        $id = purify_id( $id );
        $user = new User( $id );
        $original_username = $user->name;

        if ( $user->delete() ) {

            // Log
            $user_id = $this->get_current_user_id();
            // Logger::delete( "Gebruiker '{$original_username}' verwijderd", $organisation_id, $user_id );
            
            return true;
        }
        else {
            return false;
            FlashNotice::add_dm_error( $user->error );
        }
    }

    /**
     * Store (save) an user
     *
     * @param type    $id
     * @param type    $name
     * @param type    $email
     * @param type    $role
     * @return type
     */
    function store( $id, $name, $email, $role) {


        // Do a check on email first
        if ( !valid_email( $email ) ) {
            return -1;
        }

        // Check if mail exists, if so, edit that user
        $sendWelcomeMail = false;
        if ( $id == 0 ) {
            $query = "SELECT `id` FROM `users` WHERE `email` = '{$email}'";
            $query = mysql_query( $query );

            if ( mysql_num_rows( $query ) > 0 ) {
                $row = mysql_fetch_assoc( $query );

                $id = $row["id"];

                mysql_query( "UPDATE `users` SET `deleted` = '0000-00-00 00:00:00' WHERE `id` = '{$id}'" );

                $sendWelcomeMail = true;
            }
        }

        // Purify ids
        $id = purify_id( $id );
        $role = purify_id( $role );

        // Create objects
        $user = new User( $id );

        $role = new Role( $role );

        // Set the user settings
        $original_username = $user->name;
        $user->name = $name;
        $user->email = $email;

        if ( $organisation > 0 ) {
            $organisation = new Organisation( $organisation );
            $user->group_id = $organisation->group_id;
            $user->organisation_id = $organisation->id;

        }

        // Save user
        if ( $user->store( $role ) ) {

            // Log
            $user_id = $this->get_current_user_id();
            $organisation_id = $this->get_organisation_id( $user_id );

            if ( $id > 0 ) {
                if ( $sendWelcomeMail ) {
                    $password = $this->generate_password();
                    $user->password = $this->_prepare_password( $password );
                    $user->save();

                    $this->welcome_user( $user->name, $user->email, $password );
                }

                Logger::update( "Gebruiker '{$original_username}' aangepast", $organisation_id, $user_id );
            }
            else {

                $password = $this->generate_password();
                $user->password = $this->_prepare_password( $password );

                $user->save();

                $this->welcome_user( $user->name, $user->email, $password );

                Logger::create( "Gebruiker '{$user->name}' toegevoegd", $organisation_id, $user_id );
            }


            return $user->id;
        }

        // Save went wrong, return 0
        FlashNotice::add_dm_error( $user->error );
        return 0;
    }

    /**
     * Check if we have an user with that email
     *
     * @param type    $email
     * @return type
     */
    private function _email_exists( $email ) {
        $user = new User();

        $user->where( "email", $email )->get();

        return $user->exists();
    }

    /**
     * Change the password of an user
     *
     * @param int     $id
     * @param string  $current_password
     * @param string  $new_password
     * @param string  $new_password_check
     * @return type
     */
    public function change_password( $id, $current_password, $new_password, $new_password_check ) {
        $user = new User( $id );


        // Check if current passwords are the same
        if ( $user->password != $this->_prepare_password( $current_password ) ) {
            return "Uw huidige wachtwoorden komen niet overeen";
        }

        // Check if new passwords are the same
        if ( $new_password != $new_password_check ) {
            return "Uw nieuwe wachtwoorden komen niet overeen";
        }

        // Check if password length is a minimal of 5 characters
        $check_password_errors = $this->_check_password( $new_password );
        if ( count( $check_password_errors ) > 0 ) {
            $errorHTML = "<ul>";
            foreach ( $check_password_errors as $error ) {
                $errorHTML .= "<li>{$error}</li>";
            }
            $errorHTML .= "</ul>";

            return $errorHTML;
        }

        // Seems valid
        $user->password = $this->_prepare_password( $new_password );

        if ( $user->save() ) {
            return true;
        }

        return "Er ging iets fout bij het opslaan";

    }

    private function _prepare_password( $password ) {
        return sha1( $password );
    }

    private function _check_password( $password ) {
        $errors = array();

        if ( strlen( $password ) < 5 ) {
            $errors[] = "Uw wachtwoord is te kort.";
        }

        if ( !preg_match( "#[a-z]+#", $password ) ) {
            $errors[] = "Uw wachtwoord moet minstens 1 letter bevatten";
        }

        if ( !preg_match( "#[A-Z]+#", $password ) ) {
            $errors[] = "Uw wachtwoord moet minstens 1 hoofdletter bevatten";
        }

        if ( !preg_match( "#[0-9]+#", $password ) ) {
            $errors[] = "Uw wachtwoord moet minstens 1 nummer bevatten";
        }

        return $errors;
    }
    public function store_password($user_id, $password){
         
        $_password = $this->_prepare_password($password);

        $user = new User($user_id);
        $user->password = $_password;

        if($user->save())
        {
            return $user->id;
        }

        return false;
    }
    public function save($id, $data)
    {
        $user = new User($id);

        $user->name = $data["name"];        
        $user->email = $data["email"];
        $user->role_id = $data["role_id"];
        $user->email = $data["email"];
        $user->phone = $data["phone"];
        $user->city = $data["city"];
        $user->address = $data["address"];
        $user->zipcode = $data["zipcode"];
        $user->country = $data["country"];

        if($user->save())
        {
            return $user->id;
        }

        return false;
    }
}
