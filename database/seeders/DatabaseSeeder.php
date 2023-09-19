<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'isAdmin' => true,
                'email' => 'admin@gmail.com',
                'firstName' => 'andry',
                'lastName' => 'grishchnko',
                'password' => bcrypt('admin')
            ]
        );
        DB::table('users')->insert(
            [
                'isAdmin' => false,
                'email' => 'author@gmail.com',
                'firstName' => 'Joan',
                'lastName' => 'Rouling',
                'password' => bcrypt('author')
            ]
        );
        DB::table('users')->insert(
            [
                'isAdmin' => false,
                'email' => 'author2@gmail.com',
                'firstName' => 'Joan2',
                'lastName' => 'Rouling2',
                'password' => bcrypt('author')
            ]
        );

        DB::table('books')->insert(
            [
                'user_id' => '2',
                'title' => 'Harry Potter',
                'edition_type' => 'графическое издание'
            ]
        );
        DB::table('books')->insert(
            [
                'user_id' => '2',
                'title' => 'The Withcer',
                'edition_type' => 'цифровое издание'
            ]
        );
        DB::table('books')->insert(
            [
                'user_id' => '2',
                'title' => 'Eugene Onegin',
                'edition_type' => 'графическое издание'
            ]
        );

        DB::table('genres')->insert(
            [
                'name' => 'Fantasy',
                'description' => 'Genre Fantasy'
            ]
        );
        DB::table('genres')->insert(
            [
                'name' => 'Biography',
                'description' => 'Genre Biography'
            ]
        );
        DB::table('genres')->insert(
            [
                'name' => 'Drama',
                'description' => 'Genre Drama'
            ]
        );
        DB::table('genres')->insert(
            [
                'name' => 'Romance',
                'description' => 'Genre Romance'
            ]
        );
        DB::table('genres')->insert(
            [
                'name' => 'Horror',
                'description' => 'Genre Horror'
            ]

        );
        DB::table('book_genre')->insert([
            'book_id' => '1',
            'genre_id' => '1',
        ]);
        DB::table('book_genre')->insert([
            'book_id' => '1',
            'genre_id' => '2',
        ]);
        DB::table('book_genre')->insert([
            'book_id' => '1',
            'genre_id' => '3',
        ]);
        DB::table('book_genre')->insert([
            'book_id' => '2',
            'genre_id' => '4',
        ]);
        DB::table('book_genre')->insert([
            'book_id' => '2',
            'genre_id' => '5',
        ]);      
        DB::table('book_genre')->insert([
            'book_id' => '3',
            'genre_id' => '4',
        ]);      
    }
}
