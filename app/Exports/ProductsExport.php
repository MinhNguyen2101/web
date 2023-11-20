<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductsExport implements FromView, WithDrawings
{
    public function view(): View
    {
        return view('admin.product.export', [
            'products' => Product::all(),
        ]);
    }

    public function drawings()
    {
        $drawings = [];

        foreach (Product::all() as $product) {
            $imagePath = public_path("storage/{$product->image}");

            if (file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setName($product->name)
                        ->setDescription($product->name)
                        ->setPath($imagePath)
                        ->setHeight(60)
                        ->setWidth(60)
                        ->setCoordinates('C' . ($product->id + 1)); // Assuming 'C' is the column for images

                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
