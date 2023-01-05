<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class EncryptUserTable extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encrypt:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt the users table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        //Encrypt the user table data
        $users = User::get();

        $propertiesToEncrypt = ['phone', 'carrier', 'school', 'google_id', 'google_email'];

        foreach ($users as $user) {
            foreach ($propertiesToEncrypt as $property) {
                if (isset($user->{$property}) && $user->{$property} != '')
                    $user->{$property} = Crypt::encryptString($user->{$property});
            }
            $user->save();
        }
        return Command::SUCCESS;
    }
}
