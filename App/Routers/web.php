<?php
require_once '../App/Config/Database.php';
require_once '../App/Helper/ControllerHelper.php';
require_once '../App/Services/ServiceToken.php';
require_once '../App/Middleware/AuthMiddleware.php';

session_start();

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (str_starts_with($uri, 'api/v1/public/')) {
    // Tangani permintaan API
    handleApiRequest($uri);
} else {
    // Login
    if ($uri == '/' || $uri == '' || $uri == 'login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('LoginController', 'login');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('LoginController', 'index');
        }
    } // Dashboard
    elseif ($uri == 'dashboard') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('DashboardController', 'index');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // Institute
    elseif ($uri == 'institute') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstituteController', 'index');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // UPDATE Institute
    else if (preg_match('/institute\/updateInstitute\/(\d+)/', $uri, $matches)) {
        if ($_SESSION['userID']) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstituteController', 'viewUpdateInstitute');
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('InstituteController', 'updateInstitute', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET All Institute ID
    else if ($uri == 'institute/getInstituteId') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstituteController', 'getInstituteId');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET All Institute Data
    else if ($uri == 'institute/getInstitute') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstituteController', 'getAllInstitute');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET Institute By ID
    else if (preg_match('/institute\/getInstitute\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $matches[1];
                loadController('InstituteController', 'getInstituteById', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // Department
    elseif ($uri == 'department') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('DepartmentsController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Department
    else if ($uri == 'department/addDepartment') {
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('DepartmentsController', 'updateDepartment', $id);
            } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('DepartmentsController', 'viewUpdateDepartment', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // DELETE Department
    elseif (preg_match('/department\/delete\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                loadController('DepartmentsController', 'deleteDepartment', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET All Departments Data
    else if ($uri == 'department/getDepartment') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('DepartmentsController', 'getAllDepartments');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET Department By ID
    elseif (preg_match('/department\/getDepartment\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $matches[1];
                loadController('DepartmentsController', 'getDepartmentById', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET Department Name
    else if ($uri == 'department/getDepartmentName') {
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('DepartmentsController', 'getDepartmentName');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // Programs
    elseif ($uri == 'programs') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProgramController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Program
    else if ($uri == 'programs/addPrograms') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('ProgramController', 'createPrograms');
            } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProgramController', 'viewAddProgram');
            }
        } else {
            header('location: /login');
            exit();
        }
    } // UPDATE Program
    else if (preg_match('/programs\/updatePrograms\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                loadController('ProgramController', 'updatePrograms', $id);
            } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProgramController', 'viewUpdateProgram', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET Program By ID for Update
    else if (preg_match('/programs\/getProgram\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProgramController', 'getProgramsByIdForUpdate', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } else if (preg_match('/programs\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                loadController('ProgramController', 'deletePrograms', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // Building
    elseif ($uri == 'building') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('BuildingController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Building
    elseif ($uri == 'building/addBuilding') {
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
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
        if ($_SESSION['userID']) {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $id = $matches[1];
                loadController('BuildingController', 'deleteBuilding', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET Building By ID
    elseif (preg_match('/building\/getBuilding\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('BuildingController', 'getBuildingById', $id);
            }
        } else {
            header('location: /login');
            exit();
        }
    } // GET All Building Name
    elseif ($uri == 'building/getBuildingName') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('BuildingController', 'getBuildingName');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // Tools
    elseif ($uri == 'tools') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ToolsController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Tools
    elseif ($uri == 'tools/addTool') {
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ToolsController', 'getAllTools');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET Tools By ID
    elseif (preg_match('/tools\/getTools\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ToolsController', 'getToolsById', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // Instructor
    elseif ($uri == 'instructor') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstructorController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Intructor
    else if ($uri == 'instructor/addInstructor') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('InstructorController', 'createInstructors');
            } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstructorController', 'viewAddInstructor');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // UPDATE Instructor
    else if (preg_match('/instructor\/updateInstructor\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('InstructorController', 'updateInstructors', $id);
            } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstructorController', 'viewUpdateInstructor', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // DELETE Instructor
    else if (preg_match('/instructor\/deleteInstructor\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                loadController('InstructorController', 'deleteInstructors', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET Instructor By ID
    else if (preg_match('/instructor\/getInstructor\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $matches[1];
                loadController('InstructorController', 'getInstructorById', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET All Instructor Data
    else if ($uri == '/instructor/getInstructor') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstructorController', 'getAllInstructors');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET All Instructor Name
    else if ($uri == 'instructor/getInstructorName') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('InstructorController', 'getInstructorName');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // Registration
    elseif ($uri == 'registration') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('RegistrationController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // Notification
    elseif ($uri == 'notification') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('NotificationController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // ADD Notification
    elseif ($uri == 'notification/addNotification') {
        if (isset($_SESSION['userID'])) {
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
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                loadController('NotificationController', 'deleteNotification', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET All Notification Data
    elseif ($uri == 'notification/getNotification') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('NotificationController', 'getAllNotifications');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // User Management
    elseif ($uri == 'user') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('UserManagementController', 'index');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // CREATE Users
    else if ($uri == 'user/create') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('UserManagementController', 'createUsers');
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'viewAddAdmin');
        }
    } // GET All Users
    else if ($uri == 'user/getUsers') {
        if (isset($_SESSION['userID'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('UserManagementController', 'getAllUsers');
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // GET Users By ID
    else if (preg_match('/user\/getUsers\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('UserManagementController', 'getUserById', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // UPDATE Users
    else if (preg_match('/user\/updateUsers\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('UserManagementController', 'updateUsers', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // UPDATE Admin
    else if (preg_match('/user\/updateAdmin\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('UserManagementController', 'updateAdmin', $id);
            }
        }
    } // DELETE Users
    else if (preg_match('/user\/delete\/(\d+)/', $uri, $matches)) {
        if (isset($_SESSION['userID'])) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                loadController('UserManagementController', 'deleteUsers', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } // View and UPDATE Profile
    else if (preg_match('/profile\/(\d+)/', $uri, $matches)) {
        if ($_SESSION['userID']) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProfileController', 'index');
            } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                loadController('ProfileController', 'updateProfile', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } else if (preg_match('/profile\/(\d+)\/images/', $uri, $matches)) {
        if ($_SESSION['userID']) {
            $id = $matches[1];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProfileController', 'getProfileImages', $id);
            }
        } else {
            header('Location: /login');
            exit();
        }
    } else if ($uri == 'password-reset/request') {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ResetPasswordController', 'index');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ResetPasswordController', 'sendOtp');
        }
    } else if ($uri == 'password-reset/verify') {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ResetPasswordController', 'viewOtp');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ResetPasswordController', 'verifyOtp');
        }
    } else if ($uri == 'password-reset/new') {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ResetPasswordController', 'viewResetPassword');
        } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            loadController('ResetPasswordController', 'resetPassword');
        }
    } else if ($uri == 'password-reset/resend'){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ResetPasswordController', 'resendOtp');
        }
    }// Logout
    elseif ($uri == 'logout') {
        session_unset();
        session_destroy();
        header('Location: /');
        exit();
    } else {
        http_response_code(404);
        exit();
    }
}


function handleApiRequest(string $uri)
{
    $endPoint = str_replace('api/v1/public/', '', $uri);
    if ($endPoint == 'dashboards') {

    } // GET All Institute Data
    else if ($endPoint == 'institutes') {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('InstituteController', 'getAllInstitute');
            }
        }
    } // GET All Departments Data
    else if ($endPoint == 'departments') {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('DepartmentsController', 'getAllDepartments');
            }
        }
    } // GET All Programs by Department id
    else if (preg_match('/departments\/(\d+)\/programs$/', $endPoint, $matches)) {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('ProgramController', 'getProgramsByDepartment', $matches[1]);
            }
        }
    } // GET All Programs Detail
    else if (preg_match('/programs\/(\d+)$/', $endPoint, $matches)) {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('ProgramController', 'getProgramsById', $matches[1]);
            }
        }
    } // GET All Requirements By Programs Id
    else if (preg_match('/programs\/(\d+)\/requirements$/', $endPoint, $matches)) {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('RequirementsController', 'getRequirementsByProgram', $matches[1]);
            }
        }
    } // GET All Notifications
    else if ($endPoint == 'notifications') {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('NotificationController', 'getAllNotifications');
            }
        }
    } // GET Users Data By id
    else if (preg_match('/users\/(\d+)$/', $uri, $matches)) {
        if ($users = authenticate()) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProfileController', 'getUsersById', $matches[1]);
            }
        }
    }
}
