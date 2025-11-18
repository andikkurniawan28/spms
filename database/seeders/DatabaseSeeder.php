<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Setup;
use App\Models\Client;
use App\Models\Gateway;
use App\Models\Complexity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Director'],
            ['name' => 'Tech'],
            ['name' => 'Finance'],
            ['name' => 'Marketing'],
        ]);
        $akses = Role::semua_akses();
        $updateData = [];
        foreach ($akses as $a) {
            $updateData[$a['id']] = 1;
        }
        Role::whereIn('id',[1])->update($updateData);

        User::insert([
            ['name' => 'Andik Kurniawan', 'username' => 'andik', 'password' => bcrypt('Qc_789456'), 'role_id' => 1],
        ]);

        Setup::insert([
            ['organization' => 'PT. Optima Teknologi Industri', 'director' => 'Andik Kurniawan', 'city' => 'Malang'],
        ]);

        Client::insert([
            [
                'prefix' => 'Pak',
                'fullname' => 'Sunardi Widodo',
                'nickname' => 'Nardi',
                'phone' => '6281328057311',
                'organization' => 'PT. GBM',
                'role' => 'Direktur',
                'role' => 'Direktur',
            ]
        ]);

        Complexity::insert([
            [
                'title' => 'CRUD Dasar',
                'description' => 'Membuat fitur CRUD sederhana untuk satu entitas tanpa relasi. Termasuk validasi dasar, form input, dan tampilan daftar data.',
                'default_price' => 300000,
                'default_duration' => 1.5,
            ],
            [
                'title' => 'CRUD dengan Relasi',
                'description' => 'CRUD dengan relasi antar tabel seperti One-to-Many atau Many-to-Many, termasuk form nested, eager loading, dan validasi kompleks.',
                'default_price' => 600000,
                'default_duration' => 3,
            ],
            [
                'title' => 'Integrasi API / Fitur Menengah',
                'description' => 'Fitur yang memerlukan integrasi API eksternal, pemetaan data, webhook, atau logika bisnis tingkat menengah.',
                'default_price' => 1200000,
                'default_duration' => 5,
            ],
            [
                'title' => 'Fitur Multi-Step atau Workflow',
                'description' => 'Proses multilangkah, workflow approval, manajemen state, dan validasi antar step/form.',
                'default_price' => 2000000,
                'default_duration' => 7,
            ],
            [
                'title' => 'Migrasi Database',
                'description' => 'Membuat atau memodifikasi struktur database, migrasi kolom, tabel, indexing, mengatur relasi baru, serta menjaga backward compatibility.',
                'default_price' => 1500000,
                'default_duration' => 3,
            ],
            [
                'title' => 'Normalisasi Database',
                'description' => 'Menormalisasi database dari struktur tidak optimal menjadi 1NF–3NF atau BCNF, termasuk refactor tabel, relasi, foreign key, dan penataan ulang data.',
                'default_price' => 2500000,
                'default_duration' => 5,
            ],
            [
                'title' => 'Refactor Schema & Optimasi Query',
                'description' => 'Perbaikan performance melalui indexing, refactor query berat, analisis EXPLAIN, caching, dan optimasi arsitektur database.',
                'default_price' => 3000000,
                'default_duration' => 7,
            ],
            [
                'title' => 'Integrasi Sistem Eksternal',
                'description' => 'Integrasi dengan sistem enterprise, sinkronisasi data real-time, queue job, scheduler, retry mechanism, dan audit log.',
                'default_price' => 3500000,
                'default_duration' => 12,
            ],
            [
                'title' => 'Data Migration / ETL',
                'description' => 'Migrasi data dari sistem lama ke sistem baru, transformasi data, pembersihan data, verifikasi konsistensi, dan proses import skala besar.',
                'default_price' => 4000000,
                'default_duration' => 10,
            ],
            [
                'title' => 'Arsitektur Kompleks / Enterprise Feature',
                'description' => 'Pembuatan modul kompleks berbasis domain-driven design, microservices, event sourcing, atau integrasi antar banyak subsistem besar.',
                'default_price' => 6000000,
                'default_duration' => 21,
            ],

            // ==== VIEW / TEMPLATE RELATED ====

            [
                'title' => 'Template Pihak Ketiga – Minimal Custom',
                'description' => 'Menggunakan template UI pihak ketiga seperti AdminLTE, SB Admin, atau Bootstrap Template dengan perubahan kecil seperti warna, logo, dan sedikit modifikasi layout.',
                'default_price' => 300000,
                'default_duration' => 1.5,
            ],
            [
                'title' => 'Template Pihak Ketiga – Custom Sedang/Berat',
                'description' => 'Menggunakan template UI pihak ketiga namun dengan modifikasi signifikan seperti perubahan struktur layout, penambahan komponen baru, atau perubahan style besar.',
                'default_price' => 800000,
                'default_duration' => 3,
            ],
            [
                'title' => 'Template View Custom dari Awal',
                'description' => 'Mendesain dan membangun tampilan frontend dari nol tanpa template pihak ketiga, termasuk layout, komponen UI, responsive design, dan custom styling.',
                'default_price' => 1500000,
                'default_duration' => 5,
            ],
        ]);

        Gateway::insert([
            ['name' => 'Cash'],
            ['name' => 'BNI 967619748 a/n Andik Kurniawan'],
            ['name' => 'BCA 123-115-3361 a/n Andik Kurniawan'],
            ['name' => 'BRI 0051-0129-2762-502 a/n Andik Kurniawan'],
            ['name' => 'ShopeePay 085733465399 a/n Andik Kurniawan'],
            ['name' => 'GoPay 085733465399 a/n Andik Kurniawan'],
        ]);
    }
}
