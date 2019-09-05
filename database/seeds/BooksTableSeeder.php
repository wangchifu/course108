<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Book::truncate(); //清空資料庫

        $subjects = [
            'mandarin',
            'dialects',
            'english',
            'mathematics',
            'life_curriculum',
            'social_studies',
            'science_technology',
            'science',
            'arts_humanities',
            'integrative_activities',
            'technology',
            'health_physical',
        ];
        $books = ['自編','康軒','南一','翰林'];
        foreach($subjects as $v1){
            foreach($books as $v2){
                \App\Book::create([
                    'subject' => $v1,
                    'name' => $v2,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);
            }
        }
    }
}
