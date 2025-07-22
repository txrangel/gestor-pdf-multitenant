<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public function audits()
    {
        return $this->hasMany(ApiTokenAudit::class, 'token_id');
    }
}