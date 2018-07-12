<?php

namespace App\Traits;

use App\Models\User;
use function dd;
use function ucfirst;

trait UserAttributes
{

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    public function getInitialsAttribute()
    {
        return ucfirst($this->first_name[0]) . ucfirst($this->last_name[0]);
    }

    public function setAvatarAttribute($value)
    {
        if (!$value)
        {
            $value = "https://ui-avatars.com/api/?name=" . urlencode($this->getFullNameAttribute());
        }
        return $value;
    }

}