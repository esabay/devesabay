<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'App\Controllers\Frontend\HomeController@index');

Route::get('widget/{name}', 'WidgetController@widget');

#product
Route::group(array('prefix' => 'product'), function() {
    Route::get('/', 'App\Controllers\Frontend\JshoppingController@index');
    Route::get('category/{id}', 'App\Controllers\Frontend\JshoppingController@category');
    Route::get('view/{id}', 'App\Controllers\Frontend\JshoppingController@itemProduct');
    Route::post('comment/add', 'App\Controllers\Frontend\JshoppingController@commentSave');
});

Route::group(array('prefix' => 'shopping'), function() {
    Route::get('cart', 'App\Controllers\Frontend\JshoppingController@viewCart');
    Route::get('viewcart', 'App\Controllers\Frontend\JshoppingController@viewCartUpdate');
    Route::post('cart/add', 'App\Controllers\Frontend\JshoppingController@addCart');
    Route::post('cart/delete', 'App\Controllers\Frontend\JshoppingController@deleteCart');
    Route::post('cart/update', 'App\Controllers\Frontend\JshoppingController@updateCart');
    Route::get('checkout', array('before' => 'authen', 'uses' => 'App\Controllers\Frontend\JshoppingController@checkout'));
    Route::get('orders/view/{id}', array('before' => 'authen', 'uses' => 'App\Controllers\Frontend\JshoppingController@viewOrder'));
    Route::get('orders/print/{id}', array('before' => 'authen', 'uses' => 'App\Controllers\Frontend\JshoppingController@printOrder'));
    Route::post('wishlist', 'App\Controllers\Frontend\JshoppingController@wishlist');
    Route::post('cart/confirm', 'App\Controllers\Frontend\JshoppingController@confirm');
    Route::get('history', 'App\Controllers\Frontend\JshoppingController@history');
    Route::post('order/cancel', 'App\Controllers\Frontend\JshoppingController@cancelOrder');
    Route::get('payment/add/{id}', 'App\Controllers\Frontend\JshoppingController@addPayment');
    Route::post('payment/add', 'App\Controllers\Frontend\JshoppingController@addPaymentSave');
});

#post
Route::group(array('prefix' => 'post'), function() {
    Route::get('/', 'App\Controllers\Frontend\PostController@index');
    Route::get('/{id}', 'App\Controllers\Frontend\PostController@viewPost');
    Route::post('comment/add', 'App\Controllers\Frontend\PostController@commentSave');
});

#user
Route::group(array('prefix' => 'user', 'before' => 'authen'), function() {
    Route::get('/dashboard', 'App\Controllers\Frontend\UserController@dashboard');
    Route::get('/profile/edit', 'App\Controllers\Frontend\UserController@editProfile');
    Route::post('/profile/edit', 'App\Controllers\Frontend\UserController@editProfileSave');
    Route::post('/profile/edit/delete/att/{file}', 'App\Controllers\Frontend\UserController@deleteAttachments');
    Route::get('/shopping/shipping/edit', 'App\Controllers\Frontend\UserController@editShipping');
    Route::post('/shopping/shipping/edit', 'App\Controllers\Frontend\UserController@editShippingSave');
    Route::get('/shopping/tax/edit', 'App\Controllers\Frontend\UserController@editShoppingTax');
    Route::post('/shopping/tax/edit', 'App\Controllers\Frontend\UserController@editShoppingTaxSave');
});

###############################################################################
//common
Route::group(array('prefix' => 'backend/common', 'before' => 'auth'), function() {
    Route::get('read', 'App\Controllers\Backend\CommonController@setNotificationRead');
    Route::get('notification', 'App\Controllers\Backend\CommonController@notification');
});
#backend/Dashboard
Route::get('backend', 'App\Controllers\Backend\DashboardController@getDashboard');
#Backend/Post
Route::group(array('prefix' => 'backend/post', 'before' => 'auth'), function() {

    Route::any('/', 'App\Controllers\Backend\PostController@index');
    Route::get('view/{id}', 'App\Controllers\Backend\PostController@view');
    Route::get('add', 'App\Controllers\Backend\PostController@addPost');
    Route::post('add', 'App\Controllers\Backend\PostController@addPostSave');
    Route::get('edit/{id}', 'App\Controllers\Backend\PostController@editPost');
    Route::post('edit', 'App\Controllers\Backend\PostController@editPostSave');
    Route::get('delete', 'App\Controllers\Backend\PostController@deletePostSave');
    Route::get('group', 'App\Controllers\Backend\PostController@group');
    Route::get('group/add', 'App\Controllers\Backend\PostController@addGroup');
    Route::post('group/add', 'App\Controllers\Backend\PostController@addGroupSave');
    Route::get('group/edit', 'App\Controllers\Backend\PostController@editGroup');
    Route::post('group/edit', 'App\Controllers\Backend\PostController@editGroupSave');
    Route::get('group/delete', 'App\Controllers\Backend\PostController@deleteGroupSave');
    Route::get('group/sub/add', 'App\Controllers\Backend\PostController@addSubGroup');
    Route::post('group/sub/add', 'App\Controllers\Backend\PostController@addSubGroupSave');
});
//user
Route::group(array('prefix' => 'backend/user', 'before' => 'auth'), function() {
    Route::get('profile', 'App\Controllers\Backend\UserController@profile');
    Route::get('profile/edit', 'App\Controllers\Backend\UserController@editProfile');
    Route::post('profile/edit/login', 'App\Controllers\Backend\UserController@editProfileLoginSave');
    Route::post('profile/edit/avatar', 'App\Controllers\Backend\UserController@editProfileAvatarSave');
    Route::post('profile/edit', 'App\Controllers\Backend\UserController@editProfileSave');
});
//Examination
Route::group(array('prefix' => 'backend/jexamination', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JexaminationController@index');
    Route::get('examination', 'App\Controllers\Backend\JexaminationController@examination');
    Route::get('examination/view/{id}', 'App\Controllers\Backend\JexaminationController@viewExamination');
    Route::get('examination/add', 'App\Controllers\Backend\JexaminationController@addExamination');
    Route::post('examination/add', 'App\Controllers\Backend\JexaminationController@addExaminationSave');
    Route::get('examination/edit/{id}', 'App\Controllers\Backend\JexaminationController@editExamination');
    Route::post('examination/edit', 'App\Controllers\Backend\JexaminationController@editExaminationSave');
    Route::get('examination/question/add/{id}', 'App\Controllers\Backend\JexaminationController@addQuestion');
    Route::post('examination/question/add', 'App\Controllers\Backend\JexaminationController@addQuestionSave');
    Route::get('examination/question/edit/{id}', 'App\Controllers\Backend\JexaminationController@editQuestion');
    Route::post('examination/question/edit', 'App\Controllers\Backend\JexaminationController@editQuestionSave');
    Route::post('examination/question/delete', 'App\Controllers\Backend\JexaminationController@deleteQuestionSave');
    Route::get('examination/delete', 'App\Controllers\Backend\JexaminationController@deleteExaminationSave');
    Route::get('test', 'App\Controllers\Backend\JexaminationController@test');
    Route::get('test/view/{id}', 'App\Controllers\Backend\JexaminationController@viewTest');
    Route::post('test/view/{id}', 'App\Controllers\Backend\JexaminationController@viewTestSave');
    Route::get('group', 'App\Controllers\Backend\JexaminationController@group');
    Route::get('group/add', 'App\Controllers\Backend\JexaminationController@addGroup');
    Route::post('group/add', 'App\Controllers\Backend\JexaminationController@addGroupSave');
    Route::get('group/edit', 'App\Controllers\Backend\JexaminationController@editGroup');
    Route::post('group/edit', 'App\Controllers\Backend\JexaminationController@editGroupSave');
    Route::get('group/delete', 'App\Controllers\Backend\JexaminationController@deleteGroupSave');
    Route::get('group/sub/add', 'App\Controllers\Backend\JexaminationController@addSubGroup');
    Route::post('group/sub/add', 'App\Controllers\Backend\JexaminationController@addSubGroupSave');
});
#Backend/Organization
Route::group(array('prefix' => 'backend/jorganization', 'before' => 'auth'), function() {
    Route::any('/', 'App\Controllers\Backend\JorganizationController@index');
    Route::get('view/{id}', 'App\Controllers\Backend\PostController@view');
    Route::get('add', 'App\Controllers\Backend\PostController@addPost');
    Route::post('add', 'App\Controllers\Backend\PostController@addPostSave');
    Route::get('edit/{id}', 'App\Controllers\Backend\PostController@editPost');
    Route::post('edit', 'App\Controllers\Backend\PostController@editPostSave');
    Route::get('delete', 'App\Controllers\Backend\PostController@deletePostSave');
    Route::get('department', 'App\Controllers\Backend\JorganizationController@department');
    Route::get('department/add', 'App\Controllers\Backend\JorganizationController@addDepartment');
    Route::post('department/add', 'App\Controllers\Backend\JorganizationController@addDepartmentSave');
    Route::get('department/edit', 'App\Controllers\Backend\JorganizationController@editDepartment');
    Route::post('department/edit', 'App\Controllers\Backend\JorganizationController@editDepartmentSave');
    Route::get('department/delete', 'App\Controllers\Backend\JorganizationController@deleteDepartmentSave');
    Route::get('department/sub/add', 'App\Controllers\Backend\JorganizationController@addSubDepartment');
    Route::post('department/sub/add', 'App\Controllers\Backend\JorganizationController@addSubDepartmentSave');
});
#Backend/jcalendar
Route::group(array('prefix' => 'backend/jcalendar', 'before' => 'auth'), function() {
    Route::any('/', 'App\Controllers\Backend\JcalendarController@index');
    Route::get('events', 'App\Controllers\Backend\JcalendarController@events');
    Route::get('events/{id}', 'App\Controllers\Backend\JcalendarController@viewEvent');
    Route::get('events/add', 'App\Controllers\Backend\JcalendarController@addEvent');
    Route::post('events/add', 'App\Controllers\Backend\JcalendarController@addEventSave');
    Route::get('events/edit/{id}', 'App\Controllers\Backend\JcalendarController@editEvent');
    Route::post('events/edit', 'App\Controllers\Backend\JcalendarController@editEventSave');
    Route::get('delete', 'App\Controllers\Backend\JcalendarController@deleteEventSave');
    Route::get('group', 'App\Controllers\Backend\JcalendarController@group');
    Route::get('group/add', 'App\Controllers\Backend\JcalendarController@addgroup');
    Route::post('group/add', 'App\Controllers\Backend\JcalendarController@addgroupSave');
    Route::get('group/edit', 'App\Controllers\Backend\JcalendarController@editgroup');
    Route::post('group/edit', 'App\Controllers\Backend\JcalendarController@editgroupSave');
    Route::get('group/delete', 'App\Controllers\Backend\JcalendarController@deletegroupSave');
    Route::get('group/sub/add', 'App\Controllers\Backend\JcalendarController@addSubgroup');
    Route::post('group/sub/add', 'App\Controllers\Backend\JcalendarController@addSubgroupSave');
});
#Backend/jcareer
Route::group(array('prefix' => 'backend/jcareer', 'before' => 'auth'), function() {
    Route::any('/', 'App\Controllers\Backend\JcareerController@index');
    Route::get('jobdescription', 'App\Controllers\Backend\JcareerController@jobDescription');
    Route::get('jobdescription/add', 'App\Controllers\Backend\JcareerController@addJobDescription');
    Route::post('jobdescription/add', 'App\Controllers\Backend\JcareerController@addJobDescriptionSave');
    Route::get('jobdescription/edit/{id}', 'App\Controllers\Backend\JcareerController@editJobDescription');
    Route::post('jobdescription/edit', 'App\Controllers\Backend\JcareerController@editJobDescriptionSave');
    Route::get('jobdescription/view/{id}', 'App\Controllers\Backend\JcareerController@viewJobDescription');
    Route::get('jobdescription/delete', 'App\Controllers\Backend\JcareerController@deleteJobDescriptionSave');
    Route::get('application', 'App\Controllers\Backend\JcareerController@applicaiton');
    Route::get('application/view/{id}', 'App\Controllers\Backend\JcareerController@viewApplicaiton');
    Route::get('interview/{id}', 'App\Controllers\Backend\JcareerController@interview');
    Route::post('interview/confirm', 'App\Controllers\Backend\JcareerController@confirmInterview');
    Route::post('interview/cancel', 'App\Controllers\Backend\JcareerController@cancelInterview');
    Route::post('interview/add', 'App\Controllers\Backend\JcareerController@addInterviewSave');
    Route::post('interview/check', 'App\Controllers\Backend\JcareerController@checkInterview');

    Route::get('position', 'App\Controllers\Backend\JcareerController@position');
    Route::get('position/add', 'App\Controllers\Backend\JcareerController@addPosition');
    Route::post('position/add', 'App\Controllers\Backend\JcareerController@addPositionSave');
    Route::get('position/edit/{id}', 'App\Controllers\Backend\JcareerController@editPosition');
    Route::post('position/edit', 'App\Controllers\Backend\JcareerController@editPositionSave');
    Route::get('position/view/{id}', 'App\Controllers\Backend\JcareerController@viewPosition');
    Route::get('position/delete', 'App\Controllers\Backend\JcareerController@deletePositionSave');
});

Route::group(array('prefix' => 'backend/setting', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\SettingController@index');
    Route::post('/', 'App\Controllers\Backend\SettingController@saveSetting');

    Route::get('user', 'App\Controllers\Backend\UserController@getIndex');
    Route::get('user/add', 'App\Controllers\Backend\UserController@addUser');
    Route::post('user/add', 'App\Controllers\Backend\UserController@addUserSave');
    Route::get('user/edit', 'App\Controllers\Backend\UserController@editUser');
    Route::post('user/edit', 'App\Controllers\Backend\UserController@editUserSave');
    Route::get('user/delete', 'App\Controllers\Backend\UserController@deleteUserSave');

    Route::get('permissions', 'App\Controllers\Backend\PermissionsController@getIndex');
    Route::get('permissions/roles/add', 'App\Controllers\Backend\PermissionsController@addRoles');
    Route::post('permissions/roles/add', 'App\Controllers\Backend\PermissionsController@addRolesSave');
    Route::get('permissions/roles/edit', 'App\Controllers\Backend\PermissionsController@editRoles');
    Route::post('permissions/roles/edit', 'App\Controllers\Backend\PermissionsController@editRolesSave');
    Route::get('permissions/roles/delete', 'App\Controllers\Backend\PermissionsController@deleteRolesSave');
});

//J-shopping
Route::group(array('prefix' => 'backend/jshopping', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JshoppingController@index');
    Route::match(array('GET', 'POST'), 'product', array('uses' => 'App\Controllers\Backend\JshoppingController@product'));
    Route::match(array('GET', 'POST'), 'product/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addProduct'));
    Route::match(array('GET', 'POST'), 'product/edit/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@editProduct'));
    Route::get('product/view/{id}', 'App\Controllers\Backend\JshoppingController@viewProduct');
    Route::get('product/delete', 'App\Controllers\Backend\JshoppingController@deleteProductSave');

    Route::match(array('GET', 'POST'), 'productprice/edit/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@editProductPrice'));
    Route::match(array('GET', 'POST'), 'productspec/add/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@addProductSpec'));
    Route::match(array('GET', 'POST'), 'productspec/edit/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@editProductSpec'));

    Route::get('category', 'App\Controllers\Backend\JshoppingController@category');
    Route::match(array('GET', 'POST'), 'category/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addCategory'));
    Route::match(array('GET', 'POST'), 'category/sub/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addSubCategory'));
    Route::get('category/sub/{id}', 'App\Controllers\Backend\JshoppingController@viewSubCategory');
    Route::match(array('GET', 'POST'), 'category/edit', array('uses' => 'App\Controllers\Backend\JshoppingController@editCategory'));
    Route::match(array('GET', 'POST'), 'category/move', array('uses' => 'App\Controllers\Backend\JshoppingController@moveCategory'));
    Route::get('category/delete', 'App\Controllers\Backend\JshoppingController@deleteCategorySave');

    Route::get('suppliers', 'App\Controllers\Backend\JshoppingController@suppliers');
    Route::match(array('GET', 'POST'), 'suppliers/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addSuppliers'));
    Route::match(array('GET', 'POST'), 'suppliers/edit', array('uses' => 'App\Controllers\Backend\JshoppingController@editSuppliers'));
    Route::get('suppliers/delete', 'App\Controllers\Backend\JshoppingController@deleteSuppliersSave');

    Route::get('shipper', 'App\Controllers\Backend\JshoppingController@shipper');
    Route::match(array('GET', 'POST'), 'shipper/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addShipper'));
    Route::match(array('GET', 'POST'), 'shipper/edit', array('uses' => 'App\Controllers\Backend\JshoppingController@editShipper'));
    Route::get('shipper/delete', 'App\Controllers\Backend\JshoppingController@deleteShipperSave');

    Route::get('spec', 'App\Controllers\Backend\JshoppingController@spec');
    Route::match(array('GET', 'POST'), 'spec/add', array('uses' => 'App\Controllers\Backend\JshoppingController@addSpec'));
    Route::match(array('GET', 'POST'), 'spec/edit', array('uses' => 'App\Controllers\Backend\JshoppingController@editSpec'));

    Route::match(array('GET', 'POST'), 'product/gallery/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@gallery'));
    Route::get('product/gallery/delete/{id}', 'App\Controllers\Backend\JshoppingController@deleteGallerySave');

    Route::get('setting', 'App\Controllers\Backend\JshoppingController@setting');

    Route::get('orders', 'App\Controllers\Backend\JshoppingController@orders');
    Route::get('orders/view/{id}', 'App\Controllers\Backend\JshoppingController@viewOrders');
    Route::get('orders/notified/payment/{id}', 'App\Controllers\Backend\JshoppingController@viewPayment');
    Route::get('orders/print/{id}', 'App\Controllers\Backend\JshoppingController@printOrder');
    Route::match(array('GET', 'POST'), 'orders/change/status/{id}', array('uses' => 'App\Controllers\Backend\JshoppingController@changeStatus'));
});

//Shopping2
Route::group(array('prefix' => 'backend/posting', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\PostingController@index');
    Route::get('posting/view/{id}', 'App\Controllers\Backend\PostingController@viewPosting');
    Route::get('post', 'App\Controllers\Backend\PostingController@post');
    Route::post('post', 'App\Controllers\Backend\PostingController@post');
    Route::get('post/add', 'App\Controllers\Backend\PostingController@addPost');
    Route::post('post/add', 'App\Controllers\Backend\PostingController@addPostSave');
    Route::get('post/edit/{id}', 'App\Controllers\Backend\PostingController@editPost');
    Route::post('post/edit', 'App\Controllers\Backend\PostingController@editPostSave');
    Route::get('post/view/{id}', 'App\Controllers\Backend\PostingController@viewPost');
    Route::get('post/delete', 'App\Controllers\Backend\PostingController@deletePostSave');

    Route::get('category', 'App\Controllers\Backend\PostingController@category');
    Route::get('category/add', 'App\Controllers\Backend\PostingController@addCategory');
    Route::post('category/add', 'App\Controllers\Backend\PostingController@addCategorySave');
    Route::get('category/sub/add', 'App\Controllers\Backend\PostingController@addSubCategory');
    Route::post('category/sub/add', 'App\Controllers\Backend\PostingController@addSubCategorySave');
    Route::get('category/edit', 'App\Controllers\Backend\PostingController@editCategory');
    Route::post('category/edit', 'App\Controllers\Backend\PostingController@editCategorySave');
    Route::get('category/move', 'App\Controllers\Backend\PostingController@moveCategory');
    Route::post('category/move', 'App\Controllers\Backend\PostingController@moveCategorySave');
    Route::get('category/delete', 'App\Controllers\Backend\PostingController@deleteCategorySave');

    Route::get('product/gallery/{id}', 'App\Controllers\Backend\PostingController@gallery');
    Route::post('product/gallery/{id}', 'App\Controllers\Backend\PostingController@addGallerySave');
    Route::get('product/gallery/delete/{id}', 'App\Controllers\Backend\PostingController@deleteGallerySave');

    Route::get('orders', 'App\Controllers\Backend\PostingController@orders');
    Route::get('orders/view/{id}', 'App\Controllers\Backend\PostingController@viewOrders');
    Route::get('orders/notified/payment/{id}', 'App\Controllers\Backend\PostingController@viewPayment');
    Route::get('orders/change/status/{id}', 'App\Controllers\Backend\PostingController@changeStatus');
    Route::post('orders/change/status', 'App\Controllers\Backend\PostingController@changeStatusSave');
});

#J-Project
Route::group(array('prefix' => 'backend/jproject', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JprojectController@index');
    Route::get('/project', 'App\Controllers\Backend\JprojectController@project');
    Route::get('/project/view/{id}', 'App\Controllers\Backend\JprojectController@viewProject');
    Route::get('/project/add', 'App\Controllers\Backend\JprojectController@addProject');
    Route::post('/project/add', 'App\Controllers\Backend\JprojectController@addProjectSave');
    Route::get('/project/edit', 'App\Controllers\Backend\JprojectController@editProject');
    Route::post('/project/edit', 'App\Controllers\Backend\JprojectController@editProjectSave');
    Route::get('/customer', 'App\Controllers\Backend\JprojectController@customer');
    Route::get('/customer/add', 'App\Controllers\Backend\JprojectController@addCustomer');
    Route::post('/customer/add', 'App\Controllers\Backend\JprojectController@addCustomerSave');
    Route::get('/customer/edit', 'App\Controllers\Backend\JprojectController@editCustomer');
    Route::post('/customer/edit', 'App\Controllers\Backend\JprojectController@editCustomerSave');
    Route::get('/customer/delete', 'App\Controllers\Backend\JprojectController@deleteCustomerSave');

    Route::get('/document', 'App\Controllers\Backend\JprojectController@document');
    Route::get('/document/add/01', 'App\Controllers\Backend\JprojectController@addDocument01');
    Route::post('/document/add/01', 'App\Controllers\Backend\JprojectController@addDocument01Save');
    Route::get('/document/edit/01/{id}', 'App\Controllers\Backend\JprojectController@editDocument01');
    Route::post('/document/edit/01', 'App\Controllers\Backend\JprojectController@editDocument01Save');
    Route::get('/document/view/01/{id}', 'App\Controllers\Backend\JprojectController@viewDocument01');
    Route::get('/document/delete/01', 'App\Controllers\Backend\JprojectController@deleteDocument01Save');

    Route::get('/document/add/02/{id}', 'App\Controllers\Backend\JprojectController@addDocument02');
    Route::post('/document/add/02', 'App\Controllers\Backend\JprojectController@addDocument02Save');

    Route::get('/document/edit/02/{id}', 'App\Controllers\Backend\JprojectController@editDocument02');
    Route::post('/document/edit/02', 'App\Controllers\Backend\JprojectController@editDocument02Save');
});

Route::group(array('prefix' => 'gallery'), function() {
    Route::get('/', 'App\Controllers\Frontend\JgalleryController@index');
    Route::get('/{id}', 'App\Controllers\Frontend\JgalleryController@viewGallery');
});
Route::group(array('prefix' => 'backend/jgallery', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JgalleryController@index');
    Route::get('/view/{id}', 'App\Controllers\Backend\JgalleryController@view');
    Route::get('/gallery/{id}', 'App\Controllers\Backend\JgalleryController@addGallery');
    Route::post('/gallery/{id}', 'App\Controllers\Backend\JgalleryController@addGallerySave');
    Route::get('/gallery/delete/{id}', 'App\Controllers\Backend\JgalleryController@deleteGallerySave');

    Route::get('/add', 'App\Controllers\Backend\JgalleryController@add');
    Route::post('/add', 'App\Controllers\Backend\JgalleryController@addSave');
    Route::get('/edit', 'App\Controllers\Backend\JgalleryController@edit');
    Route::post('/edit', 'App\Controllers\Backend\JgalleryController@editSave');
    Route::get('/delete', 'App\Controllers\Backend\JgalleryController@deleteSave');
    Route::get('/group', 'App\Controllers\Backend\JgalleryController@group');
    Route::get('group/add', 'App\Controllers\Backend\JgalleryController@addGroup');
    Route::post('group/add', 'App\Controllers\Backend\JgalleryController@addGroupSave');
    Route::get('group/edit', 'App\Controllers\Backend\JgalleryController@editGroup');
    Route::post('group/edit', 'App\Controllers\Backend\JgalleryController@editGroupSave');
    Route::get('group/delete', 'App\Controllers\Backend\JgalleryController@deleteGroupSave');
});

Route::group(array('prefix' => 'backend/jbranch', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JbranchController@index');
    Route::get('branch', 'App\Controllers\Backend\JbranchController@branch');
    Route::match(array('GET', 'POST'), 'branch/edit/{id}', array('uses' => 'App\Controllers\Backend\JbranchController@editBranch'));
});

Route::group(array('prefix' => 'backend/jdealer', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JdealerController@index');
    Route::get('dealer', 'App\Controllers\Backend\JdealerController@dealer');
    Route::match(array('GET', 'POST'), 'dealer/view/{id}', array('uses' => 'App\Controllers\Backend\JdealerController@viewDealer'));
});

Route::group(array('prefix' => 'backend/jcontact', 'before' => 'auth'), function() {
    Route::get('/', 'App\Controllers\Backend\JcontactController@index');
    Route::get('contact', 'App\Controllers\Backend\JcontactController@contact');
    Route::match(array('GET', 'POST'), 'contact/view/{id}', array('uses' => 'App\Controllers\Backend\JcontactController@viewContact'));
    Route::get('contact/view/{id}', 'App\Controllers\Backend\JcontactController@viewContact');
});

#Login
Route::get('cp', array('uses' => 'App\Controllers\SecurityController@getLogin'));
Route::post('cp', array('uses' => 'App\Controllers\SecurityController@doLogin'));
Route::get('cp/register', array('uses' => 'App\Controllers\SecurityController@getRegister'));
Route::post('cp/register', array('uses' => 'App\Controllers\SecurityController@setRegisterSave'));
Route::get('logout', array('uses' => 'App\Controllers\SecurityController@getLogout'));
Route::get('login', array('uses' => 'App\Controllers\Frontend\UserController@login'));
Route::post('login', array('uses' => 'App\Controllers\SecurityController@webLogin'));
Route::get('register', array('uses' => 'App\Controllers\Frontend\UserController@register'));
Route::post('register', array('uses' => 'App\Controllers\Frontend\UserController@registerSave'));
Route::match(array('GET', 'POST'), 'contact', array('uses' => 'App\Controllers\Frontend\ContactController@index'));
Route::get('user/activate/{key}', array('uses' => 'App\Controllers\Frontend\UserController@activateUser'));
Route::get('careers', 'App\Controllers\Backend\JcareerController@frontDashboard');
Route::get('careers/select/position', 'App\Controllers\Backend\JcareerController@selectPos');
Route::get('careers/application/form', 'App\Controllers\Backend\JcareerController@formApplicaiton');
Route::post('careers/application/form', 'App\Controllers\Backend\JcareerController@formApplicaitonSave');
Route::get('careers/list', 'App\Controllers\Backend\JcareerController@joblist');
Route::get('careers/list/view/{id}', 'App\Controllers\Backend\JcareerController@jobView');
Route::get('examination/test/{id}', 'App\Controllers\Backend\JexaminationController@testForm');
Route::post('examination/test', 'App\Controllers\Backend\JexaminationController@testFormSave');

Route::get('/checkAuth', function() {
    if (\Auth::check()) {
        return 0;
    } else {
        return 1;
    }
});

Route::get('get/amphur', function() {
    $input = Input::get('option');
    $amphur = \DB::table('amphur')->where('PROVINCE_ID', $input);
    return Response::json($amphur->select(array('AMPHUR_ID', 'AMPHUR_NAME'))->get());
});

Route::get('get/district', function() {
    $input = Input::get('option');
    $district = \DB::table('district')->where('AMPHUR_ID', $input);
    return Response::json($district->select(array('DISTRICT_ID', 'DISTRICT_NAME'))->get());
});

Route::get('get/zipcode', function() {
    $input = Input::get('option');
    $amphur_postcode = \DB::table('amphur_postcode')->where('AMPHUR_ID', $input);
    return Response::json($amphur_postcode->select(array('AMPHUR_ID', 'POST_CODE'))->take(1)->get());
});

Route::get('get/test', function() {
    $input = Input::get('option');
    $pos = \Careerposition::find($input);
    $test = \DB::table('examination')->where('department_id', $pos->department_id);
    return Response::json($test->select(array('id', 'title'))->get());
});

Route::get('get/category/sub', function() {
    $input = Input::get('option');
    $category = \Categorize::getCategoryProvider()->findById($input);
    return Response::json($category->getChildren()->toArray());
});

Route::get('product/process', 'App\Controllers\Backend\CommonController@process2');

// Display all SQL executed in Eloquent
//Event::listen('illuminate.query', function($query) {
//    var_dump($query);
//});

Route::get('test/store', function() {
    $ts = \DB::select('CALL getTmpProduct');
    var_dump($ts);
});
