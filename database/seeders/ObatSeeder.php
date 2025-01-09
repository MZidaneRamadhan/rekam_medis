<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $obatNames = [
            'Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Cefadroxil', 'Omeprazole',
            'Cetirizine', 'Diphenhydramine', 'Furosemide', 'Lisinopril', 'Metformin',
            'Atorvastatin', 'Amlodipine', 'Prednisone', 'Insulin', 'Aspirin',
            'Fluoxetine', 'Losartan', 'Carbamazepine', 'Gabapentin', 'Chlorpheniramine',
            'Salbutamol', 'Montelukast', 'Ranitidine', 'Clonazepam', 'Lorazepam',
            'Simvastatin', 'Enalapril', 'Captopril', 'Diazepam', 'Chloroquine',
            'Hydroxychloroquine', 'Methotrexate', 'Fluticasone', 'Hydrocodone',
            'Codeine', 'Tramadol', 'Levodopa', 'Buspirone', 'Doxycycline',
            'Tamsulosin', 'Losartan', 'Ciprofloxacin', 'Vitamind D3', 'Benzonatate',
            'Guaifenesin', 'Miconazole', 'Loratadine', 'Zolpidem', 'Fentanyl',
            'Prednisolone', 'Sildenafil', 'Tadalafil', 'Albuterol', 'Naproxen',
            'Risperidone', 'Carvedilol', 'Valproic acid', 'Ranitidine', 'Fluconazole',
            'Metoprolol', 'Paroxetine', 'Warfarin', 'Lisinopril', 'Citalopram',
            'Terbinafine', 'Rivaroxaban', 'Famotidine', 'Meloxicam', 'Acetaminophen',
            'Bupropion', 'Methylprednisolone', 'Benzodiazepine', 'Erythromycin',
            'Clarithromycin', 'Levofloxacin', 'Prednisone', 'Fexofenadine', 'Propranolol',
            'Amlodipine', 'Zithromax', 'Mupirocin', 'Fluoxetine', 'Hydrocortisone',
            'Azithromycin', 'Diphenhydramine', 'Piperacillin', 'Ceftriaxone', 'Oxycodone'
        ];

        foreach ($obatNames as $namaObat) {
            $data[] = [
                'nama_obat' => $namaObat,
                'jumlah_obat' => $faker->numberBetween(20, 200),
                'harga' => $faker->numberBetween(5000, 20000),
            ];
        }

        // Insert all data into the database
        DB::table('obat')->insert($data);
    }
}
