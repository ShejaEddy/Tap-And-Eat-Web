<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardValidation extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, "employee_id");
    }
}
