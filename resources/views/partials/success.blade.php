@if (session()->has('success'))
    <div class="alert alert-success">
        <ul>
           {{ session()->get('success') }}
        </ul>
    </div>
@endif