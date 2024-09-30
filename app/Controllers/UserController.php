<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'password_confirm' => 'required|matches[password]'
    ];

    public function login()
    {
        return view('auth/login', ['isLoginPage' => true]);
    }

    public function cadastre()
    {
        // Load the registration form view
        return view('auth/register', ['isLoginPage' => false]);
    }

    public function register()
    {

        $validation = \Config\Services::validation();

        $validation->setRules($this->validationRules);

        // Check if the form passes validation
        if (!$validation->withRequest($this->request)->run()) {
            // Load view validation errors
            return view('auth/register', [
                'isLoginPage' => false,
                'validation' => $this->validator
            ]);
        }

        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $this->userModel->registerUser($userData);

        // Redirect to login page after successful registration
        return redirect()->to(base_url('auth/login'))->with('success', 'Registration successful. You can now log in.');
    }

    public function auth()
    {
        if ($this->request->getMethod() === 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Set session data and redirect
                session()->set('user_id', $user['user_id']);
                return redirect()->to('dashboard');
            } else {
                // Return with an error message
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->to('auth/login');
            }
            return view('auth/login'); // Show the logi form
        }
    }
}
