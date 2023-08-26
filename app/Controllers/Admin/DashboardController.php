<?php
namespace Controllers\Admin;

// use Core\BaseController;

class DashboardController extends AdminController
{
    // protected static string $layout = 'admin';

    public function index()
    {
        $this->response->render('admin/index');
    }
}
