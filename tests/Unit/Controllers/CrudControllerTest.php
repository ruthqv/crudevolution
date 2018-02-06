<?php

namespace  Tests\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Api\CrudController;
use App\Crud;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class CrudControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReturnFeedTest()
    {

        $this->get(route('crud.index'))
             ->assertJsonStructure([
                 '*' => [
                     '_id', 'name', 'industry', 
                 ]
             ]);

    }

    public function testCreateItemTest()
    {

        $this->post(route('crud.store') ,['_id' => 1, 'name' => 'foocreate' , 'industry' =>'foo-create' , 'years' => ['2000'=> 'a']])
            ->assertJsonStructure([
                 '*' => [
                     '_id', 'name', 'industry', 'years'
                 ]
             ]);     

    }

    public function testDeleteItemTest()
    {
        $crudremaind = Crud::create([ '_id' => 1 ,'name' => 'foodestroyremaind' , 'industry' =>'foo-inddestroyremaind']);

        $crud = Crud::create([ '_id' => 2 ,'name' => 'foodestroy' , 'industry' =>'foo-inddestroy']);

        $this->delete(route('crud.destroy' , [$crud] ))
            ->assertJsonFragment ([
                'name' => 'foodestroyremaind'
             ])
            ->assertJsonMissingExact([
                'name' => 'foodestroy'
             ]);
            
    }

    public function testUpdateItemTest()
    {

            $crud = Crud::create([ '_id' => 2 ,'name' => 'foocreated' , 'industry' =>'foo-created']);


            $data = [
                '_id' => $crud->id,
                'name' => 'Updated Name',
                'industry' => 'updated industry'
            ];

            $this->put(route('crud.update', $data) )
            ->assertJsonFragment ([
                'name' => 'Updated Name'
             ])
            ->assertJsonMissingExact([
                'name' => 'foocreated'
             ]);

    }        
}
