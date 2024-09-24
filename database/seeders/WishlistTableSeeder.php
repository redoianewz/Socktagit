<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;


class WishlistTableSeeder extends Seeder
{

    public array $wishlists = [
        [
            'user'    => 1,
            'product' => [1, 2, 3, 4, 5, 9, 10, 12, 14, 15],
        ],
        [
            'user'    => 2,
            'product' => [5, 7, 9, 11, 15, 16, 17],
        ],
        [
            'user'    => 3,
            'product' => [7, 12, 23, 24, 35, 36],
        ],
        [
            'user'    => 4,
            'product' => [41],
        ],
        [
            'user'    => 5,
            'product' => [20, 23, 32, 44],
        ],
        [
            'user'    => 6,
            'product' => [1, 12, 23, 34],
        ],
        [
            'user'    => 7,
            'product' => [5, 10, 13, 44],
        ],
        [
            'user'    => 8,
            'product' => [2, 5, 32, 41],
        ],
        [
            'user'    => 9,
            'product' => [14, 21, 31, 44],
        ],
    ];


    public function run()
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO') && $envService->getValue('DISPLAY') == 'fashion') {
            foreach ($this->wishlists as $wishlist) {
                foreach ($wishlist['product'] as $product) {
                    Wishlist::create([
                        'user_id'    => $wishlist['user'],
                        'product_id' => $product,
                    ]);
                }
            }
        }
    }
}
