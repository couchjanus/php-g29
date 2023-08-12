<?php

require_once ROOT.'/app/Core/BaseController.php';

class DashboardController extends BaseController
{
    protected static string $layout = 'admin';

    public function index()
    {
        $this->getResponse(static::$layout)->render('admin/index');
    }
}
