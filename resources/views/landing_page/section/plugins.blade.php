<!-- Vendor JS Files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('front/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('front/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="{{ asset('front/vendor/floating-whatsapp-master/floating-wpp.js') }}"></script>

<script>
    $(document).ready(function() {
        $('article img').addClass('img-fluid');

        $("#whatsapp_button").floatingWhatsApp({

            //nomor whatsappmu
            phone: "081119931010",
            size: '50px',
            //popup message
            popupMessage: "Hello, how can we help you?",
            showPopup: true,

            //ini adalah parameter lain yang bisa kalian gunakan
            //hapus tanda komentar untuk menggunakan

            // message: "I want ask something about your product",
            // showOnIE: false,
            // headerTitle: 'Welcome!',
            // headerColor: 'crimson',
            // backgroundColor: 'crimson',

        });

        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });


        @if ($message = Session::get('success'))
            swal({
                title: "Berhasil!",
                text: "{{ $message }}",
                icon: "success",
                button: false,
                timer: 1500
            });
        @endif

        @if ($message = Session::get('error'))
            swal({
                title: "Error!",
                text: "{{ $message }}",
                icon: "error",
                button: false,
                timer: 1500
            });
        @endif
    });
</script>
