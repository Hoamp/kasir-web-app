<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'alex',
            'nama' => 'alex',
            'password' => bcrypt('alex'),
            'level' => 'admin',
        ]);
        User::create([
            'username' => 'baron',
            'nama' => 'baron',
            'password' => bcrypt('baron'),
            'level' => 'kasir',
        ]);

        Produk::create([
            'kode_produk' => 'S1010',
            'nama' => 'Sabun',
            'stok' => 10,
            'harga' => 10000
        ]);

        Pelanggan::create([
            'nama' => 'anis',
            'alamat' => 'wates',
            'telp' => '09091029',
        ]);
    }
}
