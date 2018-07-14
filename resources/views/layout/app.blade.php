<!DOCTYPE html>
<html lang="en">

<head>
  @include('partials._head')
  @include('partials._style')
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('partials._nav',['queue'=>Helpers::myQueue(),'waiting'=>Helpers::waitingQueue()])
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/">Home</a>
        </li>

        @php
          $paths = Request::path();
          $temp = explode("/",$paths);
          $numItems = count($temp);
          $path = "";
          $i = 0;
        @endphp
        @foreach ($temp as $key => $value)
          @if ($value)
            @php $path .= $value.'/' @endphp
            <li class="breadcrumb-item">
              @if (++$i === $numItems)
                {{ $value }}
              @else
                <a href="{{ url(rtrim($path,'.')) }}">{{ $value }}</a>
              @endif
            </li>
          @endif
        @endforeach
      </ol>
      @include('partials._message')
      @yield('content')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    @include('partials._footer')
  </div>
  @include('partials._script')
</body>
</html>
