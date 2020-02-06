<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacant extends Model
{
    protected $table = 'vacant';

    protected $fillable = [
        'date', 'status','user_id',
    ];

    const VACANT_STATUS = [
        '0' => '募集中',
        '1' => '締め切り',
    ];
}
