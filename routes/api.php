<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TrainingSetupController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\AcrController;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\FreedomFighterController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\IdCardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SeniorEmployeeController;
use App\Http\Controllers\TransferTypeController;


Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/logout', 'logout');
    Route::post('auth/refresh', 'refresh');
    Route::post('auth/otpVerify', 'otpVerify');
});



Route::get('employeeList', [DropdownController::class, 'employeeList']);


Route::group(['prefix' => ''], function () {

    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('users/search', [UserController::class, 'search']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::get('users/{id}', [UserController::class, 'userDetail']);
    Route::put('users/{id}', [UserController::class, 'updateUser']);
    Route::delete('users/{id}', [UserController::class, 'deleteUser']);
    Route::patch('activeUser/{id}', [UserController::class, 'activeUser']);
    Route::patch('inactiveUser/{id}', [UserController::class, 'inactiveUser']);

});

//User Employee Information v1

Route::get('/getEmployeesList', [EmployeeController::class, 'getEmployeesList']);
Route::get('/user/getprofile/{id}', [EmployeeController::class, 'getprofile']);
Route::get('/user/getEmployeeById/{id}', [EmployeeController::class, 'getEmployeeById']);
Route::post('/user/addProfile', [EmployeeController::class, 'addProfile']);
Route::post('/user/updateProfile', [EmployeeController::class, 'updateProfile']);
Route::post('/user/deleteEmployee/{empid}/{userid}', [EmployeeController::class, 'deleteEmployee']);
Route::get('/user/activeEmployeeType/{id}', [EmployeeController::class, 'activeEmployeeType']);
Route::get('/user/inactiveEmployeeType/{id}', [EmployeeController::class, 'inactiveEmployeeType']);
Route::post('/user/fileUpload/', [EmployeeController::class, 'fileUpload']);


//User Transfer Information v1

Route::get('/getTransferList', [TransferController::class, 'getTransferList']);
Route::post('/addTransferRecord', [TransferController::class, 'addTransferRecord']);

Route::post('/updateTransferRecord/{id}', [TransferController::class, 'updateTransferRecord']);
Route::delete('/deleteTransferRecord/{id}', [TransferController::class, 'deleteTransferRecord']);
Route::patch('/activeTransferRecord/{id}', [TransferController::class, 'activeTransferRecord']);
Route::patch('/inactiveTransferRecord/{id}', [TransferController::class, 'inactiveTransferRecord']);
Route::get('/specificUserTransferRecord/{id}', [TransferController::class, 'specificUserTransferRecord']);
Route::get('/specificUserTransferRecordByEmployeeId/{employee_id}', [TransferController::class, 'specificUserTransferRecordByEmployeeId']);

//Transfer Type 

Route::get('/transferType', [TransferTypeController::class, 'transferType']);
Route::post('/addTransferType', [TransferTypeController::class, 'addTransferType']);
Route::post('/updateTransferType/{id}', [TransferTypeController::class, 'updateTransferType']);
Route::delete('/deleteTransferType/{id}', [TransferTypeController::class, 'deleteTransferType']);
Route::patch('/activeTransferType/{id}', [TransferTypeController::class, 'activeTransferType']);
Route::patch('/inactiveTransferTypeRecord/{id}', [TransferTypeController::class, 'inactiveTransferTypeRecord']);
Route::get('/specificTransferType/{id}', [TransferTypeController::class, 'specificTransferType']);

//User Training Information v1

Route::get('/getTrainingList', [TrainingController::class, 'getTrainingList']);
Route::post('/addTrainingRecord', [TrainingController::class, 'addTrainingRecord']);
Route::post('/updateTrainingRecord/{id}', [TrainingController::class, 'updateTrainingRecord']);
Route::delete('/deleteTrainingRecord/{id}', [TrainingController::class, 'deleteTrainingRecord']);
Route::patch('/activeTrainingRecord/{id}', [TrainingController::class, 'activeTrainingRecord']);
Route::patch('/inactiveTrainingRecord/{id}', [TrainingController::class, 'inactiveTrainingRecord']);
Route::get('/specificUserTraining/{id}', [TrainingController::class, 'specificUserTraining']);
Route::get('/specificUserTrainingRecordByEmployeeId/{employee_id}', [TrainingController::class, 'specificUserTrainingRecordByEmployeeId']);

//User Promotion Information v1

Route::get('/getPromotion', [PromotionController::class, 'getPromotion']);
Route::post('/addPromotion', [PromotionController::class, 'addPromotion']);
Route::post('/updatePromotion/{id}', [PromotionController::class, 'updatePromotion']);
Route::delete('/deletePromotion/{id}', [PromotionController::class, 'deletePromotion']);
Route::patch('/activePromotionRecord/{id}', [PromotionController::class, 'activePromotionRecord']);
Route::patch('/inactivePromotionRecord/{id}', [PromotionController::class, 'inactivePromotionRecord']);
Route::get('/specificUserPromotion/{id}', [PromotionController::class, 'specificUserPromotion']);
Route::get('/specificUserPromotionRecordByEmployeeId/{employee_id}', [PromotionController::class, 'specificUserPromotionRecordByEmployeeId']);



//Training Setup v1

Route::get('/getTrainingMgt', [TrainingSetupController::class, 'getTrainingMgt']);
Route::post('/addTrainingMgt', [TrainingSetupController::class, 'addTrainingMgt']);
Route::put('/updateTrainingMgt/{id}', [TrainingSetupController::class, 'updateTrainingMgt']);
Route::delete('/deleteTrainingMgt/{id}', [TrainingSetupController::class, 'deleteTrainingMgt']);
Route::patch('/activeTrainingMgtRecord/{id}', [TrainingSetupController::class, 'activeTrainingMgtRecord']);
Route::patch('/inactiveTrainingMgtRecord/{id}', [TrainingSetupController::class, 'inactiveTrainingMgtRecord']);
Route::get('/specificTrainingSetup/{id}', [TrainingSetupController::class, 'specificTrainingSetup']);

//Office Setup v1

Route::get('/getOfficeMgt', [OfficeController::class, 'getOfficeMgt']);
Route::post('/addOfficeMgt', [OfficeController::class, 'addOfficeMgt']);
Route::put('/updateOfficeMgt/{id}', [OfficeController::class, 'updateOfficeMgt']);
Route::delete('/deleteOfficeMgt/{id}', [OfficeController::class, 'deleteOfficeMgt']);
Route::patch('/activeOfficeMgtRecord/{id}', [OfficeController::class, 'activeOfficeMgtRecord']);
Route::patch('/inactiveOfficeMgtRecord/{id}', [OfficeController::class, 'inactiveOfficeMgtRecord']);
Route::get('/specificOfficeSetup/{id}', [OfficeController::class, 'specificOfficeSetup']);

//Grade Setup

Route::get('/getGradeMgt', [GradeController::class, 'getGradeMgt']);
Route::post('/addGradeMgt', [GradeController::class, 'addGradeMgt']);
Route::put('/updateGradeMgt/{id}', [GradeController::class, 'updateGradeMgt']);
Route::delete('/deleteGradeMgt/{id}', [GradeController::class, 'deleteGradeMgt']);
Route::patch('/activeGradeMgtRecord/{id}', [GradeController::class, 'activeGradeMgtRecord']);
Route::patch('/inactiveGradeMgtRecord/{id}', [GradeController::class, 'inactiveGradeMgtRecord']);
Route::get('/specificGradeSetup/{id}', [GradeController::class, 'specificGradeSetup']);

//Admin Setup Department v1

Route::get('/getDepartment', [DepartmentController::class, 'getDepartment']);
Route::post('/addDepartment', [DepartmentController::class, 'addDepartment']);
Route::put('/updateDepartment/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('/deleteDepartment/{id}', [DepartmentController::class, 'deleteDepartment']);
Route::patch('/activeDeptRecord/{id}', [DepartmentController::class, 'activeDeptRecord']);
Route::patch('/inactiveDeptRecord/{id}', [DepartmentController::class, 'inactiveDeptRecord']);
Route::get('/specificDeptSetup/{id}', [DepartmentController::class, 'specificDeptSetup']);

//Designation Setup v1

Route::get('/getDesignationMgt', [DesignationController::class, 'getDesignationMgt']);

Route::post('/addDesignationMgt', [DesignationController::class, 'addDesignationMgt']);
Route::put('/updateDesignationMgt/{id}', [DesignationController::class, 'updateDesignationMgt']);
Route::delete('/deleteDesignationMgt/{id}', [DesignationController::class, 'deleteDesignationMgt']);
Route::patch('/activeDesignationMgtRecord/{id}', [DesignationController::class, 'activeDesignationMgtRecord']);
Route::patch('/inactiveDesignationMgtRecord/{id}', [DesignationController::class, 'inactiveDesignationMgtRecord']);
Route::get('/specificDesigSetup/{id}', [DesignationController::class, 'specificDesigSetup']);

//Leave management v1

Route::get('/getLeaveMgt', [LeaveController::class, 'getLeaveMgt']);
Route::get('/getLeaveByEmployeeId/{employee_id}', [LeaveController::class, 'getLeaveByEmployeeId']);
Route::post('/addLeaveMgt', [LeaveController::class, 'addLeaveMgt']);
Route::post('/updateLeaveMgt/{id}', [LeaveController::class, 'updateLeaveMgt']);
Route::delete('/deleteLeaveMgt/{id}', [LeaveController::class, 'deleteLeaveMgt']);
Route::patch('/activeLeaveMgtRecord/{id}', [LeaveController::class, 'activeLeaveMgtRecord']);
Route::patch('/inactiveLeaveMgtRecord/{id}', [LeaveController::class, 'inactiveLeaveMgtRecord']);
Route::get('/specificUserLeaveRecordByEmployeeId/{employee_id}', [LeaveController::class, 'specificUserLeaveRecordByEmployeeId']);
Route::get('/specificUserLeave/{id}', [LeaveController::class, 'specificUserLeave']);

//Leave Type Setup v1

Route::get('/getLeaveType', [LeaveTypeController::class, 'getLeaveType']);
Route::post('/addLeaveType', [LeaveTypeController::class, 'addLeaveType']);
Route::put('/updateLeaveType/{id}', [LeaveTypeController::class, 'updateLeaveType']);
Route::delete('/deleteLeaveType/{id}', [LeaveTypeController::class, 'deleteLeaveType']);
Route::patch('/activeLeaveTypeRecord/{id}', [LeaveTypeController::class, 'activeLeaveTypeRecord']);
Route::patch('/inactiveLeaveTypeRecord/{id}', [LeaveTypeController::class, 'inactiveLeaveTypeRecord']);
Route::get('/specificLeaveType/{id}', [LeaveTypeController::class, 'specificLeaveType']);

//Annual Confidential Report v1

Route::get('/getAcr', [AcrController::class, 'getAcr']);
Route::post('/addacr', [AcrController::class, 'addacr']);
Route::post('/updateAcrMgt/{id}', [AcrController::class, 'updateAcrMgt']);
Route::get('/specificAcrInfo/{id}', [AcrController::class, 'specificAcrInfo']);
Route::get('/getprofileForAcr/{id}', [AcrController::class, 'getprofileForAcr']);
Route::get('/getAcrListByEmployeeId/{id}', [AcrController::class, 'getAcrListByEmployeeId']);
Route::delete('/deleteAcrInfo/{id}', [AcrController::class, 'deleteAcrInfo']);
Route::patch('/activeAcrRecord/{id}', [AcrController::class, 'activeAcrRecord']);
Route::patch('/inactiveAcrRecord/{id}', [AcrController::class, 'inactiveAcrRecord']);



// Mail Controller

Route::post('/send-reply', [MailController::class, 'sendReply']);



//PDS Report

Route::get('/getShortReport', [ReportController::class, 'getShortReport']);
Route::get('/getLongReport/{employee_id}', [ReportController::class, 'getLongReport']);

//ID Card

Route::get('/getIdCard/{id}', [IdCardController::class, 'getIdCard']);

//Salary 

Route::get('/getSalary', [SalaryController::class, 'getSalary']);
Route::get('/getSalaryByEmployeeId/{employee_id}', [SalaryController::class, 'getSalaryByEmployeeId']);
Route::post('/addSalary', [SalaryController::class, 'addSalary']);
Route::put('/updateSalary/{id}', [SalaryController::class, 'updateSalary']);
Route::delete('/deleteSalary/{id}', [SalaryController::class, 'deleteSalary']);
Route::patch('/activeSalaryRecord/{id}', [SalaryController::class, 'activeSalaryRecord']);
Route::patch('/inactiveSalaryRecord/{id}', [SalaryController::class, 'inactiveSalaryRecord']);

//Blood Group 

Route::get('/getBloodGroup', [BloodGroupController::class, 'getBloodGroup']);
Route::get('/getBloodGroupByEmployeeId/{employee_id}', [BloodGroupController::class, 'getBloodGroupByEmployeeId']);
Route::post('/addBloodGroup', [BloodGroupController::class, 'addBloodGroup']);
Route::put('/updateBloodGroup/{id}', [BloodGroupController::class, 'updateBloodGroup']);
Route::delete('/deleteBloodGroup/{id}', [BloodGroupController::class, 'deleteBloodGroup']);
Route::patch('/activeBloodGroupRecord/{id}', [BloodGroupController::class, 'activeBloodGroupRecord']);
Route::patch('/inactiveBloodGroupRecord/{id}', [BloodGroupController::class, 'inactiveBloodGroupRecord']);
Route::get('/specificBloodGroupbyEmployee/{id}', [BloodGroupController::class, 'specificBloodGroupbyEmployee']);

//Senior Employee 
Route::get('/getSeniorEmployee', [SeniorEmployeeController::class, 'getSeniorEmployee']);
Route::get('/getSeniorEmployeeById/{id}', [SeniorEmployeeController::class, 'getSeniorEmployeeById']);


// Freedom Fighter

Route::get('/getFreedomFighter', [FreedomFighterController::class, 'getFreedomFighter']);
Route::get('/getFreedomFighterByEmpId/{id}', [FreedomFighterController::class, 'getFreedomFighterByEmpId']);
Route::post('/addFreedomFighter', [FreedomFighterController::class, 'addFreedomFighter']);
Route::put('/updateFreedomFighter/{id}', [FreedomFighterController::class, 'updateFreedomFighter']);
Route::delete('/deleteFreedomFighter/{id}', [FreedomFighterController::class, 'deleteFreedomFighter']);

// Message 

Route::post('/sendMessage', [MessageController::class, 'sendMessage']);
Route::get('/getMessageInfoById/{id}', [MessageController::class, 'getMessageInfoById']);
Route::get('/getOfficeListAndPhoneNumberByDepartment/{id}', [MessageController::class, 'getOfficeListAndPhoneNumberByDepartment']);
Route::get('/getPhoneNumberByOffice/{designationId}/{officeId}', [MessageController::class, 'getPhoneNumberByOffice']);
Route::get('/getPhoneNumberById/{id}', [MessageController::class, 'getPhoneNumberById']);
Route::get('/getMessageInfo', [MessageController::class, 'getMessageInfo']);
