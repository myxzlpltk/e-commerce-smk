@if (session('status'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <span class="alert-icon">
      <i class="fa fa-info-circle fa-fw"></i>
    </span>
    <span class="alert-text">{{ __(session('status')) }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-icon">
      <i class="fa fa-exclamation-triangle fa-fw"></i>
    </span>
    <span class="alert-text">{{ __(session('error')) }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-icon">
      <i class="fa fa-check-circle fa-fw"></i>
    </span>
    <span class="alert-text">{{ __(session('success')) }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
