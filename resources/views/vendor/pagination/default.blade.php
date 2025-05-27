@if ($paginator->hasPages())
    <nav style="display: flex; justify-content: center; margin: 30px 0;">
        <ul style="display: flex; list-style: none; padding: 0; margin: 0; gap: 5px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="margin: 0 5px;" class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: #f5f5f5; border: 1px solid #ddd; color: #ccc; cursor: not-allowed;" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li style="margin: 0 5px;">
                    <a style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: white; border: 1px solid #ddd; color: #333; text-decoration: none; font-weight: 500; transition: all 0.2s ease;" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" onmouseover="this.style.backgroundColor='#f0f0f0'; this.style.borderColor='#aaa';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#ddd';">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li style="margin: 0 5px;" class="disabled" aria-disabled="true"><span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: #f5f5f5; border: 1px solid #ddd; color: #333; cursor: default;">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="margin: 0 5px;" class="active" aria-current="page"><span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: #009fe3; border: 1px solid #009fe3; color: white; cursor: default; font-weight: bold;">{{ $page }}</span></li>
                        @else
                            <li style="margin: 0 5px;"><a style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: white; border: 1px solid #ddd; color: #333; text-decoration: none; font-weight: 500; transition: all 0.2s ease;" href="{{ $url }}" onmouseover="this.style.backgroundColor='#f0f0f0'; this.style.borderColor='#aaa';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#ddd';">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="margin: 0 5px;">
                    <a style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: white; border: 1px solid #ddd; color: #333; text-decoration: none; font-weight: 500; transition: all 0.2s ease;" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" onmouseover="this.style.backgroundColor='#f0f0f0'; this.style.borderColor='#aaa';" onmouseout="this.style.backgroundColor='white'; this.style.borderColor='#ddd';">&rsaquo;</a>
                </li>
            @else
                <li style="margin: 0 5px;" class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 5px; background-color: #f5f5f5; border: 1px solid #ddd; color: #ccc; cursor: not-allowed;" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
