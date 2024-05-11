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
        'created_date' => 'datetime',
        'expiry_date' => 'datetime',
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

    //kiểm tra xem sender có gửi thông báo chia sẻ đến receiver chưa
    public static function isSendable(int $senderId, int $receiverId): bool
    {

        if($senderId == $receiverId){
            return false;
        }
        
        else if(self::query()
            ->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->exists()
        ){
            if(self::query()
                ->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId)
                ->where('expiry_date', '>', date('Y-m-d H:i:s'))
                ->exists()
            ){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return true;
        }
    }

    //lấy thông báo của receiver
    public static function getNotiByReceiver(int $receiverId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('receiver_id', $receiverId)
            ->where('expiry_date', '>', $currentDate)
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
        $expiry_date = date('Y-m-d H:i:s', strtotime('+1 day'));

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
}
