<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $id = 'id_feedback';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_feedback', 'nama_feedback', 'alamat_feedback', 'noHp_feedback', 'penyebab_feedback', 'q1_feedback', 'q2_feedback', 'q3_feedback', 'q4_feedback', 'q5_feedback'];
}
