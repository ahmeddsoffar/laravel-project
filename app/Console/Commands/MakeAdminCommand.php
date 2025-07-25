<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:admin {email}';

    /**
     * The console command description.
     */
    protected $description = 'Promote a user to admin by email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }
        
        if ($user->role === 'admin') {
            $this->info("User '{$email}' is already an admin.");
            return 0;
        }
        
        $user->update(['role' => 'admin']);
        
        $this->info("User '{$email}' has been promoted to admin successfully!");
        return 0;
    }
}
