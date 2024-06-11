<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FibonacciQuery extends Model
{
    protected $fillable = ['name', 'value', 'result'];
    public $timestamps = false;
    
    protected static function booted()
    {
        static::creating(function ($query) {
            $query->result = $query->calculateFibonacci();
        });
    }

    
    public function calculateFibonacci()
    {
        $n = $this->value;

        if ($n <= 0) {
            return 0;
        }

        $a = 0;
        $b = 1;

        for ($i = 2; $i <= $n; $i++) {
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }

        return $b;
    }
}