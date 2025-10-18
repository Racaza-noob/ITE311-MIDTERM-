<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is not logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }
        
        // If specific role is required, check it
        if (!empty($arguments)) {
            $userRole = $session->get('role');
            
            // If no specific role matches, redirect to appropriate dashboard
            if (!in_array($userRole, $arguments)) {
                $session->setFlashdata('error', 'You do not have permission to access this page');
                return $this->redirectToDashboard($userRole);
            }
        }
        
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
        return $response;
    }
    
    /**
     * Redirect to appropriate dashboard based on user role
     */
    private function redirectToDashboard($role)
    {
        switch (strtolower($role)) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'teacher':
                return redirect()->to('/teacher/dashboard');
            case 'student':
            default:
                return redirect()->to('/announcements');
        }
    }
}
