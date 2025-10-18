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
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Please login as a teacher');
        }

        // Get flash messages if any
        $data = [
            'title' => 'Teacher Dashboard',
            'user' => [
                'name' => session()->get('name') ?? 'Teacher',
                'email' => session()->get('email') ?? '',
                'role' => 'teacher'
            ]
        ];

        // Check if the view file exists
        if (!is_file(APPPATH . 'Views/teacher/teacher_dashboard.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dashboard view not found');
        }

        return view('teacher/teacher_dashboard', $data);
    }

    public function submitGrade()
    {
        // Check if user is logged in and is a teacher
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'teacher') {
            return redirect()->to('/login')->with('error', 'Please login as a teacher');
        }
        
        // Check if the request is a POST request
        if ($this->request->getMethod() === 'post') {
            // Get form data
            $studentId = $this->request->getPost('student_id');
            $taskCompletion = $this->request->getPost('task_completion');
            $codeQuality = $this->request->getPost('code_quality');
            $problemSolving = $this->request->getPost('problem_solving');
            $versionControl = $this->request->getPost('version_control');
            $comments = $this->request->getPost('comments');
            
            // Calculate total score
            $totalScore = (int)$taskCompletion + (int)$codeQuality + 
                         (int)$problemSolving + (int)$versionControl;
            
            // In a real app, you would save this to a database
            // For now, we'll just prepare the data to show
            $gradeData = [
                'student_id' => $studentId,
                'task_completion' => $taskCompletion,
                'code_quality' => $codeQuality,
                'problem_solving' => $problemSolving,
                'version_control' => $versionControl,
                'total_score' => $totalScore,
                'comments' => $comments,
                'graded_at' => date('Y-m-d H:i:s')
            ];
            
            // For now, just show the grade data
            // In a real app, you would save this to your database
            // and redirect with a success message
            
            return view('grade_submitted', [
                'grade' => $gradeData,
                'student' => [
                    'id' => $studentId,
                    'name' => 'Student Name' // You would get this from your database
                ]
            ]);
        }
        
        // If not a POST request, redirect back to dashboard
        return redirect()->to('/teacher/dashboard');
    }
}
