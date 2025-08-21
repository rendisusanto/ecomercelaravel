<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-white to-blue-50 text-gray-800 min-h-screen">

<div class="max-w-2xl mx-auto py-10 px-4">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700 mb-2">✏️ Edit Produk</h1>
        <nav class="text-sm">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Produk</a>
            <span class="text-gray-500"> / Edit Produk</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl p-8 shadow-lg">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Current Image Preview -->
            @if($product->image)
            <div>
                <label class="block text-gray-700 font-bold mb-3">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded-lg mb-3" alt="{{ $product->title }}"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTI4IiBoZWlnaHQ9IjEyOCIgdmlld0JveD0iMCAwIDEyOCAxMjgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMjgiIGhlaWdodD0iMTI4IiBmaWxsPSIjRjNGNEY2Ii8+Cjx0ZXh0IHg9IjY0IiB5PSI2NCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzlDQTNBRiIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIj7wn5OmIE5vdCBGb3VuZDwvdGV4dD4KPC9zdmc+Cg==';">
                <small class="text-xs text-gray-500 block">{{ $product->image }}</small>
            </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label class="block text-gray-700 font-bold mb-3">Gambar Produk {{ $product->image ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label class="block text-gray-700 font-bold mb-3">Nama Produk</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" placeholder="Masukkan nama produk" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-gray-700 font-bold mb-3">Deskripsi</label>
                <textarea name="description" rows="4" placeholder="Masukkan deskripsi produk" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-gray-700 font-bold mb-3">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" step="0.01" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror">
                @error('price')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-gray-700 font-bold mb-3">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" placeholder="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror">
                @error('stock')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-semibold">
                    💾 Update Produk
                </button>
                <a href="{{ route('products.index') }}" class="flex-1 bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition font-semibold text-center">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>