<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Custom movie data
        $movies = [
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'release_date' => '1994-09-23',
                'poster_url' => 'https://m.media-amazon.com/images/I/51NiGlapXlL._AC_.jpg',
                'age_rating' => '20',
                'ticket_price' => 50000,
            ],
            [
                'title' => 'The Matrix',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'release_date' => '1994-09-23',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg',
                'age_rating' => '13',
                'ticket_price' => 45000,
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.',
                'release_date' => '1994-07-06',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg',
                'age_rating' => '13',
                'ticket_price' => 45000,
            ],
            [
                'title' => 'The Godfather 2',
                'description' => 'The early life and career of Vito Corleone in 1920s New York is portrayed while his son, Michael, expands and tightens his grip on the family crime syndicate.',
                'release_date' => '1974-12-20',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/bptfVGEQuv6vDTIMVCHjJ9Dz8PX.jpg',
                'age_rating' => '18',
                'ticket_price' => 55000,
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.',
                'release_date' => '2010-07-16',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
                'age_rating' => '13',
                'ticket_price' => 60000,
            ],
            [
                'title' => 'Avengers: Endgame',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.',
                'release_date' => '2017-07-16',
                'poster_url' => 'https://image.tmdb.org/t/p/w500/bvYjhsbxOBwpm8xLE5BhdA3a8CZ.jpg',
                'age_rating' => '13',
                'ticket_price' => 60000,
            ],
            [
                'title' => 'Alien: Romulus',
                'description' => 'Set between the events of Alien (1979) and Aliens (1986), the story concerns a group of young space colonists who, while scavenging a derelict space station, come face to face with the most terrifying life form in space.',
                'release_date' => '2024-06-05',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_.jpg',
                'age_rating' => '13',
                'ticket_price' => 50000,
            ],
        ];

        // Insert data into the database
        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
