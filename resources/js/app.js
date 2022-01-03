require('./bootstrap');

// Bootstrap
require('bootstrap');

// Sweetalert2
require('sweetalert2');
import Swal from 'sweetalert2'

// Selectize
require('selectize');

// Main
$(function () {
    // Delete Alert
    $(document.body).on('click', '.js-submit-confirm', function (e) {
        e.preventDefault();
        let el = $(this);
        let form = el.closest('form');
        let text = el.data('confirm-message') ? el.data('confirm-message') : 'Kamu tidak akan bisa membatalkan proses ini!';

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

    // Selectize
    $('.js-selectize').selectize({
        sortField: 'text',
    });

    $('#custom-file-upload').on('change', function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    })
    console.log($('#product_name').length);
    console.log($('#product_name').data('name'));
    if ($('#product_name').length > 0) {
        Swal.fire({
            title: 'Sukses',
            html: `Berhasil menambahkan <strong>${$('#product_name').data('name')}</strong> ke cart!`,
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#63BC81',
            confirmButtonText: 'Yep, lanjutkan!',
            cancelButtonText: 'Lanjutkan belanja',
            closeOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '/cart';
            }
        })
    }
});