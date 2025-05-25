<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etalase</title>
  <link rel="stylesheet" href="/css/landingpage/etalase.style.css">
</head>
<body>
  <section class="filter-section">
    <h2>Urutkan berdasarkan</h2>
    <div class="filter-controls">
      <select id="filter-kategori">
        <option value="harga">Harga</option>
        <option value="bobot">Bobot</option>
      </select>
      <button id="sort-asc">↑</button>
      <button id="sort-desc">↓</button>
    </div>
  </section>

  <main class="product-grid">
    @if (!$hewanQurbans->isEmpty())
        @foreach ($hewanQurbans as $hewanQurban)
            <x-etalase-card
                :hewanQurban="$hewanQurban"
            ></x-etalase-card>
        @endforeach

        {{-- Pagination --}}
        <div>
            {{ $hewanQurbans->appends(request()->query())->links() }}
        </div>
    @else
        <p>Tidak ada hewan qurban tersedia.</p>
    @endif

  </main>
</body>
</html>
