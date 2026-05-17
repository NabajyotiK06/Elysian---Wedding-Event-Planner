<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::truncate();

        Vendor::create([
            'name' => 'The Grand Plaza',
            'type' => 'Venue',
            'location' => 'New York, NY',
            'price' => 15000,
            'rating' => 4.9,
            'description' => 'A luxurious ballroom with crystal chandeliers and panoramic city views.',
            'image_url' => 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&q=80&w=800'
        ]);

        Vendor::create([
            'name' => 'Elegance Catering',
            'type' => 'Catering',
            'location' => 'New York, NY',
            'price' => 5000,
            'rating' => 4.8,
            'description' => 'Gourmet fine dining tailored to your specific dietary needs and event theme.',
            'image_url' => 'https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&q=80&w=800'
        ]);

        Vendor::create([
            'name' => 'Timeless Captures',
            'type' => 'Photography',
            'location' => 'Brooklyn, NY',
            'price' => 3500,
            'rating' => 5.0,
            'description' => 'Award-winning photography capturing the authentic, candid moments of your special day.',
            'image_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800'
        ]);

        Vendor::create([
            'name' => 'Blossom & Bloom',
            'type' => 'Florist',
            'location' => 'Queens, NY',
            'price' => 2000,
            'rating' => 4.7,
            'description' => 'Bespoke floral arrangements using locally sourced, seasonal blooms.',
            'image_url' => 'https://picsum.photos/seed/flowers123/800/600'
        ]);

        Vendor::create([
            'name' => 'Sunset Sounds DJ',
            'type' => 'Music',
            'location' => 'New York, NY',
            'price' => 1500,
            'rating' => 4.6,
            'description' => 'Keeping the dance floor packed all night with seamless mixes and incredible energy.',
            'image_url' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&q=80&w=800'
        ]);
        
        Vendor::create([
            'name' => 'Rustic Barn Estate',
            'type' => 'Venue',
            'location' => 'Upstate NY',
            'price' => 12000,
            'rating' => 4.8,
            'description' => 'A beautifully restored 19th-century barn perfect for vintage and rustic style weddings.',
            'image_url' => 'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?auto=format&fit=crop&q=80&w=800'
        ]);
    }
}
