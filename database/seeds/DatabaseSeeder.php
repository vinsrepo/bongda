<?php

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
        // $this->call(UsersTableSeeder::class);
        if ($this->command->confirm('Ban co muon lam moi data, du lieu cu se bi xoa ?')) {

            $this->command->call('migrate:refresh');

            $this->command->warn("Da xoa du lieu, bat dau tu du lieu trong.");
        }

        $numberOfUser = (int)$this->command->ask('Ban can bao nhieu nguoi dung ?', 20);

        factory(\App\Models\User::class, $numberOfUser)->create();

        $numberOfCategoryNews = (int)$this->command->ask('Ban can bao nhieu danh muc tin tuc ?', 5);

        factory(\App\Models\CategoryNews::class, $numberOfCategoryNews)->create()
            ->each(function ($categoryNews) {
                for ($i = 0; $i < 5; $i++) {
                    $news = factory(\App\Models\News::class)->create(['category_id' => $categoryNews->id]);
                }
            });

        $this->command->warn("Da tao xong!");
    }
}
