<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/gmaps', 'LocationController@location');

// Api Route

// Auth API
$router->post('api/login', 'AuthController@loginUser');
$router->post('api/register', 'AuthController@registerUser');
$router->get('api/logout', 'AuthController@logoutUser');

// User API
$router->get('api/getuser', 'UsersController@getUser');
$router->post('api/createuser', 'UsersController@createUser');
$router->get('api/getmasyarakat', 'UsersController@getMasyarakat');

// Laporan API
$router->get('api/getlaporan', 'LaporanController@getLaporan');
$router->post('api/createlaporan', 'LaporanController@createLaporan');
$router->get('api/getIdLaporan/{id}', 'LaporanController@getDataId');
$router->post('api/editstatus/{id}', 'LaporanController@updateStatus');
$router->get('api/getlaporanselesai', 'LaporanController@getSelesai');
$router->get('api/getlaporanbelum', 'LaporanController@getBelum');

// Status API
$router->get('api/getstatus', 'StatusController@getStatus');

// Instansi API
$router->get('api/getinstansi', 'InstansiController@getInstansi');

// Kategori Laporan API
$router->get('api/getkategori', 'KategoriController@getKategori');

// Tanggapan API
$router->get('api/gettanggapan', 'TanggapanController@getTanggapan');
$router->post('api/createtanggapan', 'TanggapanController@createTanggapan');
$router->delete(
    'api/deletetanggapan/{id}',
    'TanggapanController@deleteTanggapan'
);

// Role API
$router->get('api/getrole', 'RoleController@getRole');

// Generate API
$router->get('api/getpdf', 'GenerateController@printPDF');
$router->get('api/view', 'GenerateController@view');
