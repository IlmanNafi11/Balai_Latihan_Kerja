<?php
$uri = trim($_SERVER['REQUEST_URI'], '/');
if ($uri == '/' || $uri == '' || $uri == 'login')
{
    require_once '../App/Controllers/LoginController.php';
    $controller = new LoginController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $controller->login();
    } else
    {
        $controller->index();
    }
} elseif ($uri == 'dashboard')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'institute')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/InstituteController.php';
        $controller = new InstituteController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'department')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/DepartmentsController.php';
        $controller = new DepartmentsController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'programs')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/ProgramController.php';
        $controller = new ProgramController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'building')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'tools')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/ToolsController.php';
        $controller = new ToolsController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'instructor')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/InstructorController.php';
        $controller = new InstructorController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'registration')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/RegistrationController.php';
        $controller = new RegistrationController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'notification')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/NotificationController.php';
        $controller = new NotificationController();
        $controller->index();
    } else
    {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'user')
{
    session_start();
    if (isset($_SESSION['user']))
    {
        require_once '../App/Controllers/UserManajementController.php';
        $controller = new UserManajementController();
        $controller->index();
    }
} elseif ($uri == 'logout')
{
    session_destroy();
    header('Location: /');
    exit();
} elseif ($uri == 'updateInstitute')
{
    session_start();
} elseif ($uri == 'updateDepartment')
{

} elseif ($uri == 'updateProgram')
{

} elseif ($uri == 'building/updateBuilding')
{
    session_start();
    if(isset($_SESSION['user'])){
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->viewUpdateBuilding();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'updateTools')
{

} elseif ($uri == 'updateInstructor')
{

} elseif ($uri == 'updateNotification')
{

} elseif ($uri == 'updateUser')
{

} elseif ($uri == 'building/addBuilding')
{
    session_start();
    if (isset($_SESSION['user'])){
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->viewAddBuilding();
    } else {
        header('Location: /login');
        exit();
    }
} elseif ($uri == 'instructor/addInstructor')
{

} elseif ($uri == 'department/addDepartment')
{

} elseif ($uri == 'program/addProgram')
{

} elseif ($uri == 'tools/addTools')
{

} elseif ($uri == 'building/addBuilding/create')
{
    session_start();
    if (isset($_SESSION['user'])){
        require_once '../App/Controllers/BuildingController.php';
        $controller = new BuildingController();
        $controller->creteBuilding();
    } else {
        header('Location: /login');
        exit();
    }
}
