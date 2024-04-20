<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LoginUniqueRule implements Rule
{

    protected $table, $column;

    public function __construct($table, $column){
        $this->table = $table;
        $this->column = $column;
    }


    public function passes($attribute, $value){
        return DB::table($this->table)
            ->whereRaw("BINARY `$this->column` = ?", [$value])
            ->exists();

    }


    public function message()
    {
        if($this->column == 'email'){
            return 'Email không tồn tại';
        }
        return 'Tên tài khoản không tồn tại';
    }
}
