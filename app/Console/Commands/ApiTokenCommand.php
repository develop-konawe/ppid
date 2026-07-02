<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ApiTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate-token {user_id} {token_name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API token for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $tokenName = $this->argument('token_name') ?? 'Integration Token';

        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found.");
            return 1;
        }

        $token = $user->createToken($tokenName);

        $this->info("API Token generated successfully for user: {$user->name}");
        $this->info("Token Name: {$tokenName}");
        $this->warn("Token (Save this, it won't be shown again):");
        $this->line($token->plainTextToken);

        return 0;
    }
}
