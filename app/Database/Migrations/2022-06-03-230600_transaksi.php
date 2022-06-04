<?php

namespace App\Database\Migrations;


class Transaksi extends \CodeIgniter\Database\Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'id_pembeli' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'total_harga' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_date' => [
                'type' => 'DATETIME'
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ],
            'updated_date' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_pembeli', 'tb_user', 'id', TRUE);
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id', TRUE);
        $this->forge->createTable('tb_transaksi');
    }
    public function down()
    {
        $this->forge->dropTable('tb_transaksi');
    }
}