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

Route::get('/', [ 'as' => 'initial', 'uses' => 'AuthController@index']);

Route::get('/test', function () {
    return view('template.adminlte');
});

Route::get('/parameters', "RoleController@index");
Route::post('/createrole', 'RoleController@create');
Route::get("/editrole/{id}", "RoleController@edit");
Route::post("/updateRole/{id}", "RoleController@update");
Route::get("/deleterole/{id}", "RoleController@delete");

Route::post('/createDocumento', 'tipoDocumentoController@create');
Route::get("/editDocumento/{id}", "tipoDocumentoController@edit");
Route::post("/updateDocumento/{id}", "tipoDocumentoController@update");
Route::get("/DeleteDocumento/{id}", "tipoDocumentoController@delete");

Route::get('/users', "UserController@index");
Route::post('/createuser', 'UserController@create');
Route::get("/editusuario/{id}", "UserController@edit");
Route::post("/updateUser/{id}", "UserController@update");
Route::get("/deleteUser/{id}", "UserController@delete");

Route::post('/createcredencial', 'credencialesController@create');
Route::get("/editcredencial/{id}", "credencialesController@edit");
Route::post("/updatecredencial/{id}", "credencialesController@update");
Route::get("/deletecredential/{id}", "credencialesController@delete");


Route::get('/ParaMet', "GradosController@index");
Route::post('/creategrado', 'GradosController@create');
Route::get("/editgrado/{id}", "GradosController@edit");
Route::post("/updategrado/{id}", "GradosController@update");
Route::get("/deletegrado/{id}", "GradosController@delete");


//_______________ Atenticación _________________>

Route::get('/login', "AuthController@index");
Route::post('/auth', "AuthController@login");
Route::get('/logout', 'AuthController@logout');
Route::get('/home', "indexController@home");


//------------AreaConocimientos----------
Route::post('/createareas', 'AreaConocimientoController@create');
Route::get("/editarea/{id}", "AreaConocimientoController@edit");
Route::post("/updatearea/{id}", "AreaConocimientoController@update");
Route::get("/deletearea/{id}", "AreaConocimientoController@Delete");

//-----------------periodos---------------------
Route::post('/createperiodo', 'periodoController@create');
Route::get("/editperiodo/{id}", "periodoController@edit");
Route::post("/updateperiodo/{id}", "periodoController@update");
Route::get("/deleteperiodo/{id}", "periodoController@Delete");

//------------materias-------------
Route::get('/Math', "materiaController@index");
Route::post('/createmateria', 'materiaController@create');
Route::get("/editmateri/{id}", "materiaController@edit");
Route::post("/updateMateri/{id}", "materiaController@update");
Route::get("/deleteMateria/{id}", "materiaController@Delete");

//------------notas------------------------
Route::post('/createNota', 'NotasController@create');
Route::get("/editNota/{id}", "NotasController@edit");
Route::post("/updateNota/{id}", "NotasController@update");
Route::get("/deleteNota/{id}", "NotasController@Delete");


//-----------------prop.materias--------
Route::get('/Materia', "PropiedadMateriaController@index");
Route::post('/createMat', 'PropiedadMateriaController@create');
Route::get("/editMat/{id}", "PropiedadMateriaController@edit");
Route::post("/updateMat/{id}", "PropiedadMateriaController@update");
Route::get("/deleteMat/{id}", "PropiedadMateriaController@Delete");

//-------------prop.notas-------------------
Route::post('/createNot', 'propiedadeNotaController@create');
Route::get("/editNot/{id}", "propiedadeNotaController@edit");
Route::post("/updateNot/{id}", "propiedadeNotaController@update");
Route::get("/deleteNot/{id}", "propiedadeNotaController@Delete");

//--------------tipo-pro-materias-----------------------
Route::post('/createProp', 'TiposPropiedadMateriaController@create');
Route::get("/editProp/{id}", "TiposPropiedadMateriaController@edit");
Route::post("/updateProp/{id}", "TiposPropiedadMateriaController@update");
Route::get("/deleteProp/{id}", "TiposPropiedadMateriaController@Delete");
//-------------prop.notas-------------------
Route::post('/createlogro', 'logrosController@create');
Route::get("/editlogro/{id}", "logrosController@edit");
Route::post("/updatelogro/{id}", "logrosController@update");
Route::get("/deletelogro/{id}", "logrosController@Delete");


//-------------boletin--------------------
//Route::get('/boletin', "indexController@boletin");
Route::get('/boletin', "BoletinController@index");
Route::get("/filterCourses","BoletinController@filterCourse");
Route::post('/materiagrado', "BoletinController@openScores");
Route::post('/scoreStudent', "BoletinController@scoreStudent");
Route::post('/qachivements', "BoletinController@qachivements");
Route::get("/downloadExcel/{id}", "BoletinController@generateExcel");
