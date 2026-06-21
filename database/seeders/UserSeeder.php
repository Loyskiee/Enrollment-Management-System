<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
 
    [
        'name'       => 'Administrator',
        'email'      => 'admin@example.com',
        'password'   => bcrypt('password'),
        'role'       => 'admin',
        'status'     => 'approved',
    ],
 
    ['name' => 'Liam Santos',        'email' => 'liam.santos@example.com',        'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Mia Reyes',          'email' => 'mia.reyes@example.com',          'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Noah Cruz',          'email' => 'noah.cruz@example.com',          'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Olivia Garcia',      'email' => 'olivia.garcia@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Ethan Rivera',       'email' => 'ethan.rivera@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Ava Torres',         'email' => 'ava.torres@example.com',         'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'James Flores',       'email' => 'james.flores@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Sophia Morales',     'email' => 'sophia.morales@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'William Ramirez',    'email' => 'william.ramirez@example.com',    'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Isabella Ortiz',     'email' => 'isabella.ortiz@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Benjamin Perez',     'email' => 'benjamin.perez@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Emma Lopez',         'email' => 'emma.lopez@example.com',         'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Lucas Martinez',     'email' => 'lucas.martinez@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Charlotte Gonzalez', 'email' => 'charlotte.gonzalez@example.com', 'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Henry Wilson',       'email' => 'henry.wilson@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Amelia Anderson',    'email' => 'amelia.anderson@example.com',    'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Alexander Thomas',   'email' => 'alexander.thomas@example.com',   'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Harper Jackson',     'email' => 'harper.jackson@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Mason White',        'email' => 'mason.white@example.com',        'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Evelyn Harris',      'email' => 'evelyn.harris@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Logan Martin',       'email' => 'logan.martin@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Abigail Thompson',   'email' => 'abigail.thompson@example.com',   'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Elijah Garcia',      'email' => 'elijah.garcia@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Ella Martinez',      'email' => 'ella.martinez@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Oliver Robinson',    'email' => 'oliver.robinson@example.com',    'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Scarlett Clark',     'email' => 'scarlett.clark@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Jack Rodriguez',     'email' => 'jack.rodriguez@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Grace Lewis',        'email' => 'grace.lewis@example.com',        'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Aiden Lee',          'email' => 'aiden.lee@example.com',          'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Chloe Walker',       'email' => 'chloe.walker@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Sebastian Hall',     'email' => 'sebastian.hall@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Penelope Allen',     'email' => 'penelope.allen@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Carter Young',       'email' => 'carter.young@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Layla Hernandez',    'email' => 'layla.hernandez@example.com',    'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Wyatt King',         'email' => 'wyatt.king@example.com',         'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Riley Wright',       'email' => 'riley.wright@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Julian Scott',       'email' => 'julian.scott@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Zoey Green',         'email' => 'zoey.green@example.com',         'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Grayson Adams',      'email' => 'grayson.adams@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Nora Baker',         'email' => 'nora.baker@example.com',         'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Levi Gonzalez',      'email' => 'levi.gonzalez@example.com',      'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Lily Nelson',        'email' => 'lily.nelson@example.com',        'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Dylan Carter',       'email' => 'dylan.carter@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Eleanor Mitchell',   'email' => 'eleanor.mitchell@example.com',   'password' => bcrypt('password'), 'role' => 'student', 'status' => 'rejected', ],
    ['name' => 'Isaiah Perez',       'email' => 'isaiah.perez@example.com',       'password' => bcrypt('password'), 'role' => 'student', 'status' => 'pending',  ],
    ['name' => 'Hannah Roberts',     'email' => 'hannah.roberts@example.com',     'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
    ['name' => 'Ryan Turner',        'email' => 'ryan.turner@example.com',        'password' => bcrypt('password'), 'role' => 'student', 'status' => 'approved', ],
 
      ]);
    }
}
