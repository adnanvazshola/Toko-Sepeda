@extends('layout.ecomm')
@section('title')
    <title>{{ $blog->judul }}</title>
@endsection

@section('content')
  <main class="ps-main">
    <div class="ps-blog-grid pt-80 pb-80">
      <div class="ps-container">
        <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
            <div class="ps-post--detail">
              <div class="ps-post__header">
                <h3 class="ps-post__title">{{ $blog->judul }}</h3><br><br>
                <div class="ps-post__thumbnail w-100"><img src="{{ asset('storage/berita/' . $blog->foto) }}" alt="{{ $blog->slug }}"></div>
                <p class="ps-post__meta">
                  Posted by 
                  <a href="blog-grid.html">{{ $blog->user->name }}</a> on {{ $blog->created_at->format('d-m-Y') }}
                </p>
              </div>
              <div class="ps-post__content">
                <p>{!! $blog->isi !!}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                  <aside class="ps-widget--sidebar ps-widget--search">
                    <form class="ps-search--widget" action="do_action" method="post">
                      <input class="form-control" type="text" placeholder="Cari Artikel...">
                      <button><i class="ps-icon-search"></i></button>
                    </form>
                  </aside>
                  <aside class="ps-widget--sidebar">
                    <div class="ps-widget__header">
                      <h3>Artikel Terbaru</h3>
                    </div>
                    <div class="ps-widget__content">
                      @forelse ($blok as $row)
                        <div class="ps-post--sidebar">
                          <div class="ps-post__thumbnail"><a href="{{ url('/blog/' . $row->slug) }}"></a><img src="{{ asset('storage/berita/' . $row->foto) }}" alt=""></div>
                          <div class="ps-post__content"><a class="ps-post__title" href="{{ url('/blog/' . $row->slug) }}">{{ $row->judul }}</a><span>{{ $row->created_at->format('d-m-Y') }}</span></div>
                        </div>
                        @empty
                          <div class="col-md-12">
                            <h3 class="text-center">Tidak ada berita</h3>
                          </div>
                      @endforelse
                    </div>
                  </aside>
                </div>
        </div>
      </div>
    </div>
  </main>
@endsection