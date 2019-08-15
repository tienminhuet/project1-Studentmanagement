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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// register Course
Route::get('/registercustom', 'Auth\RegisterController@registercustom')->name('registercustom');
Route::post('/registerSubmit', 'Auth\RegisterController@registerSubmit')->name('registerSubmit');
// Login Facebook
Route::get('auth/facebook', 'RegisterCustomController@redirectToProvider')->name('facebook.login') ;
Route::get('auth/facebook/callback', 'RegisterCustomController@handleProviderCallback');

Route::group(['middleware' => 'locale'], function() {
    Route::group(['middleware' => 'auth'], function() {
        Route::get('change-language/{language}', 'LanguageController@changeLanguage')->name('user.change-language');
        Route::get('dashboard', 'HomeController@index')->name('home');
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/editprofile', 'UserController@editprofile')->name('editprofile');

        Route::group(['prefix' => 'admin'], function() {
            
            Route::get('/datatable/{id}', 'UserController@UserDatatable')->name('datatables.user');
            Route::post('/add/{id}', 'UserController@add')->name('addUser');
            Route::post('/changestatus', 'UserController@changestatus')->name('changestatus');
            Route::post('/changePassword', 'UserController@changePassword')->name('changePassword');

            Route::group(['prefix' => 'teachers'], function() {
                Route::get('/', 'UserController@teacher');
            });

            Route::prefix('/students')->group(function() {
                Route::get('/', 'UserController@student');
            });
            Route::get('/showUser/{id}', 'UserController@showUser')->name('showUser');
            Route::prefix('/classes')->group(function() {
                Route::get('/', 'ClassesController@index');
                Route::get('/ClassesDatatable/{status}', 'ClassesController@classesDatatable')->name('classesDatatable');
                Route::get('/studentClassDatatable/{user_id}', 'ClassesController@studentClassDatatable')->name('studentClassDatatable');
                Route::get('/teacherClassDatatable/{user_id}/{status}', 'ClassesController@teacherClassDatatable')->name('teacherClassDatatable');
                Route::post('/addClass', 'ClassesController@addclass')->name('addClass');
                Route::post('/addLesson', 'ClassesController@addLesson')->name('addLesson');
                Route::get('datatablesAdddetail/{classId}', 'ClassesController@datatablesAdddetail')->name('datatables.addDetaiClass');
                Route::post('/addStudentToClass', 'ClassesController@addStudentToClass')->name('addStudentToClass');
                Route::get('/classDetail/{id}', 'ClassInforController@index')->name('classDetail');
                Route::get('/classDetailDatatable/{id}', 'ClassInforController@classDetailDatatable')->name('classDetailDatatable');
                // edit content of lession: document, exercise, name ...
                Route::get('/editLession/{class_id}/{lesson_id}', 'ClassInforController@editLession')->name('editLession');
                Route::post('/editinfo', 'ClassInforController@editinfo')->name('editinfo');
                Route::post('/editlessionDocument', 'ClassInforController@editlessionDocument')->name('editlessionDocument');
                Route::post('/editlessionExercise', 'ClassInforController@editlessionExercise')->name('editlessionExercise');
                Route::get('/ShowLession/{class_id}/{lesson_id}', 'ClassInforController@ShowLession')->name('ShowLession');
                Route::get('/ShowExercise/{class_id}/{lesson_id}', 'ClassInforController@ShowExercise')->name('ShowExercise');
                // submit exercise for student.
                Route::post('/submitExercise', 'HomeworkController@submitExercise')->name('submitExercise');
                Route::post('/showHomework', 'HomeworkController@showHomework')->name('showHomework');
                // marking
                Route::get('/showmarkingLession/{class_id}/{lesson_id}', 'HomeworkController@showmarkingLession')->name('showmarkingLession');
                Route::get('/markingLession/{class_id}/{lesson_id}/{user_id}', 'HomeworkController@markingLession')->name('markingLession');
                Route::post('/submitMarking', 'HomeworkController@submitMarking')->name('submitMarking');
            });

            // list register
            Route::get('/registerList', 'RegisterCustomController@registerList');
            Route::get('/registerDatatable/{status}', 'RegisterCustomController@registerDatatable')->name('registerDatatable');

        });

        Route::prefix('/documents')->group(function() {
            Route::get('/theory', 'DocumentController@index');
            Route::get('/theoryDatatable', 'DocumentController@theoryDatatable')->name('theoryDatatable');
            Route::post('/addTheory', 'DocumentController@create')->name('addDocument');
            Route::get('/showTheory/{id}', 'DocumentController@show')->name('showDocument');
            Route::get('/editTheory/{id}', 'DocumentController@edit')->name('editDocument');
            Route::post('/updateTheory/{id}', 'DocumentController@update')->name('updateDocument');
            Route::post('/deleteTheory/{id}', 'DocumentController@destroy')->name('deleteDocument');

            Route::get('/exercise', 'ExerciseController@index');
            Route::get('/exerciseDatatable', 'ExerciseController@exerciseDatatable')->name('exerciseDatatable');
            Route::post('/addExercise', 'ExerciseController@create')->name('addExercise');
            Route::get('/showExercise/{id}', 'ExerciseController@show')->name('showExercise');
            Route::get('/editExercise/{id}', 'ExerciseController@edit')->name('editExercise');
            Route::post('/updateExercise/{id}', 'ExerciseController@update')->name('updateExercise');
            Route::post('/deleteExercise/{id}', 'ExerciseController@destroy')->name('deleteExercise');
            Route::post('/importData', 'ExerciseController@importData')->name('importData');
        });

        Route::get('permission', 'PermissionController@index');
        Route::get('permissionDatatable', 'PermissionController@permissionDatatable');
        
    });
});
