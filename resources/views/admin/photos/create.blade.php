@extends('layouts.admin')

@section('title', 'Upload photos')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ route('admin.photos.store', ['category' => $category]) }}">
    @csrf
    <input type="hidden" name="category" value="{{ $category }}">
    <div class="page-head">
      <div>
        <h2>Upload photos – {{ $category === 'portfolio' ? 'Portfolio page' : 'Project page' }}</h2>
        <p>Choose one or many photos at once. They are resized automatically.</p>
      </div>
      <div class="actions">
        <a href="{{ route('admin.photos.index', ['category' => $category]) }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-cloud-arrow-up"></i>Upload</button>
      </div>
    </div>

    <div class="card" style="max-width:860px">
      <div class="card-body">
        <div class="field">
          <label for="images">Photos (JPG, PNG or WebP)</label>
          <input id="images" type="file" name="images[]" accept="image/*" multiple required @class(['input', 'is-invalid' => $errors->has('images') || $errors->has('images.*')])>
          @error('images')<div class="error">{{ $message }}</div>@enderror
          @error('images.*')<div class="error">{{ $message }}</div>@enderror
          <div id="previews" class="photo-grid" style="padding:12px 0 0;grid-template-columns:repeat(auto-fill,minmax(110px,1fr))"></div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('scripts')
<script>
document.getElementById("images").addEventListener("change", (e) => {
  const box = document.getElementById("previews");
  box.innerHTML = "";
  [...e.target.files].forEach((f) => {
    const img = document.createElement("img");
    img.src = URL.createObjectURL(f);
    img.style.cssText = "width:100%;aspect-ratio:1;object-fit:cover;border-radius:10px";
    box.appendChild(img);
  });
});
</script>
@endpush
