@extends('layouts.admin')

@section('title', 'Products — Admin')
@section('topbar-title', 'Products')

@section('content')

<!-- Filter Bar -->
<div class="card" style="margin-bottom: 1.5rem; padding: 1rem;">
    <form action="{{ route('admin.products.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        
        <!-- Search -->
        <div style="flex: 1; min-width: 200px;">
            <label style="font-size: 0.75rem; color: var(--muted); margin-bottom: 0.4rem; display: block;">Search Name or Brand</label>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search...">
        </div>

        <!-- Category Filter -->
        <div style="width: 180px;">
            <label style="font-size: 0.75rem; color: var(--muted); margin-bottom: 0.4rem; display: block;">Category</label>
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Brand Filter (Manual input or Select) -->
        <div style="width: 150px;">
            <label style="font-size: 0.75rem; color: var(--muted); margin-bottom: 0.4rem; display: block;">Brand</label>
            <input type="text" name="brand" value="{{ request('brand') }}" class="form-control" placeholder="Brand name">
        </div>

        <div style="display: flex; gap: 0.5rem;">
           <button type="submit" class="btn btn-teal">Filter</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Clear</a>
        </div>
    </form>
</div>



    <div class="card">
        <div class="card-header">
            <h3>All Products ({{ $products->count() }})</h3>
            <a href="{{ route('admin.products.create') }}" class="btn btn-teal btn-sm">+ New Product</a>
            <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" style="display:inline-flex; gap:5px;">
        @csrf
        <input type="file" name="import_file" class="form-control" style="font-size:0.7rem; width:150px;" required>
        <button type="submit" class="btn btn-teal btn-sm">Import</button>
    </form>
            
        </div>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="clickable-row" 
                    data-id="{{ $product->id }}" 
                    data-name="{{ $product->product_name }}"
                    data-brand="{{ $product->brand }}"
                    data-category="{{ $product->category->category_name }}"
                    data-price="{{ number_format($product->price, 2) }}"
                    data-stock="{{ $product->stock_quantity }}"
                    data-description="{{ $product->description }}"
                    data-status="{{ $product->status }}"
                    data-image="{{ asset('storage/'.$product->product_image) }}"
                    style="cursor: pointer;">
                    
                    <td>
                        <img src="{{ asset('storage/'.$product->product_image) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid var(--border);">
                    </td>
                    <td>
                        <p style="font-weight:600;font-size:0.875rem;">{{ $product->product_name }}</p>
                        <p style="color:var(--muted);font-size:0.75rem;">{{ $product->brand }}</p>
                    </td>
                    <td style="color:var(--muted);font-size:0.85rem;">{{ $product->category->category_name }}</td>
                    <td style="font-weight:600;color:var(--accent);">${{ number_format($product->price, 2) }}</td>
                    <td style="font-size:0.875rem;">{{ $product->stock_quantity }}</td>
                    <td>
                        @if($product->status === 'available')
                            <span class="chip chip-green">Available</span>
                        @else
                            <span class="chip chip-red">Out of Stock</span>
                        @endif
                    </td>
                    <td onclick="event.stopPropagation();"> <!-- This prevents the pop-up when clicking buttons -->
                        <div style="display:flex;gap:0.5rem;">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2.5rem;">No products yet. <a href="{{ route('admin.products.create') }}" style="color:var(--accent);">Add one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>


<!-- Product Detail Modal -->
<div id="productModal" class="modal-overlay">
    <div class="modal-card">
        <button class="close-modal">&times;</button>
        <div class="modal-body">
            <div class="modal-image">
                <img id="modalImg" src="" alt="Product">
            </div>
            <div class="modal-info">
                <span id="modalBrand" class="brand-badge">BRAND</span>
                <h2 id="modalName">Product Name</h2>
                <p id="modalCategory" style="color: var(--muted); font-size: 0.9rem; margin-bottom: 1rem;">Category</p>
                
                <div class="modal-price-row">
                    <span id="modalPrice" class="modal-price">$0.00</span>
                    <span id="modalStatus" class="chip">Status</span>
                </div>

                <div class="modal-description">
                    <h4>Description</h4>
                    <p id="modalDesc">No description available.</p>
                </div>

                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                    <p style="font-size: 0.85rem; color: var(--muted);">Stock Quantity: <strong id="modalStock" style="color: var(--text);">0</strong></p>
                </div>
                <div class="modal-footer-actions" style="margin-top: 2rem; display: flex; gap: 0.75rem; padding-top: 1.5rem; border-top: 1px solid var(--border);">
    
    <!-- Edit Button -->
    <a href="#" id="modalEditLink" class="btn btn-outline" style="flex: 1; justify-content: center;">
        Edit Product
    </a>

    <!-- Delete Form -->
    <form id="modalDeleteForm" method="POST" action="" onsubmit="return confirm('Delete this product permanently?')">
        @csrf 
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal Styles */
.modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.4); 
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: none; align-items: center; justify-content: center;
    z-index: 1000; padding: 2rem;
}
.modal-overlay.active { display: flex; }

.modal-card {
    background: #ffffff !important; 
    width: 100%; max-width: 800px;
    border-radius: 20px; position: relative; overflow: hidden;
    animation: modalIn 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); 
    box-shadow: 0 30px 70px rgba(0,0,0,0.18);
    border: 1px solid rgba(0, 0, 0, 0.05);
}
@keyframes modalIn { from { transform: translateY(15px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.close-modal {
    position: absolute; top: 1.2rem; right: 1.5rem; background: none; border: none;
    font-size: 1.8rem; color: #86868b; cursor: pointer; z-index: 10;
    transition: color 0.2s;
}
.close-modal:hover { color: var(--accent); }

.modal-body { 
    display: grid; 
    grid-template-columns: 1fr 1.2fr; 
}

.modal-image { 
    background: #f5f5f7; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    height: 100%;
    min-height: 400px;
}

.modal-image img { 
    width: 100%; 
    height: 100%; 
    object-fit: contain !important; 
    max-height: 400px; 
    padding: 30px; 
}

/* ── CLASSY, HIGH-LEGIBILITY INFOPANEL ── */
.modal-info { 
    padding: 3.5rem 3rem; 
    background: #ffffff;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Elegant letter-spaced brand tag */
.brand-badge { 
    color: var(--accent); 
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 0.72rem; 
    font-weight: 700; 
    text-transform: uppercase; 
    letter-spacing: 0.12em; /* Gives letters breathing room */
    margin-bottom: 0.5rem;
}

/* Clean, balanced product name */
#modalName { 
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif; 
    font-size: 1.6rem; 
    font-weight: 700;
    margin: 0.3rem 0 1rem; 
    line-height: 1.35; /* Elegant vertical leading */
    letter-spacing: -0.01em; /* Highly readable tracking */
    color: #1d1d1f !important;
}

.modal-price-row { 
    display: flex; 
    align-items: center; 
    gap: 1rem; 
    margin-bottom: 1.8rem; 
}

.modal-price { 
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 1.5rem; 
    font-weight: 700; 
    color: #1d1d1f !important; 
}

.modal-description h4 { 
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 0.72rem; 
    text-transform: uppercase; 
    color: #86868b; 
    letter-spacing: 0.08em;
    margin-bottom: 0.6rem; 
    font-weight: 700;
}

/* Highly legible paragraph text */
.modal-description p { 
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 0.88rem; 
    color: #515154 !important; 
    line-height: 1.65; /* Comfortable reading spacing */
    max-height: 140px; 
    overflow-y: auto; 
}

@media (max-width: 768px) {
    .modal-body { grid-template-columns: 1fr; }
    .modal-image { min-height: 250px; }
    .modal-info { padding: 2rem 1.5rem; }
}
</style>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('productModal');
    const closeBtn = document.querySelector('.close-modal');
    const rows = document.querySelectorAll('.clickable-row');

    rows.forEach(row => {
        row.addEventListener('click', function() {
            // 1. Get data from attributes
            const id = this.dataset.id; // <--- Make sure this is here
            const name = this.dataset.name;
            const brand = this.dataset.brand;
            const category = this.dataset.category;
            const price = this.dataset.price;
            const stock = this.dataset.stock;
            const desc = this.dataset.description;
            const status = this.dataset.status;
            const img = this.dataset.image;

            // 2. Fill Text Content
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalBrand').innerText = brand;
            document.getElementById('modalCategory').innerText = category;
            document.getElementById('modalPrice').innerText = '$' + price;
            document.getElementById('modalStock').innerText = stock;
            document.getElementById('modalDesc').innerText = desc;
            document.getElementById('modalImg').src = img;

            // 3. UPDATE THE LINKS (This is what was missing)
            // This sets the Edit button to go to /admin/products/[ID]/edit
            document.getElementById('modalEditLink').href = `/admin/products/${id}/edit`;
            
            // This sets the Delete form to submit to /admin/products/[ID]
            document.getElementById('modalDeleteForm').action = `/admin/products/${id}`;

            // 4. Handle Status Chip color
            const statusEl = document.getElementById('modalStatus');
            statusEl.innerText = status === 'available' ? 'Available' : 'Out of Stock';
            statusEl.className = status === 'available' ? 'chip chip-green' : 'chip chip-red';

            // 5. Show Modal
            modal.classList.add('active');
        });
    });

    // Close Modal Logic
    closeBtn.onclick = () => modal.classList.remove('active');
    window.onclick = (event) => { if (event.target == modal) modal.classList.remove('active'); }
});
</script>
