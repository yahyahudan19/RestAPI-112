<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_feedback', 'alamat_feedback', 'noHp_feedback', 'penyebab_feedback', 'q1_feedback', 'q2_feedback', 'q3_feedback', 'q4_feedback', 'q5_feedback'];
}
