<?php

namespace App\Models;

use App\Events\LoanCreated;
use App\Events\LoanDeleted;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'create_date', 'return_date', 'member_id'];

    protected $dispatchesEvents = [
        'created' => LoanCreated::class,
        'deleting' => LoanDeleted::class,
    ];

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function member()
    {
    	return $this->belongsTo(Member::class);
    }

    public function getReturnLocalAttribute(): String
    {
        return localDate($this->return_date);
    }

    public function getCreateLocalAttribute(): String
    {
        return localDate($this->create_date);
    }

    public function getStatusBadgeAttribute(): String
    {
        if ($this->status) {
            $replace = ['success', 'Dikembalikan'];
        } else if (today() > $this->return_date) {
            $replace = ['danger', 'Terlambat'];
        } else {
            $replace = ['primary', 'Dipinjam'];
        }

        return badge($replace);
    }

    public function getLateAttribute(): Int
    {
        $diff = date_diff(date_create($this->return_date), today());
        return max($diff->format('%R%a'), 0);
    }

    public function getFineAttribute(): String
    {
        return number_format($this->late * setting('fine'));
    }
}
