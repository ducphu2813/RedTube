<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\clients\CommentController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\HomePageController;
use App\Http\Controllers\clients\MemberShipController;
use App\Http\Controllers\clients\PlaylistController;
use App\Http\Controllers\clients\SchoolsController;
use App\Http\Controllers\clients\StudioController;
use App\Http\Controllers\clients\StuidoController;
use App\Http\Controllers\clients\UsersController;
use App\Http\Controllers\clients\VideoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

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


Route::middleware('CheckLogin')->get('/', [HomeController::class, 'index'])->name('home');

//client route, school
Route::middleware('CheckLogin')->prefix('schools')->group(function(){

    //lấy ra danh sách trường học(GET)
    Route::get('/', [SchoolsController::class, 'index'])->name('schools.index');

    //lấy ra 1 trường học theo id(GET) áp dụng cho show form cập nhật thông tin trường học(GET)
    Route::get('/{id}', [SchoolsController::class, 'getSchool'])
        ->name('schools.detail')
        ->where('id', '[0-9]+');

    //show form cập nhật thông tin trường học(GET)
    Route::get('/edit/{id}', [SchoolsController::class, 'showFormUpdateSchool'])
        ->name('schools.edit')
        ->where('id', '[0-9]+');

    //xử lý cập nhật thông tin trường học(PUT)
    Route::put('/edit/{id}', [SchoolsController::class, 'handleUpdateSchool'])
        ->name('schools.update')
        ->where('id', '[0-9]+');

    //show form thêm mới trường học(GET)
    Route::get('/add', [SchoolsController::class, 'showFormAddSchool'])
        ->name('schools.add');

    //xử lý thêm mới trường học(POST)
    Route::post('/add', [SchoolsController::class, 'handleAddSchool'])
        ->name('schools.store');

    //xóa trường học(DELETE)
    Route::delete('/delete/{id}', [SchoolsController::class, 'deleteSchool'])
        ->name('schools.delete')
        ->where('id', '[0-9]+');
});


//admin route
Route::prefix('admin')->group(function (){


    //1 ví dụ về route resource cho controller
    //Laravel sẽ tự sinh ra các route cho các phương thức trong controller
    Route::middleware('ProductPermisson')->resource('products', ProductsController::class);

    // --------------------Phần này của Dương --------------------//
    // Show all
    Route::get('adminLayout', [AdminController::class, 'showAll'])->name('admin.all');
    // Show video
    Route::get('videoManager', [AdminController::class, 'showVideoList'])->name('admin.videoManager');
    // Show user
    Route::get('userManager', [AdminController::class, 'showUserList'])->name('admin.userManager');
    // Show test
    Route::get('checkManager', [AdminController::class, 'showCheckList'])->name('admin.checkManager');
    // Show comment
    Route::get('commentManager', [AdminController::class, 'showCommentList'])->name('admin.commentManager');
    // Show chart
    Route::get('chartManager', [AdminController::class, 'showChartList'])->name('admin.chartManager');
    // --------------------Hết phần của Dương --------------------//
});

// Cái này của Dương nhưng là Home Page + Studio
Route::get('createPlaylist', [PlaylistController::class, 'showCreatePlaylist'])->name('playlist.createPlaylist');
Route::get('createMemberPackage', [MemberShipController::class, 'showCreateMemberShip'])->name('membership.createMemberPackage');
Route::get('studioPage', [StudioController::class, 'index'])->name('clients.studioPage')->middleware('CheckLogin');
Route::get('buyPremium', [HomePageController::class, 'buyPremium'])->name('clients.buyPremium');
// Hết của Dương

Route::get('studioPage/contents', [StudioController::class, 'contents'])->name('studio.contents')->middleware('CheckLogin');
Route::get('studioPage/contents/videos/{pageNumber}', [StudioController::class, 'contentsVideos'])->name('studio.contents.videos')->middleware('CheckLogin');
Route::get('studioPage/contents/playlists/{pageNumber}', [StudioController::class, 'contentsPlaylists'])->name('studio.contents.playlists')->middleware('CheckLogin');
Route::get('studioPage/premium', [StudioController::class, 'premium'])->name('studio.premium')->middleware('CheckLogin');
Route::get('studioPage/profile', [StudioController::class, 'profile'])->name('studio.profile')->middleware('CheckLogin');

Route::get('studioPage/videoDetails/{video_id}', [StudioController::class, 'videoDetails'])->name('studio.videoDetails')->middleware('CheckLogin');

//hiện layout user
Route::get('users', [UsersController::class, 'index'])->name('users.layout');

// hiện danh sách user
Route::get('users/all', [UsersController::class, 'listUser'])->name('users.all');

//tìm user theo id
Route::get('users/{id}', [UsersController::class, 'findById'])
    ->name('users.detail')
    ->where('id', '[0-9]+');

//hiện trang user detail
Route::get('users/detail/{id}', [UsersController::class, 'userDetail'])
    ->name('users.user-detail')
    ->where('id', '[0-9]+');

//route để trả về trang tìm kiếm user theo tên
Route::get('users/name', [UsersController::class, 'index'])->middleware('auth');

//tìm theo tên user
Route::get('users/name/{name}', [UsersController::class, 'findByName'])
    ->name('users.name');

//hiện form thêm user
Route::get('users/add', [UsersController::class, 'showFormAddUser'])
    ->name('users.add');

//xử lý thêm user
Route::post('users/add', [UsersController::class, 'addUser'])
    ->name('users.store');

//hiện chi tiết video của user
Route::get('videos/{video_id}', [VideoController::class, 'videoDetail'])
    ->name('video.detail')
    ->where('id', '[0-9]+');

//update ảnh đại diện
Route::post('users/update-picture', [UsersController::class, 'updatePicture'])
    ->name('users.update-picture');



//test get comment
Route::get('comments/video/{video_id}', [CommentController::class, 'getCommentByVideoId'])
    ->name('comments');

//test get reply
Route::get('comments/reply/{comment_id}', [CommentController::class, 'getReplyCommentsByCommentId'])
    ->name('comments.reply');

//save root comment
Route::post('comments/save', [CommentController::class, 'saveRootComment'])
    ->name('comments.save');

//save reply comment
Route::post('comments/reply/save', [CommentController::class, 'saveReplyComment'])
    ->name('comments.reply.save');

//test playlist
Route::get('users/playlist', [UsersController::class, 'showPlaylist'])
    ->name('user.playlist');

//update video playlist
Route::post('playlist/update', [PlaylistController::class, 'updateVideoPlaylist'])
    ->name('playlist.update');



//phần xử lý đăng nhập và đăng ký
//show login and register
Route::get('auth', [UsersController::class, 'loginRegister'])
    ->name('login-register')
    ->middleware('CheckLoggedIn');

//xử lý đăng ký
Route::post('auth/register', [RegisterController::class, 'register'])->name('auth.register');

//xử lý đăng nhập
Route::post('auth/login', [LoginController::class, 'login'])
    ->name('auth.login')
    ->middleware('CheckLoggedIn');

//hiện form quên mật khẩu
Route::get('auth/forgot', [UsersController::class, 'forgotPassword'])
    ->name('forgot')
    ->middleware('CheckLoggedIn');

//hiện form reset mật khẩu
Route::get('auth/reset', [UsersController::class, 'resetPassword'])->name('reset');

//hiện userdashboard
Route::get('users/dashboard', [UsersController::class, 'showUserDashboard'])
    ->name('users.dashboard')
    ->middleware('CheckLogin');

//logout
Route::get('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');

//
//Route::get('/category/{category}', [HomeController::class, 'getCategory'])->name('category');
//
//Route::get('/about', function () {
//    return 'Among us';
//});
//
//Route::get('/show-form', function(){
//   return view('name');
//})->name('show-form');
//
//Route::post('/name', function(Request $request){
//    $name = $request->input('name');
//   return 'Phương thức post và mày tên là '.$name;
//});


// group route
//Route::prefix('users')->middleware('CheckPermissionMiddleware')->group(function(){
//
//    Route::get('/', function(){
//        return 'Đây là trang danh sách user';
//    });
//
//    Route::get('/{id}', function($id){
//        return 'Đây là trang chi tiết user có id là '.$id;
//    })->where('id', '[0-9]+');
//
//    Route::get('/{id}/invoice', function($id){
//        return 'Tìm tất cả hóa đơn của user có id là '.$id;
//    })->where('id', '[0-9]+');
//
//    Route::get('/{id}/invoice/{invId?}', function($id, $invId = null){
//        return 'Tìm hóa đơn '.$invId. ' của user có id là '.$id;
//    })->where('id', '[0-9]+')->where('invId', '[0-9]+');
//
//    Route::get('/show-form', function(){
//        return view('name');
//    })->name('users.show-form');
//
//});
//
//Route::get('/news/{category}-{id}', function($category, $id){
//    return 'Đây là trang tin tức thuộc chuyên mục '.$category. ' có id là '.$id;
//})->where(
//    [
//        'category' => '.+',
//        'id' => '[0-9]+'
//    ])->name('news.detail');

//Route::put('/name', function(Request $request){
//    $name = $request->input('name');
//   return 'Phương thức put và mày tên là '.$name;
//});

//Route::match(['get', 'post', 'put'], '/name', function(Request $request){
//    $name = $request->input('name');
//    $method = $request->method();
//    return 'Phương thức '. $method .' và mày tên là '.$name;
//});
