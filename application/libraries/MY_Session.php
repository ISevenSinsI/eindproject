<?php
class MY_Session extends CI_Session
{
    public function sess_update() 
    {
        // Just don't update session id.
        return;
    }
}
?>
