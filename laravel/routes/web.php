<?php
use App\AcceptedJob;
use App\User;
use App\Job;
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
    return view('index');
});
Route::get('milestone/create/jobid/{id}','MilestoneController@create');



Route::get('milestone/clientFinish/{id}/{id2}','MilestoneController@clientFinish');
Route::get('milestone/lancerFinish/{id}/{id2}','MilestoneController@lancerFinish');
Route::resource('milestone','MilestoneController');

Route::get('job/cari','JobController@cari');
Route::post('job/accept/{id_user}/{id_job}','JobController@accept');
Route::post('job/apply/{id}','JobController@apply');
Route::get('job/manage','JobController@manage');
Route::resource('job','JobController');

Route::resource('acceptedJob','AcceptedJobController');
Route::resource('user','UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('notification/read/{id}','NotificationController@read');
Route::get('notification/readall',function(){
	Auth::user()->unreadNotifications->markAsRead();
	return 'hehe'; 
});
Route::resource('notification','NotificationController');


Route::get('/message/conversationWith','MessageController@conversationWith');
Route::get('/message/user/{id}','MessageController@checkWithOtherUser');
Route::get('/message/send/woorkroom','MessageController@sendWorkroomMessage');
Route::get('/message/send/private','MessageController@sendPrivateMessage');
Route::get('/message/get/woorkroom','MessageController@getWorkroomMessage');
Route::get('/message/get/private','MessageController@getPrivateMessage');


Route::get('product/manage','ProductController@manage');
Route::resource('product','ProductController');


Route::get('sampledata',function(){
	$uuid1 = Uuid::generate(4);
	$uuid2 = Uuid::generate(4);
	$uuid3 = Uuid::generate(4);
	$uuid4 = Uuid::generate(4);
	
	DB::table('users')->insert([
		[
			'id'			=> $uuid1,
			'name'			=> 'Adrian Eka',
			'email'			=> 'client@gmail.com',
			'password'		=> bcrypt('aaaaaa'),
			'occupation'	=> 'Client',
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
		[
			'id'			=> $uuid2,
			'name'			=> 'Penjelajah Dunia',
			'email'			=> 'client2@gmail.com',
			'password'		=> bcrypt('aaaaaa'),
			'occupation'	=> 'Client',
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
		[
			'id'			=> $uuid3,
			'name'			=> 'Eka Sanjaya',
			'email'			=> 'lancer@gmail.com',
			'password'		=> bcrypt('aaaaaa'),
			'occupation'	=> 'Lancer',
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
		[
			'id'			=> $uuid4,
			'name'			=> 'Pengabdi Kerja',
			'email'			=> 'lancer2@gmail.com',
			'password'		=> bcrypt('aaaaaa'),
			'occupation'	=> 'Lancer',
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
	]);
	DB::table('jobs')->insert([
		[
			'jobTitle'		=> 'Web Developer For BCA1',
			'fee'			=> '500000',
			'id_user'		=> $uuid1,
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
		[
			'jobTitle'		=> 'Web Developer For BCA2',
			'fee'			=> '500000',
			'id_user'		=> $uuid1,
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
	]);
	DB::table('applicants')->insert([
		[
			'id_user'		=> $uuid2,
			'id_job'		=> '1',
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
	]);
	DB::table('products')->insert([
		[
			'id'			=> Uuid::generate(4),
			'id_user'		=> $uuid3,
			'product_name'	=> 'Program Administrasi Kantor',
			'price'			=> 10000,
			'created_at'	=> '2018-03-30 10:26:47',
			'updated_at'	=> '2018-03-30 10:26:47',
		],
	]);
	DB::table('notifications')->insert([
		[
			'id'				=> Uuid::generate(4),
			'type'				=> 'App\Notifications\ApplyToJob',
			'notifiable_id'		=> $uuid1,
			'notifiable_type'	=> 'App\User',
			'data'				=> '{"id_job":"1","id_lancer":"'.$uuid2.'"}',
			'created_at'		=> '2018-03-30 10:26:47',
			'updated_at'		=> '2018-03-30 10:26:47',
		],
	]);
	DB::table('conversations')->insert([
		[
			'id'				=> Uuid::generate(4),
			'id_user1'			=> $uuid1,
			'id_user2'			=> $uuid3,
			'created_at'		=> '2018-03-30 10:26:47',
			'updated_at'		=> '2018-03-30 10:26:47',
		],
		[
			'id'				=> Uuid::generate(4),
			'id_user1'			=> $uuid1,
			'id_user2'			=> $uuid4,
			'created_at'		=> '2018-03-30 10:26:47',
			'updated_at'		=> '2018-03-30 10:26:47',
		],
	]);
	
	return redirect('/');
});