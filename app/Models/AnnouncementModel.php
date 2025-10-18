<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['title', 'content'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $dateFormat = 'datetime';
}
