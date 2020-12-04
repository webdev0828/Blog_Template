<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Posts;

class FetchBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:hour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new blogs from another blogging platform';

    protected $client;
    protected $api_url;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
        $this->api_url = 'https://sq1-api-test.herokuapp.com/posts';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        try {
            $response = $this->client->get($this->api_url);
            $responseJson = $response->getBody()->getContents();
            $responseObj = json_decode($responseJson, true);
            $blogs = $responseObj['data'];
            $admin = User::where('role', 'admin')->first();
    
            foreach($blogs as $blog) {
                $post = new Posts();
                $post->title = $blog['title'];
                $post->description = $blog['description'];
                $post->slug = Str::slug($blog['title']);
                $post->author_id = $admin->id;
                $post->created_at = $blog['publication_date'];
                $post->updated_at = $blog['publication_date'];
                
                //if already existed, continue;
                $duplicate = Posts::where('slug', $post->slug)->first();
                if ($duplicate) continue;
                // save blog
                $post->save();
            }

            file_put_contents('error_logs.txt', date("Y-m-d"), FILE_APPEND);
            file_put_contents('error_logs.txt', 'Success', FILE_APPEND);

        } catch (\Exception $e) {
            file_put_contents('error_logs.txt', date("Y-m-d"), FILE_APPEND);
            file_put_contents('error_logs.txt', $e->getMessage(), FILE_APPEND);
        }        
    }
}
