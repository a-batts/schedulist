<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model {
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function eventEmailsEnabled() {
        return $this->event_emails === 1;
    }

    public function eventTextsEnabled() {
        return $this->event_texts === 1;
    }

    public function assignmentEmailsEnabled() {
        return $this->assignment_emails === 1;
    }

    public function assignmentTextsEnabled() {
        return $this->assignment_texts === 1;
    }
}
