<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareNoti extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'share_noti';

    protected $casts = [
//        'created_date' => 'datetime',
//        'expiry_date' => 'datetime',
    ];

    protected $primaryKey = 'noti_id';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'registration_id',
        'status',
        'created_date',
        'expiry_date',
    ];

    //lấy thông báo theo registration_id, trả về 1 mảng
    public static function getNotiByRegistrationId(int $registrationId)
    {
        return self::query()
            ->where('registration_id', $registrationId)
            ->get();
    }

    //kiểm tra xem sender có thể gửi share premium tới receiver không
    public static function isSendable(int $senderId, int $receiverId, int $registrationId)
    {
        // Kiểm tra xem sender đã gửi cùng 1 yêu cầu đó cho receiver chưa
        $isAlreadySent = self::query()
            ->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('registration_id', $registrationId)
            ->exists();

        if ($isAlreadySent) {
            return 'alreadysent';
        }

        // Kiểm tra xem receiver có đang dùng chung gói premium của sender hay không
        $isReceiverUsingSenderPremium = SharePremium::query()
            ->where('premium_registration_id', $registrationId)
            ->where('user_id', $receiverId)
            ->where('expiry_date', '>', date('Y-m-d H:i:s'))
            ->exists();

        if ($isReceiverUsingSenderPremium) {
            return 'receiverusingsenderpremium';
        }

        // Kiểm tra số lượng người dùng hiện tại của gói premium
        $premiumRegistration = PremiumRegistration::getPremiumRegistrationById($registrationId);
        $package = $premiumRegistration->package;
        $shareLimit = $package->share_limit;

        $currentUsersCount = $premiumRegistration->getCurrentUsersCount();
        $sharedNotiCount = self::query()
            ->where('registration_id', $registrationId)
            ->count();

        $totalUsersCount = $currentUsersCount + $sharedNotiCount;

        // Kiểm tra xem số lượng người dùng hiện tại có nhỏ hơn giới hạn chia sẻ hay không
        if ($totalUsersCount >= $shareLimit) {
            return 'sharelimitexceeded';
        }

        return 'sendable';
    }

    //lấy thông báo của receiver
    public static function getNotiByReceiver(int $receiverId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('receiver_id', $receiverId)
            ->with(['sender', 'registration'])
            ->get();

        return $result;
    }

    //lấy thông báo của sender
    public static function getNotiBySender(int $senderId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('sender_id', $senderId)
            ->where('expiry_date', '>', $currentDate)
            ->with(['receiver', 'registration'])
            ->get();

        return $result;
    }


    //create
    public static function createShareNoti(array $data): bool
    {
        $sender_id = $data['sender_id'];
        $receiver_id = $data['receiver_id'];
        $registration_id = $data['registration_id'];
        $created_date = date('Y-m-d H:i:s');
        $expiry_date = $data['expiry_date'];

        return self::query()
            ->insert([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'registration_id' => $registration_id,
                'status' => false,
                'created_date' => $created_date,
                'expiry_date' => $expiry_date,
            ]);
    }

    //tìm theo noti_id
    public static function getNotiById(int $notiId)
    {
        return self::query()
            ->where('noti_id', $notiId)
            ->first();
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'sender_id', 'user_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'receiver_id', 'user_id');
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(PremiumRegistration::class, 'registration_id');
    }

    //delete
    public static function deleteNotiById(int $notiId)
    {
        return self::query()
            ->where('noti_id', $notiId)
            ->delete();
    }
}
