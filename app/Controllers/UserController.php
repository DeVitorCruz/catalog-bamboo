<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AnnouncementModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    protected $userModel;
    protected $announcementModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->announcementModel = new AnnouncementModel();
    }

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|max_length[80]',
        'password_confirm' => 'required|matches[password]'
    ];

    public function login()
    {

        if ($this->request->getMethod() === 'POST') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Set session data and redirect

                session()->set($user);

                return redirect()->to('/'); // Redirect non-admin users

            } else {
                // Return with an error message
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->to('auth/login');
            }
            return view('auth/login'); // Show the logi form
        }

        return view('auth/login', ['isLoginPage' => true]);
    }

    public function register()
    {

        if ($this->request->getMethod() === 'POST') {

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

        return view('auth/register', ['isLoginPage' => true]);
    }

    public function getProfile()
    {

        $user_id = session()->get('user_id');

        $userData = $this->userModel->getUser($user_id);

        return view('admin/account_manager', ['user' => $userData]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('auth/login');
    }

    public function updateProfile()
    {
        $user_id = session()->get('user_id');

        $newUsername = $this->request->getPost('username');
        $newEmail = $this->request->getPost('email');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email,user_id,{user_id}]'
        ]);


        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'username' => $newUsername,
            'email' => $newEmail
        ];

        $this->userModel->update($user_id, $data);

        // Redirect with success message
        return redirect()->to('/profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword()
    {
        if ($this->request->getMethod() === 'POST') {
            $user_id = session()->get('user_id');

            // Get the input

            $currentPassword = $this->request->getPost('current_password');
            $newPassword = $this->request->getPost('new_password');
            $confirmPassword = $this->request->getPost('confirm_password');

            // Retrieve the user's current password hash from the database

            $user = $this->userModel->getUser($user_id);
            $hashedPassword = $user['password'];

            // Check if the current password matches

            if (!password_verify($currentPassword, $hashedPassword)) {
                session()->setFlashdata('error', 'Current password is incorrect.');
                return redirect()->to(base_url('profile'));
            }

            // Validate the new password

            if ($newPassword !== $confirmPassword) {
                session()->setFlashdata('error', 'New password and confirm password do not match.');
                return redirect()->to(base_url('profile'));
            }

            if (strlen($newPassword) < 8) {
                session()->setFlashdata('error', 'New password must be at least 8 characters long.');
                return redirect()->to(base_url('profile'));
            }

            if ($this->userModel->updatePassword($user_id, $newPassword)) {
                session()->setFlashdata('success', 'Password updated successfully.');
            } else {
                session()->setFlashdata('error', 'Failed to update password. Please try again.');
            }

            return redirect()->to(base_url('profile'));
        }

        return view('admin/update_password');
    }

    /**
     * Open the main user dashboard
     * 
     * @return string
     */
    public function mainDashboard()
    {
        return view('admin/dashboard');
    }

    /**
     * Open the design dashboard of the user
     * 
     * @return string
     */
    public function designDashboard()
    {

        // $announcements = $this->announcementModel->findAnnouncement();

        // $data = [
        //     'announcements' => $announcements
        // ];

        return view('admin/design-customization');
    }
}
