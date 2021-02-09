<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailLaporanModel extends Model
{
    protected $table = "detail_report";
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
}
