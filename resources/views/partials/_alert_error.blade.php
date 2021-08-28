@if ($alert_error=session('alert_error'))
<div class="alert alert-danger">
        <p>{{ $alert_error }}</p>
    </div>
@endif

