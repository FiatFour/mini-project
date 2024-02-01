<?php
namespace App\Classes;

use App\Enums\Actions;
use App\Enums\Resources;

class Permissions
{
    static function getAllPermissions()
    {
        return [
            Resources::User => [
                _p(Actions::View, Resources::User),
                _p(Actions::Manage, Resources::User),
            ]
        ];
    }
}
