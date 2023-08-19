<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Need: Apexcharts -->
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<link href="{{ asset('sm/summernote-bs4.css') }}" rel="stylesheet">
<script src="{{ asset('sm/summernote-bs4.js') }}"></script>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 200
    });
</script>
<script>
    setTimeout(function() {
        $('.alert-success').slideUp();
    }, 5000); // Pesan flash akan hilang setelah 5 detik (5000 milidetik)
</script>
<script>
    setTimeout(function() {
        $('.alert-info').slideUp();
    }, 5000); // Pesan flash akan hilang setelah 5 detik (5000 milidetik)
</script>
<script>
    setTimeout(function() {
        $('.alert-primary').slideUp();
    }, 5000); // Pesan flash akan hilang setelah 5 detik (5000 milidetik)
</script>
<script>
    setTimeout(function() {
        $('.alert-danger').slideUp();
    }, 3000); // Pesan flash akan hilang setelah 5 detik (5000 milidetik)
</script>
<script>
    $(document).ready(function() {
        // Cek apakah submenu aktif
        if ($('.submenu-item.active').length) {
            // Tambahkan kelas 'menu-open' pada elemen parent submenu
            $('.submenu-item.active').closest('.has-sub').addClass('menu-open');
        }

    });
</script>
<script>
    $(document).ready(function() {
        $('.rupiah').mask("#.##0", {
            reverse: true
        });
    });
</script>
