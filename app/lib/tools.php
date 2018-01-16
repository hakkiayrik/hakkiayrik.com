<?php

class Tools extends app
{
    public static function log($message)
    {
        $date = date('d.m.Y h:i:s');
        error_log($date . '=>' . $message ."\n", 3,ROOT_DIR . '/var/error.log');
    }
    public static function getLog(){
        return file_get_contents(ROOT_DIR . '/var/error.log');
    }
}