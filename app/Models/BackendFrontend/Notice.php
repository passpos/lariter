<?php

namespace App\Models\BackendFrontend;

use App\Models\Model;

class Notice extends Model {

    protected $table = 'bf_notices';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content'];

}
