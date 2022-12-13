<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PublishPostsMail;
class PublishPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create published_at in posts table ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::whereNull('published_dt')->whereStatus(1)->get()->each(function($q) {
            $q->published_dt = Carbon::now();
            $q->save();
        });

        if ($posts) {
            Mail::to('saeedaha99@gmail.com')->send(new PublishPostsMail($posts));
            Log::info('Schedule is done at: ' . Carbon::now());

        }

        return Command::SUCCESS;
    }
}
