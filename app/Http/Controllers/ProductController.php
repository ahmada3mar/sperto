<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class ProductController extends Controller
{
    // Define how many products per page
    const PRODUCTS_PER_PAGE = 20;

    /**
     * Helper method to load all products from products.json.
     * In a real application, this would come from a database.
     *
     * @return array
     */
    public function loadAllProducts(): array
    {
        // Ensure products.json exists in storage/app/public/
        if (Storage::disk('public')->exists('products.json')) {
            $data = json_decode(Storage::disk('public')->get('products.json'), true);
            // Assuming the JSON structure has a 'products' key
            return $data['products'] ?? [];
        }
        return []; // Return empty array if file not found
    }

    /**
     * Display a listing of the products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allProducts = $this->loadAllProducts();
        $totalProducts = count($allProducts);

        // Initial load for the Blade view
        $products = array_slice($allProducts, 0, self::PRODUCTS_PER_PAGE);

        return view('products.index', [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'productsPerPage' => self::PRODUCTS_PER_PAGE
        ]);
    }

    /**
     * API endpoint to get paginated products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedProducts(Request $request)
    {
        $allProducts = $this->loadAllProducts();
        $totalProducts = count($allProducts);

        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', self::PRODUCTS_PER_PAGE);

        $products = array_slice($allProducts, $offset, $limit);

        // dd($products);
        sleep(1); // Simulate a delay for the API response

        return response()->json([
            'products' => $products,
            'total_products' => $totalProducts,
            'current_offset' => (int)$offset + count($products)
        ]);
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $allProducts = $this->loadAllProducts();
        $product = collect($allProducts)->firstWhere('id', $id);

        if (!$product) {
            abort(404); // Or redirect to a 404 page
        }

        return view('products.show', ['product' => $product]);
    }
}
