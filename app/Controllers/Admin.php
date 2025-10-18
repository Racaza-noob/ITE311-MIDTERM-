<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $session;
    protected $announcementModel;
    
    public function __construct()
    {
        $this->session = session();
        $this->announcementModel = new \App\Models\AnnouncementModel();
        
        // Check if user is logged in and is an admin
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'admin') {
            return redirect()->to(base_url('login'))->with('error', 'You do not have permission to access the admin area');
        }
    }
    
    public function dashboard()
    {
        // Get all announcements
        $announcements = $this->announcementModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
            
        $data = [
            'title' => 'Admin Dashboard',
            'user' => [
                'name' => $this->session->get('name'),
                'role' => $this->session->get('role')
            ],
            'announcements' => $announcements
        ];
        
        return view('admin/dashboard', $data);
    }
    
    public function createAnnouncement()
    {
        // Only handle POST requests
        if ($this->request->getMethod() === 'post') {
            // Load validation service
            $validation = \Config\Services::validation();
            
            // Set validation rules
            $rules = [
                'title' => 'required|min_length[5]|max_length[255]',
                'content' => 'required|min_length[10]'
            ];
            
            // Validate the input
            if ($this->validate($rules)) {
                // Get the input data
                $data = [
                    'title' => $this->request->getPost('title'),
                    'content' => $this->request->getPost('content')
                    // created_at will be set automatically by the model
                ];
                
                // Save to database
                if ($this->announcementModel->insert($data)) {
                    // If save is successful, set success message
                    $this->session->setFlashdata('success', 'Announcement created successfully!');
                } else {
                    // If save fails, set error message
                    $this->session->setFlashdata('error', 'Failed to create announcement. Please try again.');
                }
                
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                // If validation fails, return to dashboard with errors
                $data['validation'] = $this->validator;
                $data['title'] = 'Admin Dashboard';
                $data['user'] = [
                    'name' => $this->session->get('name'),
                    'role' => $this->session->get('role')
                ];
                
                return view('admin/dashboard', $data);
            }
        }
        
        // If not a POST request, redirect to dashboard
        return redirect()->to(base_url('admin/dashboard'));
    }
}
