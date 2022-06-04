<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $register = [
        'username' => [
            'rules' => 'required|min_length[8]',
        ],
        'password' => [
            'rules' => 'required',
        ],
        'password2' => [
            'rules' => 'required|matches[password]',
        ]
    ];


    public $register_errors = [
        'username' => [
            'required' => 'Username Harus Diisi!',
            'min_length' => 'Username Minimal 8 karakter'
        ],
        'password' => [
            'required' => 'Password Harus Diisi!',
        ],
        'password2' => [
            'required' => 'Password Harus Diisi!',
            'matches' => 'Password Tidak Sama'
        ]
    ];

    public $transaksi = [
        'id_barang' => [
            'rules' => 'required',
        ],
        'id_pembeli' => [
            'rules' => 'required',
        ],
        'jumlah' => [
            'rules' => 'required',
        ],
        'total_harga' => [
            'rules' => 'required',
        ],
        'alamat' => [
            'rules' => 'required',
        ],
        'ongkir' => [
            'rules' => 'required',
        ]
    ];

    public $keranjang = [
        'id_barang' => [
            'rules' => 'required',
        ],
        'id_pembeli' => [
            'rules' => 'required',
        ],
        'jumlah' => [
            'rules' => 'required',
        ],
        'total_harga' => [
            'rules' => 'required',
        ],
        'alamat' => [
            'rules' => 'required',
        ],
        'ongkir' => [
            'rules' => 'required',
        ]
    ];

    public $login = [
        'username' => [
            'rules' => 'required|min_length[8]',
        ],
        'password' => [
            'rules' => 'required',
        ]
    ];

    public $login_errors = [
        'username' => [
            'required' => 'Username Harus Diisi!',
            'min_length' => 'Username Minimal 8 karakter'
        ],
        'password' => [
            'required' => '{field} Password Harus Diisi!',
        ]
    ];

    public $barang = [
        'nama' => [
            'rules' => 'required|min_length[5]',
        ],
        'harga' => [
            'rules' => 'required|is_natural',
        ],
        'stok' => [
            'rules' => 'required|is_natural',
        ],
        'deskripsi' => [
            'rules' => 'required|min_length[20]',
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]',
        ]
    ];

    public $barang_errors = [
        'nama' => [
            'required' => 'Nama Barang harus diisi',
            'min_length' => 'Nama Barang minimal 5 karakter'
        ],
        'harga' => [
            'required' => 'Harga Barang harus diisi',
            'is_natural' => 'Harga Barang Tidak Boleh Negatif'
        ],
        'stok' => [
            'required' => 'Stok Barang harus diisi',
            'is_natural' => 'Stok Barang Tidak Boleh Negatif'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi Barang harus diisi',
            'min_length' => 'NDeskripsi Barang minimal 20 karakter'
        ],
        'gambar' => [
            'uploaded' => 'Gambar Barang harus diupload',
        ]
    ];

    public $barangupdate = [
        'nama' => [
            'rules' => 'required|min_length[5]',
        ],
        'harga' => [
            'rules' => 'required|is_natural',
        ],
        'stok' => [
            'rules' => 'required|is_natural',
        ]
    ];

    public $barangupdate_errors = [
        'nama' => [
            'required' => 'Nama Barang harus diisi',
            'min_length' => 'Nama Barang minimal 5 karakter'
        ],
        'harga' => [
            'required' => 'Harga Barang harus diisi',
            'is_natural' => 'Harga Barang Tidak Boleh Negatif'
        ],
        'stok' => [
            'required' => 'Stok Barang harus diisi',
            'is_natural' => 'Stok Barang Tidak Boleh Negatif'
        ]
    ];

    public $komentar = [
        'komentar' => [
            'rules' => 'required'
        ]
    ];
}
