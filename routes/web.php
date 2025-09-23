<?php
use App\Http\Controllers\Admin\CustomerAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MarketerController;
use App\Http\Controllers\ReferenceTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerNotesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserPanelController;
use App\Models\UserProduct;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;

Route::resource('leaves', LeaveController::class);
Route::patch('leaves/{leave}/approve', [LeaveController::class,'approve'])->name('leaves.approve');
Route::patch('leaves/{leave}/reject', [LeaveController::class,'reject'])->name('leaves.reject');

Route::get('leaves', [LeaveController::class,'index'])->name('leaves');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
use App\Http\Controllers\Admin\UserBlockController;
Route::middleware(['auth','blocked'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('tasks', TaskController::class);
});
Route::prefix('admin/tasks')->name('admin.tasks.')->group(function(){
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
});

use App\Http\Controllers\UserManagementController;

Route::prefix('admin')->name('admin.')->middleware('role:Admin')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');

    // مدیر
    Route::get('/users/create-manager', [UserManagementController::class, 'createManager'])->name('users.createManager');
    Route::post('/users/store-manager', [UserManagementController::class, 'storeManager'])->name('users.storeManager');
    Route::get('/users/{manager}/edit-manager', [UserManagementController::class, 'editManager'])->name('users.editManager');
    Route::put('/users/{manager}/update-manager', [UserManagementController::class, 'updateManager'])->name('users.updateManager');
    Route::delete('/users/{manager}/delete-manager', [UserManagementController::class, 'destroyManager'])->name('users.destroyManager');

    // کارمند
    Route::get('/users/{manager}/create-employee', [UserManagementController::class, 'createEmployee'])->name('users.createEmployee');
    Route::post('/users/{manager}/store-employee', [UserManagementController::class, 'storeEmployee'])->name('users.storeEmployee');
    Route::get('/users/{employee}/edit-employee', [UserManagementController::class, 'editEmployee'])->name('users.editEmployee');
    Route::put('/users/{employee}/update-employee', [UserManagementController::class, 'updateEmployee'])->name('users.updateEmployee');
    Route::delete('/users/{employee}/delete-employee', [UserManagementController::class, 'destroyEmployee'])->name('users.destroyEmployee');
});


Route::prefix('admin')->name('admin.')->middleware('role:Admin')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');

    Route::get('/users/create-manager', [UserManagementController::class, 'createManager'])->name('users.createManager');
    Route::post('/users/store-manager', [UserManagementController::class, 'storeManager'])->name('users.storeManager');

    Route::get('/users/{manager}/create-employee', [UserManagementController::class, 'createEmployee'])->name('users.createEmployee');
    Route::post('/users/{manager}/store-employee', [UserManagementController::class, 'storeEmployee'])->name('users.storeEmployee');
});
Route::prefix('admin/customers')->name('admin.customers.')->group(function() {
    Route::post('{customer}/notes', [CustomerNotesController::class, 'store'])->name('notes.store');
    Route::patch('notes/{note}', [CustomerNotesController::class, 'update'])->name('notes.update');
    Route::delete('notes/{note}', [CustomerNotesController::class, 'destroy'])->name('notes.destroy');
});


// Marketer
Route::middleware(['role:Marketer'])->group(function(){
    Route::get('tasks/today', [TaskController::class, 'today'])->name('tasks.today');
    Route::patch('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
});
Route::patch('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete')->middleware('role:Marketer');


Route::prefix('admin')->name('admin.')->middleware(['auth','role:Admin'])->group(function () {
    Route::post('users/{user}/block', [UserBlockController::class, 'block'])->name('users.block');
    Route::post('users/{user}/unblock', [UserBlockController::class, 'unblock'])->name('users.unblock');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
});
Route::get('/admin/sync-user-products', [AdminController::class, 'syncUserProducts'])->name('admin.syncUserProducts');
// فرم ویرایش محصول
Route::get('/admin/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');

// آپدیت محصول

use App\Http\Controllers\Admin\ActivityLogController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activityLogs.index');
});
Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity_logs.index');

// ------------------------------
// مسیرهای مربوط به نقش Admin
// ------------------------------
Route::middleware(['auth','role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {

        Route::resource('customers', CustomerController::class);

        Route::resource('marketers', MarketerController::class);

        Route::resource('guests', GuestController::class);

        Route::resource('products', ProductController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('referenceType', ReferenceTypeController::class);


        Route::get('marketers/{marketer}/customers', [CustomerController::class, 'customersOfMarketer'])
            ->name('marketers.customers.index');
//        Route::get('marketers/{marketer}/customers/{customer}/', [CustomerController::class, 'show'])
//            ->name('marketers.customers.show');
        Route::get('marketers/{marketer}/customers/create', [CustomerController::class, 'create'])
            ->name('marketers.customers.create');
        Route::post('marketers/{marketer}/customers', [CustomerController::class, 'store'])
            ->name('marketers.customers.store');
        Route::get('marketers/{marketer}/customers/{customer}/edit', [CustomerController::class, 'edit'])
            ->name('marketers.customers.edit');
        Route::put('marketers/{marketer}/customers/{customer}', [CustomerController::class, 'update'])
            ->name('marketers.customers.update');
        Route::delete('marketers/{marketer}/customers/{customer}', [CustomerController::class, 'destroy'])
            ->name('marketers.customers.destroy');

        Route::get('customers/notes', [CustomerController::class, 'allNotes'])
            ->name('customers.notes');

        Route::get('marketers/{marketer}/customers/{customer}/invoices', [InvoiceController::class, 'indexByMarketer'])
            ->name('marketers.invoices.index');
        Route::get('marketers/{marketer}/customers/{customer}/invoices/create', [InvoiceController::class, 'createForAdmin'])
            ->name('marketers.invoices.create');
        Route::post('marketers/{marketer}/customers/{customer}/invoices', [InvoiceController::class, 'storeForAdmin'])
            ->name('marketers.invoices.store');
        Route::get('marketers/{marketer}/customers/{customer}/invoices/{invoice}', [InvoiceController::class, 'showByAdmin']
        )->name('marketers.invoices.show');
        Route::get('marketers/{marketer}/customers/{customer}/invoices/{invoice}/edit', [InvoiceController::class, 'editByAdmin'])
            ->name('marketers.invoices.edit');
        Route::put('marketers/{marketer}/customers/{customer}/invoices/{invoice}', [InvoiceController::class, 'updateByAdmin'])
            ->name('marketers.invoices.update');
        Route::delete('marketers/{marketer}/customers/{customer}/invoices/{invoice}', [InvoiceController::class, 'destroyByAdmin'])
            ->name('marketers.invoices.destroy');

        Route::get('reports/{user}', [ReportController::class,'index'])
            ->name('reports.index');

        Route::get('reports/create/{user}', [ReportController::class,'create'])
            ->name('reports.create');
        Route::post('reports/{user}', [ReportController::class,'store'])
            ->name('reports.store');

        Route::put('reports/{report}/feedback/{user}', [ReportController::class,'feedback'])
            ->name('reports.feedback');
        Route::get('reports/{report}/show/{user}', [ReportController::class,'show'])
            ->name('reports.show');
        Route::get('reports/{report}/edit/{user}', [ReportController::class,'edit'])
            ->name('reports.edit');
        Route::put('reports/{report}/update/{user}', [ReportController::class,'update'])
            ->name('reports.update');
        Route::post('reports/{report}/destroy/{user}', [ReportController::class,'destroy'])
            ->name('reports.destroy');

        Route::get('marketers/{marketer}/customers/{customer}/notes', [CustomerNotesController::class, 'index'])
            ->name('marketers.customers.notes.index');
        Route::get('marketers/{marketer}/customers/{customer}/notes/create', [CustomerNotesController::class, 'create'])
            ->name('marketers.customers.notes.create');
        Route::post('marketers/{marketer}/customers/{customer}/notes', [CustomerNotesController::class, 'store'])
            ->name('marketers.customers.notes.store');
        Route::get('marketers/{marketer}/customers/{customer}/notes/{note}', [CustomerNotesController::class, 'show']
        )->name('marketers.customers.notes.show');
        Route::get('marketers/{marketer}/customers/{customer}/notes/{note}/edit', [CustomerNotesController::class, 'edit'])
            ->name('marketers.customers.notes.edit');
        Route::put('marketers/{marketer}/customers/{customer}/notes/{note}', [CustomerNotesController::class, 'update'])
            ->name('marketers.customers.notes.update');
        Route::delete('marketers/{marketer}/customers/{customer}/notes/{note}', [CustomerNotesController::class, 'destroy'])
            ->name('marketers.customers.notes.destroy');


            Route::get('commissions', [AdminController::class, 'index'])->name('admin.commissions');
            Route::put('update-sales/{userProduct}', [AdminController::class, 'updateSales'])->name('admin.updateSales');


    });
    Route::get('/admin/commissions', [AdminController::class, 'index'])->name('admin.commissions');

    // آپدیت فروش کاربر برای یک محصول
    Route::put('/admin/update-sales/{userProduct}', [AdminController::class, 'updateSales'])->name('admin.updateSales');
    // ساخت محصول جدید
Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');


// ------------------------------
// مسیرهای مربوط به نقش Marketer
// ------------------------------
Route::middleware(['auth','role:Marketer'])
    ->prefix('marketer')
    ->name('marketer.')
    ->group(function() {
        Route::get('customers', [CustomerController::class,'index'])
            ->name('customers.index');
        Route::get('customers/create', [CustomerController::class,'create'])
            ->name('customers.create');
        Route::post('customers', [CustomerController::class,'store'])
            ->name('customers.store');
        Route::get('customers/{customer}', [CustomerController::class,'show'])
            ->name('customers.show');
        Route::get('customers/{customer}/edit', [CustomerController::class,'edit'])
            ->name('customers.edit');
        Route::put('customers/{customer}', [CustomerController::class,'update'])
            ->name('customers.update');
        Route::delete('customers/{customer}', [CustomerController::class,'destroy'])
            ->name('customers.destroy');

        Route::get('customers/{customer}/invoices', [InvoiceController::class,'index'])
            ->name('invoices.index');
        Route::get('customers/{customer}/invoices/create', [InvoiceController::class,'create'])
            ->name('invoices.create');
        Route::post('customers/{customer}/invoices', [InvoiceController::class,'store'])
            ->name('invoices.store');
        Route::get('customers/{customer}/invoices/{invoice}', [InvoiceController::class,'show'])
            ->name('invoices.show');
        Route::get('customers/{customer}/invoices/{invoice}/edit', [InvoiceController::class,'edit'])
            ->name('invoices.edit');
        Route::put('customers/{customer}/invoices/{invoice}', [InvoiceController::class,'update'])
            ->name('invoices.update');
        Route::delete('customers/{customer}/invoices/{invoice}', [InvoiceController::class,'destroy'])
            ->name('invoices.destroy');


        Route::get('reports/create', [ReportController::class, 'create'])
            ->name('reports.create');
        Route::get('reports/show/{report}', [ReportController::class, 'show'])
            ->name('reports.show');
        Route::get('reports/{report}/edit', [ReportController::class, 'edit'])
            ->name('reports.edit');
        Route::get('reports/{report}/submit', [ReportController::class, 'submit'])
            ->name('reports.submit');
        Route::get('reports', [ReportController::class, 'index'])
            ->name('reports.index');
        Route::post('reports', [ReportController::class, 'store'])
            ->name('reports.store');
        Route::put('reports/{report}', [ReportController::class, 'update'])
            ->name('reports.update');
        Route::post('reports/{report}/destroy', [ReportController::class, 'destroy'])
            ->name('reports.destroy');


        Route::get('customers/{customer}/notes', [CustomerNotesController::class, 'index'])
            ->name('customer.notes.index');
        Route::get('customers/{customer}/notes/create', [CustomerNotesController::class, 'create'])
            ->name('customer.notes.create');
        Route::post('customers/{customer}/notes', [CustomerNotesController::class, 'store'])
            ->name('customer.notes.store');
        Route::get('customers/{customer}/notes/{note}', [CustomerNotesController::class, 'show']
        )->name('customer.notes.show');
        Route::get('customers/{customer}/notes/{note}/edit', [CustomerNotesController::class, 'edit'])
            ->name('customer.notes.edit');
        Route::put('customers/{customer}/notes/{note}', [CustomerNotesController::class, 'update'])
            ->name('customer.notes.update');
        Route::delete('customers/{customer}/notes/{note}', [CustomerNotesController::class, 'destroy'])
            ->name('customer.notes.destroy');

            Route::get('sales', [UserPanelController::class, 'index'])
            ->name('sales.index');


    });

// ------------------------------
// مسیرهای مربوط به نقش Guest
// ------------------------------
Route::middleware(['auth','role:User'])
    ->prefix('user')
    ->name('user.')
    ->group(function() {
        Route::get('reports/{report}/submit', [ReportController::class, 'submit'])
            ->name('reports.submit');
        Route::get('reports/create', [ReportController::class,'create'])
            ->name('reports.create');
        Route::post('reports', [ReportController::class,'store'])
            ->name('reports.store');
        Route::get('reports', [ReportController::class,'index'])
            ->name('reports.index');
        Route::get('reports/show/{report}', [ReportController::class,'show'])
            ->name('reports.show');
        Route::get('reports/{report}/edit', [ReportController::class,'edit'])
            ->name('reports.edit');
        Route::put('reports/{report}', [ReportController::class,'update'])
            ->name('reports.update');
        Route::post('reports/{report}/destroy', [ReportController::class,'destroy'])
            ->name('reports.destroy');
    });

require __DIR__.'/auth.php';
Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update2');

Route::prefix('admin')->group(function() {
    Route::get('/panel', [AdminController::class, 'index'])->name('admin.products.index');
    Route::put('/user-products/{userProduct}', [AdminController::class, 'updateSales'])->name('admin.updateSales');
 Route::get('/products', [AdminController::class, 'products'])->name('admin.products.products');
 //Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update2');
});

Route::prefix('admin')->group(function() {
    Route::get('/customersedit/{customer}', [CustomerAdminController::class, 'edit'])
    ->name('admin.customersedit.edit');
    Route::get('/customersCreate', [CustomerAdminController::class, 'create'])
    ->name('admin.customersCreate.create');
    Route::post('/customersCreate', [CustomerAdminController::class, 'store'])
    ->name('admin.customersCreate.store');
Route::put('/customersupdate/{customer}', [CustomerAdminController::class, 'update'])
    ->name('admin.customersupdate.update');
    Route::get('/customersdelete/{customer}', [CustomerAdminController::class, 'destroy'])
    ->name('admin.customersdelete.destroy');
    Route::delete('customersdelete/{customer}', [CustomerAdminController::class, 'destroy'])
    ->name('admin.customersdelete.destroy');


});
// پنل کاربر
Route::middleware('auth')->group(function() {
    Route::get('/user/panel', [UserPanelController::class, 'index'])->name('user.panel');
});
Route::prefix('admin')->name('admin.')->middleware(['auth','role:Admin'])->group(function () {
    Route::resource('customersAdmin', \App\Http\Controllers\Admin\CustomerAdminController::class);
});


