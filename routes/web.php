<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AssinShiftController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiberyMaster;
use App\Http\Controllers\LiberyMasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepotrController;
use App\Http\Controllers\SeatLocationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WritterController;
use App\Http\Controllers\WritterProfileController;
use Illuminate\Support\Facades\Route;

//__ frontent page__//
Route::get('/', [FrontendController::class, 'index'])->name('index');



//__ student Dashboard__//
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//__ student profile__//
Route::middleware('auth')->group(function () {
    Route::get('/student/profile', [StudentController::class, 'student_profile'])->name('student.profile');
    Route::get('/profile/edit', [StudentController::class, 'profile_edit'])->name('profile.edit');
    Route::post('/getusercity', [StudentController::class, 'getusercity']);
    Route::post('/student/profile/update', [StudentController::class, 'student_profile_update'])->name('student.profile.update');
    Route::get('/student/socile', [StudentController::class, 'student_socile'])->name('student.socile');
    Route::post('/student/socile/store', [StudentController::class, 'student_socile_store'])->name('student.socile.store');
    Route::get('/studend/socile/delete/{id}', [StudentController::class, 'studend_socile_delete'])->name('studend.socile.delete');
    Route::get('/student/education', [StudentController::class, 'student_education'])->name('student.education');
    Route::post('/student/education/update', [StudentController::class, 'student_education_update'])->name('student.education.update');
    Route::post('/student/message', [StudentController::class, 'student_message'])->name('student.message');
    Route::post('/student/photo/update', [StudentController::class, 'student_photo_update'])->name('student.photo.update');
    Route::post('/student/message/replay/{id}', [StudentController::class, 'student_message_replay'])->name('student.message.replay');
    Route::get('/student/password', [StudentController::class, 'student_password'])->name('student.password');
    Route::post('/student/password/update', [StudentController::class, 'student_password_update'])->name('student.password.update');
});

//__ Admin login page
Route::get('/admin/login', [AdminController::class, 'admin_login'])->name('admin.login');
Route::post('/admin/logged', [AdminController::class, 'admin_logged'])->name('admin.logged');

//__ Admin dashboard__//
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
});

//__ Admin profile__//
Route::middleware('admin')->group(function () {
    Route::get('/admin/profile', [AdminProfileController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminProfileController::class, 'admin_profile_update'])->name('admin.profile.update');
    Route::get('/admin/password', [AdminProfileController::class, 'admin_password'])->name('admin.password');
    Route::post('/admin/password/update', [AdminProfileController::class, 'admin_password_update'])->name('admin.password.update');
});

//__ Admin student list__//
Route::middleware('admin')->group(function () {
    Route::get('/student/list', [AdminStudentController::class, 'student_list'])->name('student.list');
    Route::get('/admin/student/delete/{id}', [AdminStudentController::class, 'admin_student_delete'])->name('admin.student.delete');
    Route::post('/getstudentcity', [AdminStudentController::class, 'getstudentcity']);
    Route::post('/admin/student/store', [AdminStudentController::class, 'admin_student_store'])->name('admin.student.store');
    Route::post('/getstudentstatus', [AdminStudentController::class, 'getstudentstatus']);
    Route::get('/student/list/active', [AdminStudentController::class, 'student_list_active'])->name('student.list.active');
    Route::post('/admin/student/update/{id}', [AdminStudentController::class, 'admin_student_update'])->name('admin.student.update');
});

//__ Admin Libery Master__//
Route::middleware('admin')->group(function () {
    Route::get('/shift', [LiberyMasterController::class, 'shift'])->name('shift');
    Route::post('/shift/store', [LiberyMasterController::class, 'shift_store'])->name('shift.store');
    Route::get('/seats', [LiberyMasterController::class, 'seats'])->name('seats');
    Route::post('/seat_store', [LiberyMasterController::class, 'seat_store'])->name('seat.store');
    Route::get('/seat/delete/{id}', [LiberyMasterController::class, 'seat_delete'])->name('seat.delete');
    Route::get('/bulk/seat', [LiberyMasterController::class, 'bulk_seat'])->name('bulk.seat');
    Route::post('/seat/bulk/store', [LiberyMasterController::class, 'seat_bulk_store'])->name('seat.bulk.store');
    Route::get('/bulk/seat/delete/{id}', [LiberyMasterController::class, 'bulk_seat_delete'])->name('bulk.seat.delete');
});

//__ Admin all seat location__//
Route::middleware('admin')->group(function () {
    Route::get('/assign.seat', [SeatLocationController::class, 'assign_seat'])->name('assign.seat');
    Route::post('/getshiftamount', [SeatLocationController::class, 'getshiftamount']);
    Route::post('/asign/seat/store', [SeatLocationController::class, 'asign_seat_store'])->name('asign.seat.store');
    Route::get('/assign/all/student', [SeatLocationController::class, 'assign_all_student'])->name('assign.all.student');
    Route::get('/morning/shift/student', [AssinShiftController::class, 'morning_shift_student'])->name('morning.shift.student');
    Route::post('/getassinstatus', [SeatLocationController::class, 'getassinstatus']);
    Route::get('/attendase/student/status', [SeatLocationController::class, 'attendase_student_status'])->name('attendase.student.status');
});

//__ Admin all Expenses__//
Route::middleware('admin')->group(function () {
    Route::get('/expenses/list', [ExpensesController::class, 'expenses_list'])->name('expenses.list');
    Route::post('/expensess/store', [ExpensesController::class, 'expensess_store'])->name('expensess.store');
    Route::get('/expensess/delete/{id}', [ExpensesController::class, 'expensess_delete'])->name('expensess.delete');
});

//__ Report all Expenses__//
Route::middleware('admin')->group(function () {
    Route::get('/report/amount', [RepotrController::class, 'report_amount'])->name('report.amount');
    Route::get('/expensess/delete/{d}', [RepotrController::class, 'expensess_delete'])->name('expensess.delete');
    Route::get('/income/delete/{d}', [RepotrController::class, 'income_delete'])->name('income.delete');
});







































































//__ Admin Writter Authonication__//
Route::get('/writter/list', [WritterController::class, 'writter_list'])->name('writter.list');
Route::post('/writter/store', [WritterController::class, 'writter_store'])->name('writter.store');
Route::get('/writter/login', [WritterController::class, 'writter_login'])->name('writter.login');
Route::post('/writter/logged', [WritterController::class, 'writter_logged'])->name('writter.logged');
Route::get('/writter/logout', [WritterController::class, 'writter_logout'])->name('writter.logout');

//__ Admin student list__//
Route::middleware('writter')->group(function () {
    Route::get('/writter/dashboard', [WritterProfileController::class, 'writter_dashboard'])->name('writter.dashboard');
});

//__ Writter profile list__//
Route::middleware('writter')->group(function () {
    Route::get('/writter/profile', [WritterProfileController::class, 'writter_profile'])->name('writter.profile');
    Route::get('/writter/update', [WritterProfileController::class, 'writter_update'])->name('writter.update');
    Route::post('/writter/profile/update', [WritterProfileController::class, 'writter_profile_update'])->name('writter.profile.update');
    Route::post('/getwrittercity', [WritterProfileController::class, 'getwrittercity'])->name('getwrittercity');
    Route::get('/writter/socile', [WritterProfileController::class, 'writter_socile'])->name('writter.socile');
    Route::post('/writter/socile/store', [WritterProfileController::class, 'writter_socile_store'])->name('writter.socile.store');
    Route::get('/writter/socile/delete/{id}', [WritterProfileController::class, 'writter_socile_delete'])->name('writter.socile.delete');
    Route::get('/writter/wikipedia', [WritterProfileController::class, 'writter_wikipedia'])->name('writter.wikipedia');
    Route::post('/writter/summary/store', [WritterProfileController::class, 'writter_summary_store'])->name('writter.summary.store');
});
