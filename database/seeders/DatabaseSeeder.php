<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        
        // cara gunakan seeder
        User::create([
                'name'      => 'awen',
                'username'  => 'awenese',
                'email'     => 'awen@gmail.com',
                'password'  => bcrypt('123456')
            ]);

        User::factory(3)->create();
        Category::factory(30)->create();
        // Category::create([
        //     'name'  => 'web programming',
        //     'slug'  => 'web-programming'
        // ]);
        // Category::create([
        //     'name'  => 'personal',
        //     'slug'  => 'personal'
        // ]);
        // Category::create([
        //     'name'  => 'design kreative',
        //     'slug'  => 'design-kreative'
        // ]);
        Post::factory(20)->create();

        // Post::create([
        //     'title'         => 'judul ketiga',
        //     'slug'          => 'judul-ketiga',
        //     'excerpt'       => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae perspiciatis voluptatum reprehenderit illo vel quos, exercitationem, a at provident sequi hic fuga laudantium eveniet! Quod officiis, nam magni distinctio voluptas, reprehenderit accusantium fugit incidunt aliquid neque modi, numquam dolores sunt cum? Dignissimos alias.',
        //     'body'          => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae perspiciatis voluptatum reprehenderit illo vel quos, exercitationem, a at provident sequi hic fuga laudantium eveniet! Quod officiis, nam magni distinctio voluptas, reprehenderit accusantium fugit incidunt aliquid neque modi, numquam dolores sunt cum? Dignissimos alias. totam distinctio hic vel illo officiis sint sapiente labore fugiat quia sequi fugit debitis, omnis quod quaerat nobis atque voluptatibus quos. Omnis voluptatem laborum doloremque amet incidunt ducimus architecto quibusdam eum rerum officiis fugiat recusandae excepturi minima fuga, commodi nesciunt! Quos molestias consequuntur tempore sed corrupti nam ratione natus quam odio voluptas hic, voluptatem, voluptatibus est fuga!',
        //     'category_id'   =>  2,
        //     'user_id'       =>  2
        // ]);
    }
}