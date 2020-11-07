<?php


use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


                    // > /admin/... (soon implementation) [Role admin]


                    // ROUTING [Authentifier]
                    // > /user/profile/
                    // > /user/dashboard/
                    // > /user/board/


Route::prefix('user')->middleware('auth')->group(function () {
        // DASHBOARD :  Meta View: manage all Todos (my and share)
    Route::get('/dashboard', 'BoardController@index')
        ->name('board');
    Route::post('/dashboard', 'BoardController@store')
        ->name('board.store');

    Route::get('/profile','ProfileController@index')
        ->name('profile');
    Route::post('/profile','ProfileController@store')
        ->name('profile.store');

    // Route::prefix('board/{todoId}')->group(function () {
            // Manage 1 Todo
    Route::get('/board/{boardId}', 'TodoController@index')
        ->name('todo');
    Route::post('/board/{boardId}', 'TodoController@store')
        ->name('todo.store');
    // });

    Route::post('/task/{taskid}', 'TaskController@store')
        ->name('task.store');
    Route::put('/com/{commentId}', 'CommentController@store')
        ->name('comment.store');
});





// Route pour afficher la vue contenant le profil
Route::get('/prof', 'ProfController@index')->name('prof');

// Route pour envoyer les informations dans la BDD User
Route::post('/prof', 'ProfController@update')->name('prof.store');

