<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        // If already logged in, redirect to appropriate dashboard
        if (session()->get('isLoggedIn')) {
            return $this->redirectToDashboard(session()->get('role'));
        }
        
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        
        // Sample user data - in a real app, this would come from a database
        $users = [
            'admin' => [
                'id' => 1,
                'username' => 'admin',
                'password' => 'admin123',
                'name' => 'Administrator',
                'role' => 'admin'
            ],
            'teacher' => [
                'id' => 2,
                'username' => 'teacher',
                'password' => 'teacher123',
                'name' => 'Jim Jamero',
                'role' => 'teacher'
            ],
            'student' => [
                'id' => 3,
                'username' => 'student',
                'password' => 'student123',
                'name' => 'Jerald Student',
                'role' => 'student'
            ]
        ];
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Simple validation
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username and password are required');
        }
        
        // Check if user exists and password matches
        if (!isset($users[$username]) || $users[$username]['password'] !== $password) {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
        
        // Set user data in session
        $user = $users[$username];
        $session->set([
            'isLoggedIn' => true,
            'userId' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'role' => $user['role']
        ]);
        
        // Redirect based on role
        switch ($user['role']) {
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            case 'teacher':
                return redirect()->to(base_url('teacher/dashboard'));
            case 'student':
            default:
                return redirect()->to(base_url('student/dashboard'));
        }
    }
    
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    
    /**
     * Redirect user to their respective dashboard based on role
     * 
     * @param string $role User role (admin, teacher, student)
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function redirectToDashboard($role)
    {
        $role = strtolower($role);
        
        switch ($role) {
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            case 'teacher':
                return redirect()->to(base_url('teacher/dashboard'));
            case 'student':
            default:
                return redirect()->to(base_url('student/dashboard'));
        }
   
        
        // Check if user exists and password matches
        if (isset($users[$username]) && $users[$username]['password'] === $password) {
            return $users[$username];
        }
        
        return null;
    }
}
