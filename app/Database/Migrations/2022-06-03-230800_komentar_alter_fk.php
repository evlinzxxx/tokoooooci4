<?php

namespace App\Database\Migrations;

class KomentarAlterFk extends \CodeIgniter\Database\Migration
{

    public function up()
    {

        $this->forge->dropForeignKey('tb_komentar', 'tb_komentar_id_barang_foreign');
        $this->forge->dropForeignKey('tb_komentar', 'tb_komentar_id_user_foreign');

        $this->forge->addColumn('tb_komentar', [
            'CONSTRAINT tb_komentar_id_user_foreign FOREIGN KEY(id_user) REFERENCES tb_user(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);

        $this->forge->addColumn('tb_komentar', [
            'CONSTRAINT tb_komentar_id_barang_foreign FOREIGN KEY(id_barang) REFERENCES tb_barang(id) ON DELETE NO ACTION ON UPDATE CASCADE',
        ]);
    }
    public function down()
    {
        $this->forge->addColumn('tb_komentar', [
            'CONSTRAINT tb_komentar_id_user_foreign FOREIGN KEY(id_user) REFERENCES tb_user(id)',
        ]);

        $this->forge->addColumn('tb_komentar', [
            'CONSTRAINT tb_komentar_id_barang_foreign FOREIGN KEY(id_barang) REFERENCES tb_barang(id)',
        ]);
    }
}