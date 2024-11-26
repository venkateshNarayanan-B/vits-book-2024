<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserRoleModel;
use App\Models\RoleModel;

class Backend extends BaseController
{
    public function index()
    {
        $success = true; // Assume success condition

        if ($success) {
            //session()->setFlashdata('swal_success', 'Welcome to Vits Book. Complete solution in one place!');
        } else {
            //session()->setFlashdata('swal_error', 'Failed to save data.');
        }

        //dynamic datas to the page
        $data   =   array("title" => "Starter");
        return view("backend/main", $data);
    }

    //Login section
    public function login()
    {
        return view("backend/login");
    }

    //forget password section
    public function forgetPassword()
    {
        return view("backend/forgetPassword");
    }

    //chart section
    public function chart()
    {
        //dynamic data to the bage
        $data   =   array("title" => "Chart");
        return view("backend/chart", $data);
    }

    //form section
    public function form()
    {
        $data   =   array("title" => "Form");
        return view("backend/form", $data);
    }

    //alert section
    public function alert()
    {
        $data   =   array("title" => "Alert");
        return view("backend/alert", $data);
    }

    //session debugging
    public function debugSession()
    {
        $session = session();
        echo '<pre>';
        print_r($session->get());
        echo '</pre>';
        $userRoleModel = new UserRoleModel();
        $result = $userRoleModel->where('user_id', 1)->first();
        echo '</pre>';
        print_r($result);
        echo '</pre></br>';
        $roleModel = new RoleModel();
        print_r($roleModel->getPermissions(1));
        echo '</pre></br>';
        var_dump(has_permission('sample-test'));
    }

    //unauthorized section
    public function unauthorized()
    {
        $data   =   array("title" => "unauthorized");
        return view("backend/unauthorized", $data);
    }
}
