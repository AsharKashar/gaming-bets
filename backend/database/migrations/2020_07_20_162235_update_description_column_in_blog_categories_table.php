<?php

use App\Model\BlogCategory;
use App\Model\BlogCategorySlug;
use Illuminate\Database\Migrations\Migration;

class UpdateDescriptionColumnInBlogCategoriesTable extends Migration
{
    protected const CATEGORIES_DESCRIPTION = [
        'Guides' => 'We provide you with stepwise and easy-to-follow gaming guides. They are detailed and precise to make sure you’re not lost on the way. Guides are on competitive gaming, esports and anything involving gaming.
            There are guides for beginners and experienced gamers on different subjects. From getting started on our sites to ‘how to’ guides on a variety of subjects, here you’ll find useful information to help you improve your gaming experience.
            Where necessary, there are screenshots, photos, and embedded videos to make it more concise.',
        'Gaming equipment' => 'The essential gaming equipment that you must have to engage in competitive gaming such as a complete gaming PC and peripherals like keyboard, mouse, console, gaming chair, etc. You’ll also get reviews of the equipment and how to use them.
            There are also buying guides and recommendations on which equipment to use, what makes good gaming equipment, and their prices. Additionally, there are also reviews on specific equipment or a collection of them which touches on their features, advantages, and drawbacks.',
        'Reviews' => 'We review different gaming equipment such as PCs, chairs, and peripherals such as mice, keyboards, headphones, among others. The reviews are honest and focus on specific features of the equipment, pros, and cons.
            There is also comparison of different items including the strengths and shortcomings as compared to another one of the same calibre. Our reviews give a clear picture so that you can have a rough idea of what you want to buy.ss
            Reviews
            We review different gaming equipment such as PCs, chairs, and peripherals such as mice, keyboards, headphones, among others. The reviews are honest and focus on specific features of the equipment, pros, and cons.
            There is also comparison of different items including the strengths and shortcomings as compared to another one of the same calibre. Our reviews give a clear picture so that you can have a rough idea of what you want to buy.ss',
        'Gaming News' => 'All the gaming news including esports, gaming awards, players, new games, among others. Here, you will get to find out about new developments in the gaming industry worldwide.
                Also included are details of tournaments held, winners, and upcoming tournaments. It’s a space to keep watching if you’re interested in the latest gaming news including news about our site and the services we offer.',
        'Banger Games Official' => 'Here, you’ll find all the information you need about Banger Games and competitive gaming on our site. From games offered, prizes, sponsorship programs to our membership details, how to join Banger Games, and sign up for tournaments.
                Also, any added or improved services such as added games and any major announcements will be featured on Banger Games official. If you have any concerns, queries, or need assistance, reach out to the customer service on our page.',
        'General Blog Description' => 'Our blog covers everything about gaming and esports. From gaming news to buying guides, reviews, gaming equipment, upcoming tournaments, and our services.
            There is also content to help improve your gaming skills such as how to set up your gaming equipment and settings like sensitivity, mouse DPi among others. We also feature pro players, the equipment, settings they use as well as solutions to common gaming problems.
            If you’re interested in competitive gaming and you’d want to know more, you’ll find everything you need on our blog.',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', array('--class' => 'BlogSeeder'));

        $categories = BlogCategory::all();

        foreach (self::CATEGORIES_DESCRIPTION as $name => $description) {
            $category = $categories->firstWhere('name', $name);

            if ($category) {
                $category->update([
                    'description' => $description
                ]);
            } else {
                $newCategory = BlogCategory::create([
                    'name' => $name,
                    'description' => $description,
                    'preview_image_key' => 'demo-files/fortnite-min.jpg'
                ]);
                BlogCategorySlug::create([
                    'blog_category_id' => $newCategory->id,
                    'slug' => 'category-' . $newCategory->id,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        BlogCategory::whereIn('name', array_keys(self::CATEGORIES_DESCRIPTION))->get()->each(function ($bc) {
            $bc->update(['description' => null]);
        });
    }
}
