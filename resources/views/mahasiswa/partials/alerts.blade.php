@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-4" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-4" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show shadow-sm border-start border-warning border-4" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Perhatian!</strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show shadow-sm border-start border-info border-4" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Informasi:</strong> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
