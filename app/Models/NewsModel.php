<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $id = 'id_news';
    protected $useTimestamps = true;
    protected $allowedFields = ['tagline_news', 'date_news', 'judul_news', 'isi_news', 'isi2_news', 'isi3_news', 'isi4_news', 'visible_news', 'dokumentasi_news'];
}