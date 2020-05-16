<?php

use Illuminate\Database\Seeder;
use station\User;
use station\Node;
use station\Sensor;
use station\Station;
use station\NodeStatus;
use station\NodeStatusConfiguration;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
<<<<<<< HEAD
        factory(station\User::class, 50)->create();

=======
        factory(User::class, 50)->create();

        // factory(Station::class, 5)->create()->each(function($station)
        // {

        // $station->nodes()->saveMany(
        //     factory(Node::class, 5)->create()->each(function($node)
        //     {
        //         // With dummy questions
        //         $node->sensors()->saveMany(factory(Sensor::class, 4)
        //         ->create(['node_id' => $node->node_id])->each(function($sensor)
        //         {
        //             // With dummy tags
        //         // $question->tags()->sync(array_random($tagIds, mt_rand(1, 5)));
        //         }));
        //     })
        // );


        $stations = factory(Station::class,5)->create();
        foreach( $stations as $station)
        {
            //factory(Node::class,5)->create(['station_id' => $station->station_id]);
            $nodes=$station->nodes()->saveMany(factory(Node::class, 3)->make()); 
            foreach($nodes as $node){
                $sensors=$node->sensors()->saveMany(factory(Sensor::class, 5)->make()); 
            }  
        }
    
        
        
>>>>>>> b838b37bc10a9bd92782f5e0213406537638fa83
    }
}
