<?php

namespace App\Enums;

abstract class Actions
{
    const Manage = 'manage';
    const View = 'view';


    static function print($permission)
    {
        $permission_action = explode('_', $permission)[0];
        return self::format($permission_action);
    }

    static function format($action)
    {
        return __('permissions.' . $action);
    }
}
