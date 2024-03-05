<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'Gaming News',
            'preview_image_key' => 'demo-files/esports-min.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'Reviews',
            'preview_image_key' => 'demo-files/stats-min.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'Gaming equipment',
            'preview_image_key' => 'demo-files/controller-min.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'Guides',
            'preview_image_key' => 'demo-files/microphone-min.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'Banger Games Official',
            'preview_image_key' => 'demo-files/business-min.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_categories')->insert([
            'parent_id' => null,
            'name' => 'General Blog Description',
            'preview_image_key' => 'demo-files/controller-min.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //CATEGORY SLUGS

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '1',
            'slug' => 'category-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '2',
            'slug' => 'category-2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '3',
            'slug' => 'category-3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '4',
            'slug' => 'category-4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '5',
            'slug' => 'category-5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_category_slugs')->insert([
            'blog_category_id' => '6',
            'slug' => 'category-6',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        //POSTS

        DB::table('blog_posts')->insert([
            'name' => 'Fortnite Season 3 Splash Down Is Here With Jason Momoa, New Battle Pass, Marauders, And More',
            'status' => 'published',
            'meta_title' => 'Fortnite Season 3',
            'meta_description' => 'Fortnite Season 3 Splash Down Is Here With Jason Momoa, New Battle Pass, Marauders, And More',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/fortnite-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/fortnite-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_posts')->insert([
            'name' => 'The Division 2\'s New Iron Horse Raid Launches Later This Month',
            'status' => 'published',
            'meta_title' => 'The Division',
            'meta_description' => 'The Division 2\'s New Iron Horse Raid Launches Later This Month',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/division-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/division-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_posts')->insert([
            'name' => 'Star Wars: Squadrons Revealed With Cross-Play, Single-Player Campaign, No Microtransactions',
            'status' => 'published',
            'meta_title' => 'Star wars',
            'meta_description' => 'Star Wars: Squadrons Revealed With Cross-Play, Single-Player Campaign, No Microtransactions',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/star+wars-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/star+wars-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_posts')->insert([
            'name' => 'DC To Host Massive Virtual "FanDome" Event, Includes The Batman And Zack Snyder\'s Justice League',
            'status' => 'published',
            'meta_title' => 'Div',
            'meta_description' => 'Division 2 Title Update 10 Patch Notes Released',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/business-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/business-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_posts')->insert([
            'name' => 'The Last Of Us Part II Review (Spoiler-Free)',
            'meta_title' => 'last',
            'status' => 'published',
            'meta_description' => 'The Last Of Us Part II Review (Spoiler-Free)',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/the-last-of-us-2-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/the-last-of-us-2-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_posts')->insert([
            'name' => 'The Last Of Us Part ',
            'meta_title' => 'last',
            'status' => 'published',
            'meta_description' => 'The Last Of Us Part',
            'main_category_id' => '1',
            'preview_image_key' => 'demo-files/elly-min.jpg',
            'body' => "<p><img style=\"width: 100%;\" src=\"https://cdn.bangergames.com/demo-files/elly-min.jpg\">                      </p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum leo eu lacus feugiat bibendum. Phasellus ut sem quis arcu suscipit rutrum volutpat vel dolor. Vestibulum elementum scelerisque orci, sed tempor ligula semper vel. Ut et cursus dui. Etiam dignissim ex aliquet massa cursus, in pellentesque turpis bibendum. Nulla scelerisque est sapien, non pulvinar odio vulputate sed. Praesent porttitor nisl in augue sollicitudin feugiat. Pellentesque dictum eros est. Fusce dictum nec risus consectetur ultricies. Morbi ultricies neque neque, sed tempus erat venenatis vitae. Etiam hendrerit lectus in tellus lacinia, eu volutpat justo pulvinar. Integer vestibulum euismod metus, quis eleifend sem semper euismod. Quisque rhoncus eget ipsum id interdum.</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\"><br></span><br></p>",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //POST SLUGS

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '1',
            'slug' => 'post-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '2',
            'slug' => 'post-2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '3',
            'slug' => 'post-3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '4',
            'slug' => 'post-4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '5',
            'slug' => 'post-5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('blog_post_slugs')->insert([
            'blog_post_id' => '6',
            'slug' => 'post-6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
