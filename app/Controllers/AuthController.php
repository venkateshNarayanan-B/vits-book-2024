<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RememberTokenModel;  // Import the RememberTokenModel for managing remember tokens
use App\Models\PasswordResetModel;
use CodeIgniter\Email\Email;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    protected $userModel;            // User model for interacting with the users table
    protected $session;              // Session service to manage user session
    protected $validation;           // Validation service to validate form inputs
    protected $passwordResetModel;   // Model for password resets
    protected $rememberTokenModel;   // Model for managing remember tokens

    public function __construct()
    {
        // Initialize models and services
        $this->userModel = new UserModel();
        $this->rememberTokenModel = new RememberTokenModel();  // Initialize the model for remember tokens
        $this->passwordResetModel = new PasswordResetModel();
        $this->session = session();  // Start the session
        $this->validation = \Config\Services::validation();  // Validation service to be used for form validation
    }

    // Login method handles the user login logic
    public function login()
    {
        // Check if the form method is POST
        if ($this->request->getMethod() === 'post') {
            // Define validation rules for the login form inputs
            $rules = [
                'email' => 'required|valid_email',  // Email must be required and valid
                'password' => 'required|min_length[6]',  // Password must be required and at least 6 characters
            ];

            // If validation fails, reload the login view with error messages
            if (!$this->validate($rules)) {
                return view('backend/login', [
                    'validation' => $this->validator  // Pass the validation errors back to the view
                ]);
            }

            // Get email and password from the POST request
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Fetch the user by email from the database
            $user = $this->userModel->where('email', $email)->first();

            // If the user doesn't exist, show an error message and reload the login form
            if (!$user) {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
            }

            // Verify if the provided password matches the hashed password stored in the database
            if (!password_verify($password, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
            }

            // Store user data in the session after successful login
            $this->session->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'email' => $user['email'],
                'isLoggedIn' => true  // Set the user session as logged in
            ]);

            // Handle "Remember Me" functionality if the checkbox was checked
            if ($this->request->getPost('remember') !== null) {
                // Generate a unique token for the "Remember Me" functionality
                $rememberToken = bin2hex(random_bytes(16));

                // Store the generated token in the remember_tokens table
                $this->rememberTokenModel->save([
                    'user_id' => $user['id'],
                    'remember_token' => $rememberToken,
                    'created_at' => date('Y-m-d H:i:s')  // Store the creation time
                ]);

                // Set a cookie for the remember token, expires in 2 weeks
                set_cookie('remember_token', $rememberToken, 60 * 60 * 24 * 14);  // 2 weeks expiration
            }

            session()->setFlashdata('swal_success', 'Hai '.$this->session->get('user_name').'. You have logged in succesfully!');

            // Redirect the user to the admin dashboard after successful login
            return redirect()->to('/admin')->with('success', 'Logged in successfully!');
        }

        // If the request is not POST, display the login form
        return view('backend/login');
    }

    // Logout method to handle user logout functionality
    public function logout()
    {
        // Destroy the current session to log the user out
        $this->session->destroy();

        // Delete the remember token cookie
        delete_cookie('remember_token');  // Removes the remember token cookie

        // If a user was logged in, delete their remember token from the database
        if ($this->session->has('user_id')) {
            $userId = $this->session->get('user_id');
            $this->rememberTokenModel->where('user_id', $userId)->delete();  // Remove the token from remember_tokens table
        }

        // Redirect to login page with success message
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }

    // Method to handle forget password functionality
    public function forgetPassword()
    {
        // Check if the form method is POST (user has submitted the email)
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');  // Get the email from the POST request
            $user = $this->userModel->where('email', $email)->first();  // Check if the email exists in the database

            // If user exists, generate a reset token and send it to the user
            if ($user) {
                // Generate a secure reset token
                $token = bin2hex(random_bytes(32));

                // Update the user record with the reset token
                $this->userModel->update($user['id'], ['reset_token' => $token]);

                // Generate the reset link with the token
                $resetLink = base_url('reset-password/' . $token);

                // Send the password reset link to the user's email (implement email sending here)
                $this->sendPasswordResetEmail($email, $resetLink);

                // Redirect to login page with success message
                return redirect()->to('/login')->with('success', 'Password reset link has been sent to your email.');
            } else {
                // If email doesn't exist, show an error message
                return redirect()->back()->with('error', 'Email not found.');
            }
        }

        // If the request is not POST, display the forget password form
        return view('backend/forget_password');
    }

    // Method to handle password reset functionality
    public function resetPassword($token)
    {
        // Fetch the password reset record by the token
        $resetRequest = $this->passwordResetModel->where('token', $token)->first();

        // If no record is found for the provided token, redirect with error
        if (!$resetRequest) {
            return redirect()->to('/login')->with('error', 'Invalid or expired reset token.');
        }

        // Check if the form method is POST (user is submitting the new password)
        if ($this->request->getMethod() === 'post') {
            $newPassword = $this->request->getPost('password');  // Get the new password from the form

            // Find the user by email and update the password
            $user = $this->userModel->where('email', $resetRequest['email'])->first();

            // Update the password with the hashed new password and clear the reset token
            $this->userModel->update($user['id'], [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
                'reset_token' => null,  // Clear the reset token after successful password change
            ]);

            // Remove the password reset request record from the database
            $this->passwordResetModel->delete($resetRequest['id']);

            // Redirect to login page with success message
            return redirect()->to('/login')->with('success', 'Password reset successful.');
        }

        // If the request is not POST, show the reset password form
        return view('backend/reset_password', ['token' => $token]);
    }

    // Function to send email with the password reset link
    private function sendPasswordResetEmail($email, $resetLink)
    {
        // Initialize the email service
        $emailService = \Config\Services::email();

        // Set the recipient and sender information for the email
        $emailService->setTo($email);
        $emailService->setFrom('no-reply@yourdomain.com', 'Your App');
        $emailService->setSubject('Password Reset Request');
        $emailService->setMessage('Click the following link to reset your password: <a href="' . $resetLink . '">' . $resetLink . '</a>');

        // Send the email and check for success
        if (!$emailService->send()) {
            log_message('error', 'Failed to send password reset email to ' . $email);  // Log an error if email fails
        }
    }
}
