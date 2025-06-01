@extends('layouts.app')

@section('title', 'Orlin Farm - Platform Hewan Qurban Terpercaya')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero__container">
            <div class="hero__content">
                <h1 class="hero__title">Orlin Farm</h1>
                <p class="hero__description">
                    Orlin Farm adalah platform terpercaya untuk jual beli hewan qurban secara online yang melayani wilayah Jabodetabek. Kami menyediakan hewan qurban berkualitas, layanan tabungan qurban, serta kemudahan transaksi digital. Dengan semangat transparansi dan amanah, Orlin Farm hadir untuk memudahkan ibadah qurban Anda secara praktis dan tepat sasaran.
                </p>
                @if (!currentPelanggan())
                    <div class="hero__actions">
                        <a href="{{ route('pelanggan.register.form') }}" class="btn btn--primary btn--large">
                            Mulai Berbelanja
                        </a>
                        <a href="#products" class="btn btn--secondary btn--large" id="lihatProdukBtn">
                            Lihat Produk
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter" id="products">
            <div class="filter__container">
                <form method="GET" action="{{ url()->current() }}" class="filter__form" id="filterForm">
                    <!-- Hidden field to store scroll position -->
                    <input type="hidden" name="scroll_pos" id="scroll_pos" value="{{ request(key: 'scroll_pos') }}">
                    
                    <div class="filter__controls">
                        <!-- Search Input -->
                        <div class="filter__group--search">
                            <input type="text" 
                                   id="search"
                                   name="search" 
                                   class="filter__select" 
                                   placeholder="Cari jenis, lokasi, deskripsi" 
                                   value="{{ request('search') }}"
                                   style="min-width: 250px;">
                        </div>

                        <!-- Gender Filter -->
                        <div class="filter__group--small">
                            <select name="kelamin" id="kelamin" class="filter__select">
                                <option value="">Semua Kelamin</option>
                                <option value="Jantan" {{ request('kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                                <option value="Betina" {{ request('kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="filter__group--small">
                            <select name="sort_by" id="sort_by" class="filter__select">
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                <option value="harga" {{ request('sort_by') == 'harga' ? 'selected' : '' }}>Harga</option>
                                <option value="bobot" {{ request('sort_by') == 'bobot' ? 'selected' : '' }}>Bobot</option>
                            </select>
                        </div>

                        <!-- Sort Order -->
                        <div class="filter__sort">
                            <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'desc') }}">
                            <button type="button" 
                                    id="sort-desc" 
                                    class="filter__btn {{ request('sort_order') != 'asc' ? 'filter__btn--active' : '' }}" 
                                    onclick="setSortOrder('desc')">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="btn--icon"><path d="M440-800v487L216-537l-56 57 320 320 320-320-56-57-224 224v-487h-80Z"/></svg>
                            </button>
                            <button type="button" 
                                    id="sort-asc" 
                                    class="filter__btn {{ request('sort_order') == 'asc' ? 'filter__btn--active' : '' }}" 
                                    onclick="setSortOrder('asc')">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="btn--icon"><path d="M440-160v-487L216-423l-56-57 320-320 320 320-56 57-224-224v487h-80Z"/></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    </section>

    <!-- Products Section -->
    <section class="products">
        <div class="container">
            <div class="products__container">
                @if ($hewanQurbans->count() > 0)
                    <div class="products__grid" id="productsGrid">
                        @foreach ($hewanQurbans as $hewanQurban)
                            <x-etalase-card :hewanQurban="$hewanQurban" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="products__pagination">
                        {{ $hewanQurbans->appends(request()->query())->links('pagination::default') }}
                    </div>
                @else
                    <div class="products__empty">
                        <div class="products__empty-icon">🐐</div>
                        <h3 class="products__empty-title">Tidak ada hewan qurban tersedia</h3>
                        <p class="products__empty-text">
                            @if(request()->hasAny(['search', 'kelamin', 'sort_by']))
                                Maaf, tidak ada produk yang sesuai dengan filter Anda. Coba ubah filter atau hapus beberapa kriteria pencarian.
                            @else
                                Maaf, saat ini belum ada produk yang tersedia. Silakan kembali lagi nanti.
                            @endif
                        </p>
                        @if(request()->hasAny(['search', 'kelamin', 'sort_by']))
                            <a href="{{ route('home') }}" class="btn btn--primary">Lihat Semua Produk</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if this is a filter submission (has scroll_pos) vs normal page load
    const isFilterSubmission = {{ request('scroll_pos') ? 'true' : 'false' }};
    const isFromAnchorLink = window.location.hash === '#products';
    
    // Store scroll position before form submit
    function storeScrollPosition() {
        const scrollPos = window.pageYOffset || document.documentElement.scrollTop;
        document.getElementById('scroll_pos').value = scrollPos;
    }

    // Restore scroll position after page load (only for filter submissions)
    function restoreScrollPosition() {
        const scrollPos = {{ request('scroll_pos', 0) }};
        if (scrollPos > 0 && isFilterSubmission && !isFromAnchorLink) {
            // Use setTimeout to ensure DOM is fully loaded
            setTimeout(() => {
                window.scrollTo({
                    top: scrollPos,
                    behavior: 'instant' // No smooth scrolling on restore
                });
            }, 100);
        }
    }

    // Handle "Lihat Produk" button click
    const lihatProdukBtn = document.getElementById('lihatProdukBtn');
    if (lihatProdukBtn) {
        lihatProdukBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Clear scroll position when navigating normally
            const url = new URL(window.location);
            url.searchParams.delete('scroll_pos');
            url.hash = 'products';
            
            // Update URL without reload
            window.history.pushState({}, '', url.toString());
            
            // Smooth scroll to products section
            const productsSection = document.getElementById('products');
            if (productsSection) {
                productsSection.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
        });
    }

    // Auto submit form when filter changes (except search input)
    const autoSubmitElements = document.querySelectorAll('select[name="kelamin"], select[name="sort_by"]');
    autoSubmitElements.forEach(element => {
        element.addEventListener('change', function() {
            storeScrollPosition();
            this.closest('form').submit();
        });
    });

    // Search with debounce
    const searchInput = document.querySelector('input[name="search"]');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                storeScrollPosition();
                this.closest('form').submit();
            }, 500); // 500ms delay
        });
    }

    // Store scroll position on form submit
    const form = document.getElementById('filterForm');
    if (form) {
        form.addEventListener('submit', function() {
            storeScrollPosition();
        });
    }

    // Store scroll position on pagination links
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function() {
            storeScrollPosition();
            // Update the href to include scroll position
            const url = new URL(this.href);
            url.searchParams.set('scroll_pos', window.pageYOffset || document.documentElement.scrollTop);
            this.href = url.toString();
        });
    });

    // Only restore scroll position for filter submissions, not normal navigation
    if (isFilterSubmission && !isFromAnchorLink) {
        restoreScrollPosition();
    }

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        // Check if we're coming back to an anchor link
        if (window.location.hash === '#products') {
            setTimeout(() => {
                const productsSection = document.getElementById('products');
                if (productsSection) {
                    productsSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                }
            }, 100);
        } else if (isFilterSubmission) {
            setTimeout(restoreScrollPosition, 100);
        }
    });
});

function setSortOrder(order) {
    // Store scroll position before changing sort
    const scrollPos = window.pageYOffset || document.documentElement.scrollTop;
    document.getElementById('scroll_pos').value = scrollPos;
    document.getElementById('sort_order').value = order;
    
    // Update button states
    const descBtn = document.getElementById('sort-desc');
    const ascBtn = document.getElementById('sort-asc');
    
    if (order === 'desc') {
        descBtn.classList.add('filter__btn--active');
        ascBtn.classList.remove('filter__btn--active');
    } else {
        ascBtn.classList.add('filter__btn--active');
        descBtn.classList.remove('filter__btn--active');
    }
    
    // Submit form
    document.querySelector('form').submit();
}
</script>
@endpush