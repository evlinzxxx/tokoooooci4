<?php

namespace App\Database\Migrations;

class TransaksiAlterFk extends \CodeIgniter\Database\Migration
{

    public function up()
    {

        $this->forge->dropForeignKey('tb_transaksi', 'tb_transaksi_id_barang_foreign');
        $this->forge->dropForeignKey('tb_transaksi', 'tb_transaksi_id_pembeli_foreign');

        $this->forge->addColumn('tb_transaksi', [
            'CONSTRAINT tb_transaksi_id_pembeli_foreign FOREIGN KEY(id_pembeli) REFERENCES tb_user(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);

        $this->forge->addColumn('tb_transaksi', [
            'CONSTRAINT tb_transaksi_id_barang_foreign FOREIGN KEY(id_barang) REFERENCES tb_barang(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);
    }
    public function down()
    {
        $this->forge->addColumn('tb_transaksi', [
            'CONSTRAINT tb_transaksi_id_pembeli_foreign FOREIGN KEY(id_pembeli) REFERENCES tb_user(id)',
        ]);

        $this->forge->addColumn('tb_transaksi', [
            'CONSTRAINT tb_transaksi_id_barang_foreign FOREIGN KEY(id_barang) REFERENCES tb_barang(id)',
        ]);
    }
}
