<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'report';
    protected $primaryKey = 'id_pelapor';
    protected $useTimestamps = true;
}