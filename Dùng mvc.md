Tạo controller: php artisan make:controller folder/name_file
Trong controller khai báo hàm để trả về UI và data
Trong layout tổng (.blade.php) cần chèn hoặc thêm UI con thì chừa 1 thẻ trống để chèn
Viết ajax trong layout tổng để control các UI con
UI con thì để trong 1 file.blade.php
Khai báo ở Route đường đi của ajax và tên hàm trong file như sau
Route::<phương thức trùng với method trong ajax>('/trong url', [Controller::class, 'function_name'])-><name_in_ajax>
vd: Route::get('layout', [AdminController::class, 'showAll'])->name('admin.layout');

Luồng đi như sau:
Nhấn 1 nút có ajax ở layout tổng -> route như khai báo -> hàm trong controller -> nhận về view và data
