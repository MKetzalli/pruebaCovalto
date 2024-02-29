<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cocktails extends Migration
{
    public function up()
    {
        //creara la tabla cocktails en la bd
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'idDrink' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],

            'strDrink' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'strCategory' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'strAlcoholic' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'strGlass' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'strInstructions' => [
                'type' => 'TINYTEXT',
            ],
            //
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cocktails');
    }


    public function down()
    {
        //eliminara la tabla cocktails de la bd
        $this->forge->dropTable('cocktails');
    }
}
