<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // 1. Users
        $admin = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@nikel.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);
        $supervisor = \App\Models\User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@nikel.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'supervisor',
        ]);
        $manager = \App\Models\User::create([
            'name' => 'Manager User',
            'email' => 'manager@nikel.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'manager',
        ]);

        $employees = [];
        for ($i = 0; $i < 10; $i++) {
            $employees[] = \App\Models\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => $faker->randomElement(['supervisor', 'manager']),
            ]);
        }
        
        // 2. Locations
        $locations = [];
        $locations[] = \App\Models\Location::create(['name' => 'Kantor Pusat', 'type' => 'head_office', 'region' => 'Jakarta']);
        $locations[] = \App\Models\Location::create(['name' => 'Kantor Cabang', 'type' => 'branch_office', 'region' => 'Makassar']);
        for ($i = 1; $i <= 5; $i++) {
            $locations[] = \App\Models\Location::create(['name' => "Site Tambang $i", 'type' => 'mine', 'region' => 'Sulawesi Tenggara']);
        }

        // 3. Drivers
        $drivers = [];
        for ($i = 0; $i < 20; $i++) {
            $drivers[] = \App\Models\Driver::create([
                'name' => $faker->name('male'),
                'phone' => $faker->phoneNumber,
            ]);
        }

        // 4. Vehicles
        $vehicles = [];
        $vehicleTypes = ['personnel', 'cargo'];
        $ownerships = ['company', 'rented'];
        $models = ['Toyota Hilux', 'Mitsubishi Triton', 'Toyota Innova', 'Mitsubishi Fuso', 'Hino Ranger', 'Toyota Avanza'];
        
        for ($i = 0; $i < 30; $i++) {
            $vehicles[] = \App\Models\Vehicle::create([
                'model' => $faker->randomElement($models), 
                'plate_number' => 'B ' . $faker->numberBetween(1000, 9999) . ' ' . strtoupper($faker->lexify('??')), 
                'type' => $faker->randomElement($vehicleTypes), 
                'ownership' => $faker->randomElement($ownerships), 
                'status' => 'available',
                'fuel_ratio' => $faker->randomFloat(2, 6, 15), // Antara 6.00 s/d 15.00 km/liter
                'location_id' => $faker->randomElement($locations)->id
            ]);
        }

        // 5. Bookings, Approvals & Usage Logs
        $bookingStatuses = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];
        
        for ($i = 0; $i < 100; $i++) {
            $status = $faker->randomElement($bookingStatuses);
            
            // Generate dates in the past 3 months
            $startTime = $faker->dateTimeBetween('-3 months', 'now');
            $endTime = (clone $startTime)->modify('+' . $faker->numberBetween(1, 48) . ' hours');

            $booking = \App\Models\Booking::create([
                'user_id' => $faker->randomElement($employees)->id,
                'vehicle_id' => $faker->randomElement($vehicles)->id,
                'driver_id' => $faker->randomElement($drivers)->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'reason' => $faker->sentence(),
                'status' => $status,
                'distance_km' => ($status === 'completed') ? $faker->randomNumber(3, true) : null,
            ]);

            // If approved or completed, usually has approvals
            if (in_array($status, ['approved', 'completed'])) {
                \App\Models\Approval::create([
                    'booking_id' => $booking->id,
                    'user_id' => $supervisor->id,
                    'level' => 1,
                    'status' => 'approved',
                ]);
                
                \App\Models\Approval::create([
                    'booking_id' => $booking->id,
                    'user_id' => $manager->id,
                    'level' => 2,
                    'status' => 'approved',
                ]);
                
                // If completed, add usage log based on distance mapping
                if ($status === 'completed' && $booking->distance_km) {
                    $vehicle = \App\Models\Vehicle::find($booking->vehicle_id);
                    $fuelConsumed = $booking->distance_km / $vehicle->fuel_ratio;
                    
                    \App\Models\UsageLog::create([
                        'booking_id' => $booking->id,
                        'vehicle_id' => $vehicle->id,
                        'distance_km' => $booking->distance_km,
                        'date' => clone $booking->end_time,
                        'fuel_consumed' => round($fuelConsumed, 2),
                    ]);
                }
            } elseif ($status === 'rejected') {
                \App\Models\Approval::create([
                    'booking_id' => $booking->id,
                    'user_id' => $supervisor->id,
                    'level' => 1,
                    'status' => 'rejected',
                ]);
            }
        }

        // 6. Service Logs
        for ($i = 0; $i < 30; $i++) {
            $vehicle = $faker->randomElement($vehicles);
            \App\Models\ServiceLog::create([
                'vehicle_id' => $vehicle->id,
                'service_date' => $faker->dateTimeBetween('-6 months', 'now'),
                'description' => $faker->randomElement(['Ganti Oli & Filter', 'Service Rutin 10.000 KM', 'Ganti Ban', 'Perbaikan Rem', 'Tune Up', 'Ganti Aki']),
                'cost' => $faker->numberBetween(500000, 5000000),
            ]);
        }
    }
}
