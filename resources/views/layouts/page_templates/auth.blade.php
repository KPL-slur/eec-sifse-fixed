{{-- 
| KEMUNGKINAN BESAR INI NANTI TIDAK DIPAKAI
| 
| Alasan file ini belum dihapus untuk menjaga
| kompabilitas, takutnya ada error nanti
|
 --}}
 
<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>