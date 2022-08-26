<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AssignmentNote extends Model {
    use HasFactory;

    protected $fillable = ['content'];

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * Decrypt the contents and parse for links
     *
     * @return string
     */
    public function getParsedContentsAttribute(): string {
        $decrypted = Crypt::decryptString($this->content);

        $reg_pattern = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";

        return preg_replace($reg_pattern, '<a class="link" href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $decrypted);
    }

    /**
     * Get a string representation of the date the note was created on
     *
     * @return string
     */
    public function getCreatedDatetimeAttribute(): string {
        return Carbon::parse($this->created_at)->format('M j, Y • g:i A');
    }
}
