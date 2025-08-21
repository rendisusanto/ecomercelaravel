<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Efek hover card */
        .hover-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 140, 255, 0.3);
        }

        /* Efek fade-in */
        .fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol tambah mengambang */
        .floating-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: #1E40AF;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 9999px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .floating-btn:hover {
            background-color: #2563EB;
            transform: scale(1.1);
        }

        /* Alert styles */
        .alert {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            font-weight: 500;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 text-gray-800 min-h-screen">

<div class="max-w-7xl mx-auto py-10 px-4 fade-in">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
        <h1 class="text-5xl font-extrabold text-blue-700 drop-shadow-lg">📦 Produk Terkini</h1>
        
        <!-- Search Form -->
        <form method="GET" action="{{ route('products.index') }}" class="w-full md:w-auto">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari produk..." 
                       class="px-4 py-3 pr-12 border border-blue-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 transition">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results Info -->
    @if(request('search'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-700 font-medium">
                        Hasil pencarian untuk: <span class="font-bold">"{{ request('search') }}"</span>
                    </p>
                    <p class="text-blue-600 text-sm">{{ $products->total() }} produk ditemukan</p>
                </div>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                    Reset Pencarian
                </a>
            </div>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Grid Produk -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-2xl p-6 shadow-lg hover-card transition duration-300">
            @if($product->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover rounded-lg" alt="{{ $product->title }}" 
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIwIiBoZWlnaHQ9IjE5MiIgdmlld0JveD0iMCAwIDMyMCAxOTIiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMjAiIGhlaWdodD0iMTkyIiBmaWxsPSIjRjNGNEY2Ii8+Cjx0ZXh0IHg9IjE2MCIgeT0iOTYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZpbGw9IiM5Q0EzQUYiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCI+8J+TpiBHYW1iYXIgVGlkYWsgRGl0ZW11a2FuPC90ZXh0Pgo8L3N2Zz4K';">
                </div>
            @else
                <div class="mb-4 w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-500 text-4xl">📦</span>
                    <span class="text-gray-500 ml-2">Tidak ada gambar</span>
                </div>
            @endif
            
            <h2 class="text-xl font-bold text-blue-700 mb-2">{{ $product->title }}</h2>
            <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
            <p class="text-blue-600 font-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-500 mb-4">Stok: {{ $product->stock }}</p>
            
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('products.show', $product->id) }}" class="px-3 py-2 bg-green-500 text-white text-sm rounded-full hover:bg-green-600 transition">👁️ Detail</a>
                <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-2 bg-blue-500 text-white text-sm rounded-full hover:bg-blue-600 transition">✏️ Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->title }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 bg-red-500 text-white text-sm rounded-full hover:bg-red-600 transition">🗑️ Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            @if(request('search'))
                <div class="text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-xl font-semibold mb-2">Tidak ada produk yang ditemukan</p>
                    <p class="text-gray-600 mb-4">Coba gunakan kata kunci yang berbeda atau</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Lihat Semua Produk
                    </a>
                </div>
            @else
                <div class="text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0H4"></path>
                    </svg>
                    <p class="text-xl font-semibold mb-2">Belum ada produk</p>
                    <p class="text-gray-600 mb-4">Mulai dengan menambahkan produk pertama Anda</p>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        + Tambah Produk Pertama
                    </a>
                </div>
            @endif
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $products->links() }}
    </div>
    @endif
</div>

<!-- Floating Add Button -->
<a href="{{ route('products.create') }}" class="floating-btn">+ Tambah Produk</a>

<!-- JavaScript untuk Live Search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const searchForm = document.querySelector('form');
    
    // Auto submit form saat user berhenti mengetik (debounce)
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            if (searchInput.value.length >= 2 || searchInput.value.length === 0) {
                searchForm.submit();
            }
        }, 500); // Delay 500ms setelah user berhenti mengetik
    });

    // Submit form saat tekan Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchForm.submit();
        }
    });
});
</script>

</body>
</html>