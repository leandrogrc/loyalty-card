<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Client;
use App\Models\LoyaltyCard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\VisitController;
use App\Models\Establishment;
use Illuminate\Http\Request;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = collect();
        for ($i = 0; $i < 2; $i++) {
            $users->push(User::create([
                'name' => "User $i",
                'email' => "user$i@email.com",
                'password' => Hash::make('123456'),
            ]));
        }

        // Criar estabelecimentos
        $establishments = collect();
        foreach (range(1, 5) as $i) {
            $establishments->push(Establishment::create([
                'establishment_name' => 'Establishment ' . $i,
                'owner_id' => rand(1, 2),
            ]));
        }

        // Criar 5 clientes e associar ao primeiro user
        $clients = collect();
        for ($i = 0; $i < 5; $i++) {
            $clients->push(Client::create([
                'name' => "Client $i",
                'email' => "client$i@email.com",
            ]));
        }

        // Criar 5 loyalty cards (1 para cada cliente)
        $cards = collect();
        foreach ($clients as $client) {
            $cards->push(LoyaltyCard::create([
                'client_id' => $client->id,
                'establishment_id' => $establishments->random()->id,
                'paid_visits' => 0,
                'total_visits_required' => 4,
                'rewards_claimed' => 0,
            ]));
        }


        // Criar 20 visitas aleatórias
        $visit_controller = new VisitController();
        foreach (range(1, 50) as $i) {
            $random_num = rand(1, 5);
            $request = new Request([
                'service_date' => now()->subDays(rand(1, 100))->toDateString(),
                'loyalty_card_id' => $establishments->random()->id,
                'establishment_id' => rand(1, 2),
                'client_id' => $random_num,
            ]);
            $visit_controller->store($request);
        }
    }
}
