<?php

namespace App\Console\Commands;

use App\Jobs\PublishPostJob;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Type\Time;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:publish-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $time = Carbon::now('Africa/Cairo');

        $posts = Post::where('status', 'scheduled')
            ->where('scheduled_time', '<=', $time)
            ->get();
        foreach ($posts as $post) {
            PublishPostJob::dispatch($post);
        }
        $this->info('Scheduled posts published successfully.');
    }
}
