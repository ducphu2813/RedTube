<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\clients\CommentController;
use App\Http\Controllers\clients\FollowController;
use App\Http\Controllers\clients\HistoryController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\HomePageController;
use App\Http\Controllers\clients\InteractionController;
use App\Http\Controllers\clients\MemberShipController;
use App\Http\Controllers\clients\PlaylistController;
use App\Http\Controllers\clients\PremiumController;
use App\Http\Controllers\clients\SchoolsController;
use App\Http\Controllers\clients\StudioController;
use App\Http\Controllers\clients\ShareNotiController;
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


// Video CRUD
Route::middleware('CheckLogin')->prefix('api/videos')->group(function() {
    Route::get('/', [VideoController::class, 'get'])->name('api.videos.get');
    Route::post('/', [VideoController::class, 'create'])->name('api.videos.create');
    Route::put('/', [VideoController::class, 'edit'])->name('api.videos.edit');
    Route::delete('/', [VideoController::class, 'delete'])->name('api.videos.delete');
});


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
    Route::post('changeStatusVideo', [AdminController::class, 'changeStatusVideo'])->name('admin.changeStatusVideo');
    // Show user
    Route::get('userManager', [AdminController::class, 'showUserList'])->name('admin.userManager');
    // Show test
    Route::get('checkManager', [AdminController::class, 'showCheckList'])->name('admin.checkManager');
    // Show comment
    Route::get('commentManager', [AdminController::class, 'showCommentList'])->name('admin.commentManager');
    // Show chart
    Route::get('showChart', [AdminController::class, 'showChartList'])->name('admin.showChart');
    // Change role user
    Route::post('changeRoleUser', [AdminController::class, 'changeRoleUser'])->name('admin.changeRoleUser');
    // Change status user
    Route::post('changeStatusUser', [AdminController::class, 'changeStatusUser'])->name('admin.changeStatusUser');
    // --------------------Hết phần của Dương --------------------//
});

// --------------------Cái này của Dương -------------------- //
//cái này của user
// Membership
Route::get('createMemberPackage', [MemberShipController::class, 'showCreateMemberShip'])
    ->middleware('CheckLogin')
    ->name('membership.createMemberPackage');

Route::get('membershipManager', [MemberShipController::class, 'showAllMembership'])
    ->middleware('CheckLogin')
    ->name('membership.membershipManager');

Route::get('membershipEdit/{id}', [MemberShipController::class, 'showMembershipDetail'])
    ->name('membership.membershipEdit')
    ->middleware('CheckLogin');
// end Membership

//trang chính của đồ án
Route::get('home', [HomePageController::class, 'index'])->name('clients.homePage');

// Kênh của tôi
Route::get('home/userChannel', [HomePageController::class, 'userChannel'])->name('clients.userChannel');
Route::get('home/userChannel/videos', [HomePageController::class, 'userChannelVideos'])->name('clients.userChannel.videos');
Route::get('home/userChannel/playlists', [HomePageController::class, 'userChannelPlaylists'])->name('clients.userChannel.playlists');

//????
Route::get('createPlaylist', [PlaylistController::class, 'showCreatePlaylist'])->name('playlist.createPlaylist');

//????
Route::get('studioPage', [StudioController::class, 'index'])
    ->middleware('CheckLogin')
    ->name('clients.studioPage');

//????
Route::get('buyPremium', [HomePageController::class, 'buyPremium'])->name('clients.buyPremium');

// Hiển thị danh sách xem sau
Route::get('showWatchLater', [PlaylistController::class, 'showWatchLater'])->name('clients.watchLater');

// Hiển thị tất cả danh sách phát ở trang chủ
Route::get('showAllPlaylist', [PlaylistController::class, 'showAllPlaylist'])->name('clients.playlistAll');

// Hiển thị danh sách lịch sử xem
Route::get('showHistory', [HistoryController::class, 'showHistory'])->name('clients.videoHistory');

// Hiển thị danh sách video tìm kiếm
Route::get('searchVideo', [VideoController::class, 'searchVideo'])->name('clients.searchVideo');

// Hiển thị lại trang video
Route::get('videoReload', [VideoController::class, 'reloadVideoList'])->name('clients.videoReload');

// Modal premium
Route::get('modalPremium', [PremiumController::class, 'showModalPremium'])->name('clients.modalPremium');

// Test screen video
Route::get('playVideo', [VideoController::class, 'playVideo'])->name('clients.playVideo');
// Route::get('studioPage', [StudioController::class, 'index'])->name('clients.studioPage')->middleware('CheckLogin');


// Premium Registaration
Route::get('premiumManager', [PremiumController::class, 'getAllRegistrations'])->name('premium.premiumManager');

// Show video by channel
Route::get('showVideoByChannel', [VideoController::class, 'showVideoByChannel'])->name('clients.showVideoByChannel');

// Không có premium
Route::get('noPremium', [PremiumController::class, 'noPremium'])->name('clients.noPremium');

// -------------------- Hết của Dương -------------------- //

Route::get('studioPage/contents', [StudioController::class, 'contents'])->name('studio.contents')->middleware('CheckLogin');
Route::get('studioPage/contents/videos', [StudioController::class, 'contentsVideos'])->name('studio.contents.videos')->middleware('CheckLogin');
Route::get('studioPage/contents/playlists', [StudioController::class, 'contentsPlaylists'])->name('studio.contents.playlists')->middleware('CheckLogin');
Route::get('studioPage/premium', [StudioController::class, 'premium'])->name('studio.premium')->middleware('CheckLogin');
Route::get('studioPage/profile', [StudioController::class, 'profile'])->name('studio.profile')->middleware('CheckLogin');

Route::get('studioPage/videoDetails', [StudioController::class, 'videoDetails'])->name('studio.videoDetails')->middleware('CheckLogin');    
Route::get('studioPage/pagination', [StudioController::class, 'pagination'])->name('studio.pagination')->middleware('CheckLogin');

Route::post('studioPage/profileEdit', [StudioController::class, 'profileEdit'])->name('studio.profileEdit');

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

//xem video
Route::get('playVideo/{video_id}', [VideoController::class, 'playVideo'])
    ->name('clients.playVideo')
    ->where('id', '[0-9]+');

//cũng là xem video nhưng từ danh sách phát
Route::get('playVideo/{video_id}/{playlist_id}', [VideoController::class, 'playVideo'])
    ->name('clients.playVideo.playlist')
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



//test share premium
Route::get('premium/share', [PremiumController::class, 'sharePage'])
    ->name('premium.share')
    ->middleware('CheckLogin');

//tìm user để share
Route::get('premium/find-user', [PremiumController::class, 'findUser'])
    ->name('premium.search-user')
    ->middleware('CheckLogin');

//xử lý send yêu cầu share premium
Route::post('premium/handle-send', [PremiumController::class, 'handleSend'])
    ->name('premium.handle-send')
    ->middleware('CheckLogin');

//hiện các thông báo share
Route::get('premium/noti', [ShareNotiController::class, 'notiPage'])
    ->name('premium.noti')
    ->middleware('CheckLogin');

//lấy thông báo share
Route::get('premium/get-noti', [ShareNotiController::class, 'getNoti'])
    ->name('premium.get-noti')
    ->middleware('CheckLogin');



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


//check login không thông qua middleware
Route::post('check-login', [UsersController::class, 'checkLogin'])->name('check-login');


//làm phần follow

//xử lý khi bấm subscribe
Route::post('follow', [FollowController::class, 'handleFollow'])
    ->name('follow.handle');


//làm phần like

//xử lý khi bấm like/dislike
Route::post('like', [InteractionController::class, 'handleLike'])
    ->name('like.handle');



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
