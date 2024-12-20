<?php
require_once '../App/Config/Database.php';
require_once '../App/Helper/ControllerHelper.php';
require_once '../App/Services/ServiceToken.php';
require_once '../App/Middleware/AuthMiddleware.php';

session_start();

$url = parse_url($_SERVER['REQUEST_URI']);
$uri = trim($url['path'], '/');

if (str_starts_with($uri, 'api/v1/public/')) {
    handleApiRequest($uri);
} else if ($uri == '/' || $uri == '') {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        loadController('LandingPageController', 'index');
    }
} else if ($uri == 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('LoginController', 'loginAdmin');
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
elseif ($uri == 'department') { // verifed
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Department
else if ($uri == 'department/add') {
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
else if (preg_match('/department\/update\/(\d+)$/', $uri, $matches)) {
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
elseif (preg_match('/department\/delete\/(\d+)$/', $uri, $matches)) {
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
else if (preg_match('/department\/(\d+)\/data$/', $uri, $matches)) {
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
else if ($uri == 'department/department-name') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'getDepartmentName');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Search Departments
else if ($uri == 'search-departments') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('DepartmentsController', 'searchDepartments');
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
} // Get All Programs data
else if ($uri == 'programs/all') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'getAllPrograms');
        }
    } else {
        header('location: /login');
        exit();
    }
} // ADD Program
else if ($uri == 'programs/add') {
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
else if (preg_match('/programs\/update\/(\d+)$/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ProgramController', 'updatePrograms', $id);
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'viewUpdateProgram', $id);
        }
    } else {
        header('location: /login');
        exit();
    }
} // GET Program By ID for Update
else if (preg_match('/programs\/(\d+)\/data$/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'getProgramsByIdForUpdate', $id);
        }
    } else {
        header('location: /login');
        exit();
    }
} // Delete Programs
else if (preg_match('/programs\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('ProgramController', 'deletePrograms', $id);
        }
    } else {
        header('location: /login');
        exit();
    }
} // Search Programs
else if ($uri == 'search-programs') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProgramController', 'searchPrograms');
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
elseif ($uri == 'building/add') {
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
elseif (preg_match('/building\/update\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'viewUpdateBuilding');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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
elseif (preg_match('/building\/(\d+)\/data$/', $uri, $matches)) {
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
elseif ($uri == 'building/building-name') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'getBuildingName');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET All Building Data
else if ($uri == 'building/all') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'getAllBuilding');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Search Buildings
else if ($uri == 'search-buildings') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('BuildingController', 'searchBuilding');
        }
    } else {
        header('location: /login');
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
elseif ($uri == 'tools/add') {
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
elseif (preg_match('/tools\/update\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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
elseif ($uri == 'tools/all') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'getAllTools');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET Tools By ID
elseif (preg_match('/tools\/(\d+)\/data$/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'getToolsById', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Search Tools
else if ($uri == 'search-tools') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'searchTools');
        }
    } else {
        header('location: /login');
        exit();
    }
} else if ($uri == 'tools/tools-name') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ToolsController', 'getToolsName');
        }
    }
} // Instructor
else if ($uri == 'instructor') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'index');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // ADD Intructor
else if ($uri == 'instructor/add') {
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
else if (preg_match('/instructor\/update\/(\d+)/', $uri, $matches)) {
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
else if (preg_match('/instructor\/delete\/(\d+)/', $uri, $matches)) {
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
else if (preg_match('/instructor\/(\d+)\/data$/', $uri, $matches)) {
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
else if ($uri == 'instructor/all') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'getAllInstructors');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // GET All Instructor Name
else if ($uri == 'instructor/instructor-name') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'getInstructorName');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Search Instructors
else if ($uri == 'search-instructors') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('InstructorController', 'searchInstructors');
        }
    } else {
        header('location: /login');
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
} // Update Status Registration
else if (preg_match('/registration\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            loadController('RegistrationController', 'updateStatusRegistration', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Search Registrations Data
else if ($uri == 'search-registration-data') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('RegistrationController', 'searchRegistrationsData');
        }
    } else {
        header('location: /login');
        exit();
    }
} // GET All Registration Data
else if ($uri == 'registration/all') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('RegistrationController', 'getAllRegistrationsData');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Download Form
else if ($uri == 'registration/download') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('RegistrationController', 'downloadBerkas');
        }
    } else {
        header('location: /login');
        exit();
    }
}
else if (preg_match('/registration\/delete\/(\d+)/', $uri, $matches)) {
    $id = $matches[1];
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('RegistrationController', 'deleteRegistration', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
}// Notification
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
elseif ($uri == 'notification/add') {
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
} // DELETE Notification
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
elseif ($uri == 'notification/all') {
    if (isset($_SESSION['userID'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('NotificationController', 'getAllNotifications');
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Search Notifications
else if ($uri == 'search-notifications') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('NotificationController', 'searchNotifications');
        }
    } else {
        header('location: /login');
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
} // Add Admin
else if ($uri == 'user/admin/add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('UserManagementController', 'createUsers');
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('UserManagementController', 'viewAddAdmin');
    }
} // DELETE Users
else if (preg_match('/user\/(\d+)/', $uri, $matches)) {
    if (isset($_SESSION['userID'])) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            loadController('UserManagementController', 'deleteUsers', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Profile Admin
else if (preg_match('/profile\/admin\/(\d+)/', $uri, $matches)) {
    if ($_SESSION['userID']) {
        $id = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('ProfileController', 'index');
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('ProfileController', 'updateProfile', $id);
        }
    } else {
        header('Location: /login');
        exit();
    }
} // Get Admin Data
else if ($uri == 'user/admin') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'getAdminUsers');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Get Pengguna Data
else if ($uri == 'user/pengguna') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'getPenggunaUsers');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Search Admin
else if ($uri == 'search-admin-users') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'searchAdminUsers');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Search Pengguna
else if ($uri == 'search-pengguna-users') {
    if ($_SESSION['userID']) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            loadController('UserManagementController', 'searchPenggunaUsers');
        }
    } else {
        header('location: /login');
        exit();
    }
} // Request reset password
else if ($uri == 'password-reset/request') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ResetPasswordController', 'index');
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('ResetPasswordController', 'sendOtp');
    }
} // Verify OTP
else if ($uri == 'password-reset/verify') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ResetPasswordController', 'viewOtp');
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('ResetPasswordController', 'verifyOtp');
    }
} // Reset password
else if ($uri == 'password-reset/new') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ResetPasswordController', 'viewResetPassword');
    } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        loadController('ResetPasswordController', 'resetPassword');
    }
} // Resend OTP
else if ($uri == 'password-reset/resend') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        loadController('ResetPasswordController', 'resendOtp');
    }
} // Reset Step Reset Password
else if ($uri == 'password-reset/reset-step') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        loadController('ResetPasswordController', 'resetStep');
    }
} // Logout
elseif ($uri == 'logout') {
    session_unset();
    session_destroy();
    header('Location: /login');
    exit();
} else {
    http_response_code(404);
    exit();
}


function handleApiRequest(string $uri)
{
    $endPoint = str_replace('api/v1/public/', '', $uri);
    // login users
    if ($endPoint == 'auth/login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('LoginController', 'loginUsers');
        }
    } // GET All Institute Data
    else if ($endPoint == 'institutes') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('InstituteController', 'getAllInstitute');
            }
        }
    } // GET All Departments Data
    else if ($endPoint == 'departments') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('DepartmentsController', 'getAllDepartments');
            }
        }
    } // GET All Programs by Department id
    else if (preg_match('/departments\/(\d+)\/programs$/', $endPoint, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('ProgramController', 'getProgramsByDepartment', $matches[1]);
            }
        }
    } // GET All Programs Detail
    else if (preg_match('/programs\/(\d+)$/', $endPoint, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('ProgramController', 'getProgramsDetail', $matches[1]);
            }
        }
    } // GET All Requirements By Programs Id
    else if (preg_match('/programs\/(\d+)\/requirements$/', $endPoint, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('RequirementsController', 'getRequirementsByProgram', $matches[1]);
            }
        }
    } // GET Users Data By id
    else if (preg_match('/users\/(\d+)$/', $uri, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('ProfileController', 'getUsersById', $matches[1]);
            }
        }
    } // Get Programs Favorite
    else if ($endPoint == 'programs/favorite') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('ProgramController', 'getFavoritePrograms');
            }
        }
    } // GET Registration Trafic per Year
    else if ($endPoint == 'registrations/per-year') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('RegistrationController', 'getRegistrationsSummary');
            }
        }
    } // GET Departments with the most programs
    else if ($endPoint == 'departments/most-programs') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('DepartmentsController', 'getMostProgramsInDepartment');
            }
        }
    } // Dashboard Summary
    else if ($endPoint == 'dashboard/summary') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                loadController('DashboardController', 'getSummary');
            }
        }
    } // Registers Users
    else if ($endPoint == 'user/registrations') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            loadController('UserManagementController', 'createUsers');
        }
    } // Update Profile User
    else if (preg_match('/users\/auth\/(\d+)$/', $endPoint, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $matches[1];
                loadController('ProfileController', 'updateProfile', $id);
            }
        }
    } // GET User profile image
    else if (preg_match('/users\/image\/(\d+)$/', $endPoint, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $matches[1];
                loadController('ProfileController', 'getImageById', $id);
            }
        }
    }// Register for Training
    else if ($endPoint == 'user/registrations/training') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                loadController('RegistrationController', 'registrationsPrograms');
            }
        }
    } // PUT is_read notification
    else if ($endPoint == 'notification/is-read') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                loadController('NotificationController', 'updateIsRead');
            }
        }
    } // PUT is_deleted Notification
    else if ($endPoint == 'notification/is-deleted') {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                loadController('NotificationController', 'updateIsDeleted');
            }
        }
    } else if (preg_match('/notification\/(\d+)$/', $uri, $matches)) {
        $token = $_SESSION['token'] ?? null;
        $auth = authenticate($token);
        if (is_array($auth)) {
            echo json_encode($auth);
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                loadController('NotificationController', 'getNotificationByUserId', $matches[1]);
            }
        }
    } else {
        http_response_code(404);
        exit();
    }
}
