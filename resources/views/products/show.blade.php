<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 text-gray-800 min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700 mb-2">👁️ Detail Produk</h1>
        <nav class="text-sm">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Produk</a>
            <span class="text-gray-500"> / {{ $product->title }}</span>
        </nav>
    </div>

    <!-- Product Detail -->
    <div class="bg-white rounded-2xl p-8 shadow-lg">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Image Section -->
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-80 object-cover rounded-lg shadow-md" alt="{{ $product->title }}"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMyMCIgdmlld0JveD0iMCAwIDQwMCAzMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzIwIiBmaWxsPSIjRjNGNEY2Ii8+Cjx0ZXh0IHg9IjIwMCIgeT0iMTYwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjOUNBM0FGIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTgiPvCfk6YgR2FtYmFyIFRpZGFrIERpdGVtdWthbjwvdGV4dD4KPC9zdmc+Cg==';">
                @else
                    <div class="w-full h-80 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-gray-500 text-6xl block">📦</span>
                            <span class="text-gray-500 mt-2">Tidak ada gambar</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <h2 class="text-3xl font-bold text-blue-700 mb-4">{{ $product->title }}</h2>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Deskripsi</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h3 class="text-sm font-semibold text-blue-600 mb-1">Harga</h3>
                            <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h3 class="text-sm font-semibold text-green-600 mb-1">Stok</h3>
                            <p class="text-2xl font-bold text-green-700">{{ $product->stock }} unit</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-semibold text-gray-600">Dibuat:</span>
                                <p class="text-gray-700">{{ $product->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-600">Diupdate:</span>
                                <p class="text-gray-700">{{ $product->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 mt-8">
                    <a href="{{ route('products.edit', $product->id) }}" class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-semibold text-center">
                        ✏️ Edit Produk
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->title }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white py-3 px-6 rounded-lg hover:bg-red-700 transition font-semibold">
                            🗑️ Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
            ← Kembali ke Daftar Produk
        </a>
    </div>
</div>

</body>
</html>