<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; // We don't need updated_at for announcements
    protected $allowedFields = ['title', 'content', 'created_at'];
    
    // This ensures the created_at field is automatically set on insert
    protected $beforeInsert = ['setCreatedAt'];
    
    protected function setCreatedAt(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }
}
