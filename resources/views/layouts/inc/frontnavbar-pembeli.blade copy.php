@guest
@if (Route::has('login') && Route::has('register'))
<a href="" class="btn" style="font-size: 20px">
    <i class="fas fa-shopping-cart text-primary"></i>
    <span class="badge">{{ $pesanan }}</span>
</a>
@endif
@else
<a href="" class="btn" style="font-size: 20px">
    <i class="fas fa-shopping-cart text-primary"></i>
    <span class="badge">{{$pesanan->total}}</span>
</a>
@endguest