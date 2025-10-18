<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Teacher extends BaseController
{
    protected $session;
    
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['url', 'form']);
    }
    
    public function dashboard()
    {
        // Check if user is logged in and is a teacher
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Please login as a teacher');
        }

        $data = [
            'title' => 'Teacher Dashboard',
            'user' => [
                'name' => $this->session->get('name') ?? 'Teacher',
                'email' => $this->session->get('email') ?? '',
                'role' => 'teacher'
            ]
        ];

        return view('teacher/teacher_dashboard', $data);
    }
    
    public function submitGrade()
    {
        // Check if user is logged in and is a teacher
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Please login as a teacher');
        }
        
        // Handle grade submission logic here
        return redirect()->back()->with('success', 'Grade submitted successfully');
    }
}
