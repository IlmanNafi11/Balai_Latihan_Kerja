<?php
$uri = trim($_SERVER['REQUEST_URI'], '/');
session_start();
if ($uri == '/' || $uri == '' || $uri == 'login') {
    require_once '../App/Controllers/LoginController.php';
    $controller = new LoginController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->login();
    } else {
        $controller->index();
    }
} elseif ($uri == 'dashboard') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'institute') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/InstituteController.php';
        $controller = new InstituteController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'department') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/DepartmentsController.php';
        $controller = new DepartmentsController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'programs') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/ProgramController.php';
        $controller = new ProgramController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'building') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'tools') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/ToolsController.php';
        $controller = new ToolsController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'instructor') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/InstructorController.php';
        $controller = new InstructorController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'registration') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/RegistrationController.php';
        $controller = new RegistrationController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'notification') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/NotificationController.php';
        $controller = new NotificationController();
        $controller->index();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'user') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/UserManajementController.php';
        $controller = new UserManajementController();
        $controller->index();
    }
} elseif ($uri == 'logout') {
    session_destroy();
    header('Location: /');
    exit();
} elseif (preg_match('/building\/updateBuilding\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->viewUpdateBuilding();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updateBuilding($id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'building/addBuilding') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->viewAddBuilding();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'building/addBuilding/create') {
    if (isset($_SESSION['user'])) {
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->creteBuilding();
    } else {
        header('Location: /login');
        exit();
    }
} elseif (preg_match('/building\/getBuilding\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    require_once '../App/Controllers/BuildingController.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller = new BuildingController();
        $controller->getBuildingById($id);
    }
} elseif (preg_match('/building\/delete\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    require_once '../App/Controllers/BuildingController.php';
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller = new BuildingController();
        $controller->deleteBuilding($id);
    }
} elseif ($uri == 'notification/addNotification')
{
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/NotificationController.php';
        $controller = new NotificationController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller->createNotification();
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $controller->viewAddNotification();
        }
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif (preg_match('/notification\/delete\/(\d+)/', $uri, $matches))
{
    $id = $matches[1];
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/NotificationController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            $controller = new NotificationController();
            $controller->deleteNotification($id);
        }
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'notification/getNotification')
{
    require_once '../App/Controllers/NotificationController.php';
    $controller = new NotificationController();
    $controller->getAllNotifications();
} elseif ($uri == 'tools/addTool')
{
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/ToolsController.php';
        $controller = new ToolsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller->createTools();
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $controller->viewAddTools();
        }
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif (preg_match('/tools\/updateTools\/(\d+)/', $uri, $matches))
{
    if (isset($_SESSION['user']))
    {
        $id = $matches[1];
        require_once '../App/Controllers/ToolsController.php';
        $controller = new ToolsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller->updateTools($id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $controller->viewUpdateTools();
        }
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif (preg_match('/tools\/delete\/(\d+)/', $uri, $matches))
{
    if (isset($_SESSION['user']))
    {
        $id = $matches[1];
        require_once '../App/Controllers/ToolsController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            $controller = new ToolsController();
            $controller->deleteTools($id);
        }
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'tools/getTools')
{
    require_once '../App/Controllers/ToolsController.php';
    $controller = new ToolsController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $controller = new ToolsController();
        $controller->getAllTools();
    }
} elseif (preg_match('/tools\/getTools\/(\d+)/', $uri, $matches))
{
    $id = $matches[1];
    require_once '../App/Controllers/ToolsController.php';
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $controller = new ToolsController();
        $controller->getToolsByID($id);
    }
} else if ($uri == 'department/addDepartment')
{
    if (isset($_SESSION['user'])){
        require_once '../App/Controllers/DepartmentController.php';
        $controller = new DepartmentsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller->createDepartment();
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $controller->viewAddDepartment();
        }
    } else {
        header('Location: /login');
        exit();
    }
} elseif (preg_match('/department\/updateDepartment\/(\d+)/', $uri, $matches))
{
    if (isset($_SESSION['user']))
    {
        $id = $matches[1];
        require_once '../App/Controllers/DepartmentController.php';
        $controller = new DepartmentsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $controller->updateDepartment($id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $controller->viewUpdateDepartment();
        }
    }
} elseif (preg_match('/department\/delete\/(\d+)/', $uri, $matches))
{
    if (isset($_SESSION['user']))
    {
        $id = $matches[1];
        require_once '../App/Controllers/DepartmentController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            $controller = new DepartmentsController();
            $controller->deleteDepartment($id);
        }
    }
} else if ($uri == 'department/getDepartment')
{
    require_once '../App/Controllers/DepartmentController.php';
    $controller = new DepartmentsController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $controller->getAllDepartments();
    }
} elseif (preg_match('/department\/getDepartment\/(\d+)/', $uri, $matches))
{
    require_once '../App/Controllers/DepartmentController.php';
    $controller = new DepartmentsController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        $id = $matches[1];
        $controller->getDepartmentById($id);
    }
}
