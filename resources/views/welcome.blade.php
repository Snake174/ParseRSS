<!DOCTYPE html>
<html lang="ru">
<head>
    <title>ParseRSS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="ru" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="x-rim-auto-match" content="none">
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="7 days" />
    <meta name="keywords" content="rss,parse,laravel" />
    <meta name="description" content="ParseRSS" />
    <meta name="author" content="Serebryannikov Evgeny" />
    <meta name="copyright" content="Serebryannikov Evgeny" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">

        @foreach ($news as $n)
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="card">
                @php
                $photos = $n->photos();
                $carouselIndicatorsID = "carouselIndicators{$n->id}";
                $idx = 0;
                @endphp

                @if (count($photos) > 0)
                <div id="{{ $carouselIndicatorsID }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($photos as $p)
                        @if ($idx == 0)
                        <button type="button" data-bs-target="#{{ $carouselIndicatorsID }}" data-bs-slide-to="{{ $idx++ }}" class="active" aria-current="true"></button>
                        @else
                        <button type="button" data-bs-target="#{{ $carouselIndicatorsID }}" data-bs-slide-to="{{ $idx++ }}"></button>
                        @endif
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @php
                        $idx = 0;
                        @endphp
                        @foreach ($photos as $p)
                        <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}">
                            <img class="card-img-top" src="{{ $p->photo_url }}" class="d-block" alt="" />
                        </div>
                        @php
                        $idx++;
                        @endphp
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselIndicatorsID }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselIndicatorsID }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $n->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $n->published }}</h6>

                    @if ($n->author)
                    <h7 class="card-subtitle mb-2 text-muted">{{ $n->author }}</h7>
                    @endif

                    <p class="card-text">{{ $n->description }}</p>
                    <a href="{{ $n->link }}" class="btn btn-primary">Перейти к новости</a>
                </div>
            </div>
        </div>
        @endforeach

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
