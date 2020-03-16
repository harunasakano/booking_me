<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVacantShareUrl extends Model
{
    protected $table = 'user_vacant_share_urls';

    protected $fillable = [
        'url',
        'status',
        'user_id',
    ];

    const SHARE_URL_STATUS = [
        '0' => '公開中',
        '1' => '非公開',
    ];
}
