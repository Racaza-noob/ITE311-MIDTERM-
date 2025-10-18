<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Student extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        try {
            // Check if user is logged in and is a student
            if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'student') {
                return redirect()->to('/login')->with('error', 'Please login as a student to access this page');
            }

            // Load announcement model
            $announcementModel = new \App\Models\AnnouncementModel();
            
            // Get latest announcements (last 5)
            $announcements = $announcementModel
                ->orderBy('created_at', 'DESC')
                ->findAll(5);
                
            $data = [
                'title' => 'Student Dashboard',
                'user' => [
                    'name' => $this->session->get('name') ?? 'Jerald Student',
                    'email' => $this->session->get('email') ?? '',
                    'role' => 'student'
                ],
                'announcements' => $announcements ?? []
            ];

            return view('student/dashboard', $data);
            
        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Error in Student controller: ' . $e->getMessage());
            // Show a generic error message to the user
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard. Please try again.');
        }
    }
}
