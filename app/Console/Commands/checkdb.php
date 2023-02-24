<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class checkdb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:db'; // php artisan check:db

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            \DB::connection('mysql')->getPDO();
            $this->info('MySQL connection success');
        } catch (\Exception $e) {
            $this->info('MySQL connection lost');
            $this->info($e->getMessage());
        } catch (\Throwable $e) {
            $this->info('MySQL connection lost');
            $this->info($e->getMessage());
        }
    }
}
