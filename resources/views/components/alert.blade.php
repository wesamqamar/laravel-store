  <div>


    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->

    @if (session()->has($type))
    <div class="alert alert-{{ $type }}">
    {{ session($type) }}
    </div>
    @endif


</div>
