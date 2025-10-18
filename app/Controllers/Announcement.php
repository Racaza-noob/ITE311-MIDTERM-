<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Announcement extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $announcements = $db->table('announcements')
                          ->orderBy('created_at', 'DESC')
                          ->get()
                          ->getResultArray();
        
        $data = [
            'announcements' => $announcements
        ];
        
        return view('announcements', $data);
    }
}
