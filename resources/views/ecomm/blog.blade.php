@extends('layout.ecomm')
@section('title')
    <title>Blog</title>
@endsection

@section('content')
  <main class="ps-main">
    <div class="ps-blog-grid pt-80 pb-80">
      <div class="ps-container">
        <div class="row">
          @forelse ($blog as $row)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
              <div class="ps-post mb-30">
                <div class="ps-post__thumbnail">
                  <a class="ps-post__overlay" href="{{ url('/blog/' . $row->slug) }}"></a>
                  <img src="{{ asset('storage/berita/' . $row->foto) }}" alt="" height="200px" class="w-100">
                </div>
                <div class="ps-post__content"><a class="ps-post__title" href="{{ url('/blog/' . $row->slug) }}">{{ $row->judul }}</a>
                  <p class="ps-post__meta"><span>By:<a class="mr-5" href="#">{{ $row->user->name }}</a></span> -<span class="ml-5">{{ $row->created_at->format('d-m-Y') }}</span></p>
                </div>
              </div>
            </div>
              @empty
                <div class="col-md-12">
                  <h3 class="text-center">Tidak ada berita</h3>
                </div>
          @endforelse
        </div>
        <div class="mt-30">
          <div class="ps-pagination">
            <ul class="pagination">
              {{ $blog->links() }}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection