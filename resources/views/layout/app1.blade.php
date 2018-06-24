<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
    @include('partials._style')
  </head>
  <body>
      <div class="row">
        <div class="container-fluid">
          @include('partials._nav')
        </div>
      </div>

      <div class="row">
        <div class="col-2 px-0">
            @include('partials._sidebar',['data' => Helpers::waitingQueue()])
        </div>

        <div class="col-10" id="wrapper">
          <div class="container-fluid px-0">
            <div class="mr-3">
              <div class="row">
                @include('partials._message')
              </div>
              @yield('content')
              </div>
            </div>
        </div>

      </div>

    <!-- Bar -->
    {{-- <div class="row">
      <div class="container-fluid">
        @include('partials._nav2')
      </div>
    </div>
    <div class="row">
      @include('partials._message')
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="container-fluid">
            <!-- Content -->
            @yield('content')
        </div>
      </div>
    </div> --}}
    @include('partials._script')
    @yield('scripts')
  </body>
</html>
