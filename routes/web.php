<?php

Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});

/*
 * Home
 */
Route::get('/', 'WelcomeController');


/**
 * Books
 */
Route::get('/members/search', 'MemberController@search');
Route::get('/claims/search', 'ClaimController@search');

Route::get('/members/search-process', 'MemberController@searchProcess');
Route::get('/claims/search-process', 'ClaimController@searchProcess');

# CREATE
Route::get('/members/create', 'MemberController@create');
Route::get('/claims/create', 'ClaimController@create');

Route::post('/members', 'MemberController@store');
Route::post('/claims', 'ClaimController@store');


# SHOW
Route::get('/members/{id}', 'MemberController@show');
Route::get('/claims/{id}', 'ClaimController@show');


Route::get('/members', 'MemberController@index');
Route::get('/claims', 'ClaimController@index');

# EDIT
# Show the form to edit a specific member

Route::get('/members/{id}/edit', 'MemberController@edit');
Route::get('/claims/{id}/edit', 'ClaimController@edit');


# Process the form to edit a specific member
Route::put('/members/{id}', 'MemberController@update');
Route::put('/claims/{id}', 'ClaimController@update');

# DELETE
# Show the page to confirm deletion of a book
Route::get('/members/{id}/delete', 'MemberController@delete');
Route::get('/claims/{id}/delete', 'ClaimController@delete');

# Process the deletion of a book
Route::delete('/members/{id}/delete', 'MemberController@destroy');
Route::delete('/claims/{id}/delete', 'ClaimController@destroy');


/**
 * Practice
 */
Route::any('/practice/{n?}', 'PracticeController@index');


/*
 * Pages
 * Simple, static pages without a lot of logic
 */
Route::view('/about', 'about');
Route::view('/contact', 'contact');


# Example shown at the end of Week 6's lectures
# to discuss the kind of planning work you can do for Project 3
//Route::get('/', 'TriviaController@index');
//Route::get('/check-answer', 'TriviaController@checkAnswer');
