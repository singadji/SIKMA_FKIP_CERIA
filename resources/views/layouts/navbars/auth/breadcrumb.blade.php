@php
    $pageTitle = $judul ?? ($subjudul ?? 'Dashboard');
@endphp
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0 font-size-18">{{ $pageTitle }}</h4>
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item">
            <a href="javascript: void(0);">{{ $pageTitle }}</a>
          </li>
          @if(!empty($subjudul))
            <li class="breadcrumb-item active">{{ $subjudul }}</li>
          @endif
        </ol>
      </div>
    </div>
  </div>
</div>
