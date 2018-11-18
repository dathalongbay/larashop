<?php
//app/Helpers/Envato/User.php
namespace App\Helpers\Common;

use Illuminate\Support\Facades\DB;


class Computer
{
    public $monitor;
    public $keyboard;
    public function __construct(Monitor $monitor, Keyboard $keyboard)
    {
        $this->monitor = $monitor;
        $this->keyboard = $keyboard;
    }

    public static function get_username2($user_id) {


        return __FILE__;
    }
}