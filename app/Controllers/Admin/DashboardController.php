<?php
namespace App\Controllers\Admin;

use Core\BaseController;

class DashboardController extends BaseController
{
    protected static string $layout = 'admin';

    public function index()
    {
        $this->getResponse(static::$layout)->render('admin/index');
    }
}
