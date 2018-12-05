<?php

namespace App\Mariadb\BackendFrontend;

use App\Mariadb\Model;

class Notice extends Model {

    protected $table = 'bf_notices';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content'];

}
