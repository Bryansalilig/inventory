<!DOCTYPE html>
<html lang="en">
  @include('layouts.head')
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main Panel -->
      <div class="main-panel">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Page Content -->
        <main class="main-content">
          @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')
      </div>
    </div>

    @include('layouts.scripts')

    {{-- Page / Module specific JS --}}
    @stack('scripts')

    {{-- SweetAlert flash session --}}
    @if (session('success'))
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false,
          });
        });
      </script>
    @endif
  </body>
</html>
