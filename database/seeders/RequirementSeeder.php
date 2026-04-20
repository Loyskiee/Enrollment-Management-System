<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requirement;

class RequirementSeeder extends Seeder
{
    /**     
     *  
     * Requirements:
     * Grade 11 Card
     *  Grade 12 Card
     * Good Moral
     * PSA Birth Cert
     * 2pcs. of 2x2 Picture (White background, collared shirt, with name tag)
     */
    public function run(): void
    {
        $requirements = [
            ['name' => 'Grade 11 Card', 'description' => 'Grade 11 Card', 'is_required' => true],
            ['name' => 'Grade 12 Card', 'description' => 'Grade 12 Card', 'is_required' => true],
            ['name' => 'Good Moral', 'description' => 'Good Moral', 'is_required' => true],
            ['name' => 'PSA Birth Certificate', 'description' => 'Birth Certificate', 'is_required' => true],
            ['name' => '2x2 picture with white background', 'description' => '2x2 picture', 'is_required' => true]
        ];
            
        foreach ($requirements as $requirement) {
             Requirement::firstOrCreate(['name' => $requirement['name']], $requirement);
        }
    }
}
