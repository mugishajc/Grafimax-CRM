<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/register/{lang?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/login/{lang?}', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/password/reset/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');

//Route::post('searchJson', 'ProjectsController@getSearchJson')->name('search.json')->middleware(['auth','xss']);
Route::get('searchJson/{search?}', 'ProjectsController@getSearchJson')->name('search.json')->middleware(['auth','xss',]);

Route::get('/', 'DashboardController@index')->name('dashboard')->middleware(['auth','xss',]);



Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware(['auth','xss',]);
Route::get('profile', 'UserController@profile')->name('profile')->middleware(['auth','xss',]);
Route::put('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(['auth','xss',]);

Route::resource('users', 'UserController')->middleware(['auth','xss',]);
Route::put('change-password', 'UserController@updatePassword')->name('update.password');

Route::resource('clients', 'ClientController')->middleware(['auth','xss',]);
Route::resource('roles', 'RoleController')->middleware(['auth','xss',]);
Route::resource('permissions', 'PermissionController')->middleware(['auth','xss',]);

Route::group(['middleware' => ['auth','xss',],    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('systems', 'SystemController');
    Route::post('email-settings', 'SystemController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings', 'SystemController@saveCompanySettings')->name('company.settings');
    Route::post('stripe-settings', 'SystemController@saveStripeSettings')->name('stripe.settings');
    Route::post('system-settings', 'SystemController@saveSystemSettings')->name('system.settings');
    Route::get('company-setting', 'SystemController@companyIndex')->name('company.setting');
});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('leadstages', 'LeadstagesController');
    Route::post('/leadstages/order', ['as' => 'leadstages.order','uses' => 'LeadstagesController@order',]);
});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('projectstages', 'ProjectstagesController');
    Route::post('/projectstages/order', ['as' => 'projectstages.order','uses' => 'ProjectstagesController@order',]);
});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('leadsources', 'LeadsourceController');
});

Route::resource('labels', 'LabelsController')->middleware(['auth','xss',]);
Route::resource('productunits', 'ProductunitsController')->middleware(['auth','xss',]);
Route::resource('expensescategory', 'ExpensesCategoryController')->middleware(['auth','xss',]);
Route::post('/leads/order', ['as' => 'leads.order','uses' => 'LeadsController@order',])->middleware(['auth','xss',]);
Route::resource('leads', 'LeadsController')->middleware(['auth','xss',]);

Route::get('/jobcard', 'ProjectsController@additem')->name('jobcard')->middleware(['auth','xss',]);


Route::group(['middleware' => ['auth','xss',],], function (){
    Route::put('projects/{id}/status', 'ProjectsController@updateStatus')->name('projects.update.status');
    Route::resource('projects', 'ProjectsController');
    Route::get('project-invite/{project_id}', 'ProjectsController@userInvite')->name('project.invite');
    Route::post('invite/{project}', 'ProjectsController@Invite')->name('invite');

    Route::get('projects/{id}/milestone', 'ProjectsController@milestone')->name('project.milestone');
    Route::post('projects/{id}/milestone', 'ProjectsController@milestoneStore')->name('project.milestone.store');
    Route::get('projects/milestone/{id}/edit', 'ProjectsController@milestoneEdit')->name('project.milestone.edit');
    Route::put('projects/milestone/{id}', 'ProjectsController@milestoneUpdate')->name('project.milestone.update');
    Route::delete('projects/milestone/{id}', 'ProjectsController@milestoneDestroy')->name('project.milestone.destroy');
    Route::get('projects/milestone/{id}/show', 'ProjectsController@milestoneShow')->name('project.milestone.show');

    Route::post('projects/{id}/file', 'ProjectsController@fileUpload')->name('project.file.upload');
    Route::get('projects/{id}/file/{fid}', 'ProjectsController@fileDownload')->name('projects.file.download');
    Route::delete('projects/{id}/file/delete/{fid}', 'ProjectsController@fileDelete')->name('projects.file.delete');

    Route::get('projects/{id}/taskboard', 'ProjectsController@taskBoard')->name('project.taskboard');
    Route::get('projects/{id}/taskboard/create', 'ProjectsController@taskCreate')->name('task.create');
    Route::post('projects/{id}/taskboard/store', 'ProjectsController@taskStore')->name('task.store');
    Route::get('projects/taskboard/{id}/edit', 'ProjectsController@taskEdit')->name('task.edit');
    Route::put('projects/taskboard/{id}/update', 'ProjectsController@taskUpdate')->name('task.update');
    Route::delete('projects/taskboard/{id}/delete', 'ProjectsController@taskDestroy')->name('task.destroy');
    Route::get('projects/taskboard/{id}/show', 'ProjectsController@taskShow')->name('task.show');
    Route::post('projects/order', 'ProjectsController@order')->name('taskboard.order');

    Route::post('projects/{id}/taskboard/{tid}/comment', 'ProjectsController@commentStore')->name('comment.store');
    Route::post('projects/taskboard/{id}/file', 'ProjectsController@commentStoreFile')->name('comment.file.store');
    Route::delete('projects/taskboard/comment/{id}', 'ProjectsController@commentDestroy')->name('comment.destroy');
    Route::delete('projects/taskboard/file/{id}', 'ProjectsController@commentDestroyFile')->name('comment.file.destroy');

    Route::post('projects/taskboard/{id}/checklist/store', 'ProjectsController@checkListStore')->name('task.checklist.store');
    Route::put('projects/taskboard/{id}/checklist/{cid}/update', 'ProjectsController@checklistUpdate')->name('task.checklist.update');
    Route::delete('projects/taskboard/{id}/checklist/{cid}', 'ProjectsController@checklistDestroy')->name('task.checklist.destroy');

    Route::get('projects/{id}/client/{cid}/permission', 'ProjectsController@clientPermission')->name('client.permission');
    Route::put('projects/{id}/client/{cid}/permission', 'ProjectsController@storeClientPermission')->name('client.store.permission');

    Route::get('projects/{id}/timesheet', 'ProjectsController@timeSheet')->name('task.timesheetRecord');
    Route::get('projects/{id}/timesheet/create', 'ProjectsController@timeSheetCreate')->name('task.timesheet');
    Route::post('projects/{id}/timesheet/create', 'ProjectsController@timeSheetStore')->name('task.timesheet.store');
    Route::get('projects/{id}/timesheet/{tid}/edit', 'ProjectsController@timeSheetEdit')->name('task.timesheet.edit');
    Route::put('projects/{id}/timesheet/{tid}/update', 'ProjectsController@timeSheetUpdate')->name('task.timesheet.update');
    Route::delete('projects/{id}/timesheet/{tid}/destroy', 'ProjectsController@timeSheetDestroy')->name('task.timesheet.destroy');

    Route::post('projects/bug/kanban/order', 'ProjectsController@bugKanbanOrder')->name('bug.kanban.order');
    Route::get('projects/{id}/bug/kanban', 'ProjectsController@bugKanban')->name('task.bug.kanban');
    Route::get('projects/{id}/bug', 'ProjectsController@bug')->name('task.bug');
    Route::get('projects/{id}/bug/create', 'ProjectsController@bugCreate')->name('task.bug.create');
    Route::post('projects/{id}/bug/store', 'ProjectsController@bugStore')->name('task.bug.store');
    Route::get('projects/{id}/bug/{bid}/edit', 'ProjectsController@bugEdit')->name('task.bug.edit');
    Route::put('projects/{id}/bug/{bid}/update', 'ProjectsController@bugUpdate')->name('task.bug.update');
    Route::delete('projects/{id}/bug/{bid}/destroy', 'ProjectsController@bugDestroy')->name('task.bug.destroy');

    Route::get('projects/{id}/bug/{bid}/show', 'ProjectsController@bugShow')->name('task.bug.show');
    Route::post('projects/{id}/bug/{bid}/comment', 'ProjectsController@bugCommentStore')->name('bug.comment.store');
    Route::post('projects/bug/{bid}/file', 'ProjectsController@bugCommentStoreFile')->name('bug.comment.file.store');
    Route::delete('projects/bug/comment/{id}', 'ProjectsController@bugCommentDestroy')->name('bug.comment.destroy');
    Route::delete('projects/bug/file/{id}', 'ProjectsController@bugCommentDestroyFile')->name('bug.comment.file.destroy');
});

Route::resource('calender', 'CalenderController')->middleware(['auth','xss',]);

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('bugstatus', 'BugStatusController');
    Route::post('/bugstatus/order', ['as' => 'bugstatus.order','uses' => 'BugStatusController@order',]);
});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::resource('invoices', 'InvoiceController');
    Route::get('invoices/{id}/products', 'InvoiceController@productAdd')->name('invoices.products.add');
    Route::get('invoices/{id}/products/{pid}', 'InvoiceController@productEdit')->name('invoices.products.edit');
    Route::post('invoices/{id}/products', 'InvoiceController@productStore')->name('invoices.products.store');
    Route::put('invoices/{id}/products/{pid}', 'InvoiceController@productUpdate')->name('invoices.products.update');
    Route::delete('invoices/{id}/products/{pid}', 'InvoiceController@productDelete')->name('invoices.products.delete');
    Route::post('invoices/milestone/task', 'InvoiceController@milestoneTask')->name('invoices.milestone.task');
    Route::get('invoices/{id}/get_invoice', 'InvoiceController@printInvoice')->name('get.invoice');

    Route::get('invoices-payments', 'InvoiceController@payments')->name('invoices.payments');
    Route::get('invoices/{id}/payments', 'InvoiceController@paymentAdd')->name('invoices.payments.create');
    Route::post('invoices/{id}/payments', 'InvoiceController@paymentStore')->name('invoices.payments.store');
});

Route::resource('taxes', 'TaxController');
Route::resource('plans', 'PlanController')->middleware(['auth','xss',]);

Route::resource('products', 'ProductsController')->middleware(['auth','xss',]);
Route::resource('expenses', 'ExpenseController')->middleware(['auth','xss',]);
Route::resource('payments', 'PaymentController')->middleware(['auth','xss',]);
Route::resource('notes', 'NoteController')->middleware(['auth','xss',]);

Route::resource('jobs', 'JobController')->middleware(['auth','xss',]);

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::get('/orders', 'StripePaymentController@index')->name('order.index');
    Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe');
    Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');

});

Route::group(['middleware' => ['auth','xss',],], function (){
    Route::get('/Inventory', 'InventoryController@index')->name('inventory.index');
    

});

