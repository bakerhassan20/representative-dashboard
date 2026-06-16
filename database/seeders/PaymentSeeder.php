<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Client;
use Faker\Factory as Faker;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $clients = Client::all();

        foreach ($clients as $client) {

            // كل عميل له 1 إلى 3 مدفوعات
            $paymentsCount = rand(1, 3);

            for ($i = 0; $i < $paymentsCount; $i++) {

                $total = $faker->numberBetween(500, 5000);
                $paid  = $faker->numberBetween(0, $total);

                $status = 'pending';

                if ($paid == 0) {
                    $status = 'pending';
                } elseif ($paid < $total) {
                    $status = 'partial';
                } else {
                    $status = 'paid';
                }

                Payment::create([
                    'client_id'        => $client->id,
                    'amount' => $total,
                    'paid_amount'      => $paid,
                    'remaining_amount' => $total - $paid,
                    'status'           => $status,
                    'payment_date'     => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}