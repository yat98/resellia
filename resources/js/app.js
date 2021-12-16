require('./bootstrap');

// Bootstrap
require('bootstrap');

// Sweetalert2
require('sweetalert2');
import Swal from 'sweetalert2'

$(function () {
    $(document.body).on('click', '.js-submit-confirm', function (e) {
        e.preventDefault();
        let el = $(this);
        let form = el.closest('form');
        let text = el.data('confirm-data') ? el.data('confirm-data') : 'Kamu tidak akan bisa membatalkan proses ini!';

        Swal.fire({
            title: 'Kamu yakin?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yep, lanjutkan!',
            closeOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.trigger('submit');
            }
        })
    });
});