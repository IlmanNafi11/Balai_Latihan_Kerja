<?php
require_once '../App/Config/Database.php';
require_once '../App/Helper/ControllerHelper.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
session_start();
// Login
if ($uri == '/' || $uri == '' || $uri == 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('LoginController', 'login');
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('LoginController', 'index');
    }
} // Dashboard
elseif ($uri == 'dashboard') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DashboardController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Institute
elseif ($uri == 'institute') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstituteController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // UPDATE Institute
else if (preg_match('/institute\/updateInstitute\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstituteController', 'viewUpdateInstitute');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('InstituteController', 'updateInstitute', $id);
        }
    }
} // GET All Institute ID
else if ($uri == 'institute/getInstituteId') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('InstituteController', 'getInstituteId');
    }
} // GET All Institute Data
else if ($uri == 'institute/getInstitute') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('InstituteController', 'getAllInstitute');
    }
} // GET Institute By ID
else if (preg_match('/institute\/getInstitute\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $matches[1];
            loadController('InstituteController', 'getInstituteById', $id);
        }
    }
} // Department
elseif ($uri == 'department') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Department
else if ($uri == 'department/addDepartment') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('DepartmentsController', 'createDepartment');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'viewAddDepartment');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // UPDATE Department
elseif (preg_match('/department\/updateDepartment\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('DepartmentsController', 'updateDepartment', $id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'viewUpdateDepartment', $id);
        }
    }
} // DELETE Department
elseif (preg_match('/department\/delete\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('DepartmentsController', 'deleteDepartment', $id);
        }
    }
} // GET All Departments Data
else if ($uri == 'department/getDepartment') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('DepartmentsController', 'getAllDepartments');
    }
} // GET Department By ID
elseif (preg_match('/department\/getDepartment\/(\d+)/', $uri, $matches)) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $matches[1];
        loadController('DepartmentsController', 'getDepartmentById', $id);
    }
} // GET Department Name
else if ($uri == 'department/getDepartmentName') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('DepartmentsController', 'getDepartmentName');
    }
} // Programs
elseif ($uri == 'programs') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Program
else if ($uri == 'programs/addPrograms') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'viewAddProgram');
        }
    }
} // UPDATE Program
else if (preg_match('/programs\/updatePrograms\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'viewUpdateProgram', $id);
        }
    }
} // GET Program By ID
else if (preg_match('/programs\/getProgram\/(\d+)/', $uri, $matches)) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $matches[1];
        loadController('ProgramController', 'getProgramById', $id);
    }
} // Building
elseif ($uri == 'building') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Building
elseif ($uri == 'building/addBuilding') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'viewAddBuilding');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('BuildingController', 'creteBuilding');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // UPDATE Building
elseif (preg_match('/building\/updateBuilding\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'viewUpdateBuilding');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('BuildingController', 'updateBuilding', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // DELETE Building
elseif (preg_match('/building\/delete\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SESSION['user']) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('BuildingController', 'deleteBuilding', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET Building By ID
elseif (preg_match('/building\/getBuilding\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('BuildingController', 'getBuildingById', $id);
    }
} // GET All Building Name
elseif ($uri == 'building/getBuildingName') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'getBuildingName');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Tools
elseif ($uri == 'tools') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Tools
elseif ($uri == 'tools/addTool') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ToolsController', 'createTools');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'viewAddTools');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // UPDATE Tools
elseif (preg_match('/tools\/updateTools\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ToolsController', 'updateTools', $id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'viewUpdateTools', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // DELETE Tools
elseif (preg_match('/tools\/delete\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('ToolsController', 'deleteTools', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET All Tools Data
elseif ($uri == 'tools/getTools') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ToolsController', 'getAllTools');
    }
} // GET Tools By ID
elseif (preg_match('/tools\/getTools\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ToolsController', 'getToolsById', $id);
    }
} // Instructor
elseif ($uri == 'instructor') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Intructor
else if ($uri == 'instructor/addInstructor') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('InstructorController', 'createInstructors');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'viewAddInstructor');
        }
    }
} // UPDATE Instructor
else if (preg_match('/instructor\/updateInstructor\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('InstructorController', 'updateInstructors', $id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'viewUpdateInstructor', $id);
        }
    }
} // DELETE Instructor
else if (preg_match('/instructor\/deleteInstructor\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['user'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('InstructorController', 'deleteInstructors', $id);
        }
    }
} // GET Instructor By ID
else if (preg_match('/instructor\/getInstructor\/(\d+)/', $uri, $matches)) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $matches[1];
        loadController('InstructorController', 'getInstructorById', $id);
    }
} // GET All Instructor Data
else if ($uri == '/instructor/getInstructor') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('InstructorController', 'getAllInstructors');
    }
} // GET All Instructor Name
else if ($uri == 'instructor/getInstructorName') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('InstructorController', 'getInstructorName');
    }
} // Registration
elseif ($uri == 'registration') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('RegistrationController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Notification
elseif ($uri == 'notification') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('NotificationController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Notification
elseif ($uri == 'notification/addNotification') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('NotificationController', 'createNotification');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('NotificationController', 'viewAddNotification');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // UPDATE Notification
elseif (preg_match('/notification\/delete\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('NotificationController', 'deleteNotification', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET All Notification Data
elseif ($uri == 'notification/getNotification') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('NotificationController', 'getAllNotifications');
    }
} // User Management
elseif ($uri == 'user') {
    if (isset($_SESSION['user'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // CREATE Users
else if ($uri == 'user/create'){
    if (isset($_SESSION['user'])){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            loadController('UserManagementController', 'createUsers');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            loadController('UserManagementController', 'viewAddAdmin');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET All Users
else if ($uri == 'user/getUsers') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('UserManagementController', 'getAllUsers');
    }
} // GET Users By ID
else if (preg_match('/user\/getUsers\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        loadController('UserManagementController', 'getUserById', $id);
    }
} // UPDATE Users
else if (preg_match('/user\/updateUsers\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('UserManagementController', 'updateUsers', $id);
    }
} // UPDATE Admin
else if (preg_match('/user\/updateAdmin\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        loadController('UserManagementController', 'updateAdmin', $id);
    }
} // DELETE Users
else if (preg_match('/user\/delete\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        loadController('UserManagementController', 'deleteUsers', $id);
    }
} // Logout
elseif ($uri == 'logout') {
    session_destroy();
    header('Location: /');
    exit();
}
