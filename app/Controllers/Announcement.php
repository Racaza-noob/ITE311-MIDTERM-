<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AnnouncementModel;

class Announcement extends Controller
{
    public function index()
    {
        $model = new AnnouncementModel();
        $announcements = $model
            ->orderBy('created_at', 'DESC')
            ->findAll();
        
        $data = [
            'announcements' => $announcements
        ];
        
        return view('announcements', $data);
    }
}
