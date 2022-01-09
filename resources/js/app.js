require('./bootstrap');

// Bootstrap
require('bootstrap');

// Sweetalert2
require('sweetalert2');
import { Callbacks } from 'jquery';
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

    // BS Custom Uplaod
    $('#custom-file-upload').on('change', function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    })

    // Alert Success Add Cart
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

    // Checkout Login Password
    function passwordChecked() {
        if ($("input[name=checkout_password]").length > 0 && $('input[name=is_guest]').length > 0 && $('input[name=is_guest]:checked').val() > 0) {
            $("input[name=checkout_password]").prop('disabled', true);
        }
    }
    passwordChecked();
    $("input[name=is_guest]").on('change', function () {
        console.log($(this).val());
        if ($(this).val() == 1) {
            passwordChecked();
        } else {
            $("input[name=checkout_password]").removeAttr('disabled');
        }
    });

    // Select City Ajax
    if ($('#province_id').length > 0) {
        let xhr, provinceSelector, citySelector, $provinceSelector, $citySelector;

        $provinceSelector = $('#province_id').selectize({
            sortField: 'text',
            onChange: function (value) {
                if (!value.length) {
                    citySelector.disable();
                    citySelector.clearOptions();
                    return;
                }
                citySelector.clearOptions();
                citySelector.load(function (callback) {
                    xhr && xhr.abort();
                    xhr = $.ajax({
                        url: '/api/address/cities?province_id=' + value,
                        success: function (results) {
                            citySelector.enable();
                            callback(results);
                        },
                        error: function () {
                            callback();
                        }
                    })
                });
            }
        });

        $citySelector = $('#city_id').selectize({
            sortField: 'name',
            valueField: 'city_id',
            labelField: 'name',
            searchField: ['name']
        });

        provinceSelector = $provinceSelector[0].selectize;
        citySelector = $citySelector[0].selectize;
    }

    // Address Show New Address Form
    if ($('input[name=address_id]').length > 0) {
        let selected = $('input[name=address_id]:checked').val();
        if (selected == 'undefined' || selected != 'new-address') {
            $('#js-new-address').hide();
        }
    }
    $('input[name=address_id]').on('change', function () {
        let selected = $('input[name=address_id]:checked').val();
        if (selected == 'new-address') {
            $('#js-new-address').show();
        } else {
            $('#js-new-address').hide();
        }
    });
});