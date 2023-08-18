
import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
    Swal.fire({
        icon: 'warning',
        text: 'Do you want to delete this?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.confirmStatus = function(formId)
{
    let status = formId.dataset.status;
    if (status === 'active') {
        Swal.fire({
            icon: 'info',
            text: 'Do you want to Ban this Account?',
            showCancelButton: true,
            confirmButtonText: 'Yes, Ban it!',
        }).then((result) => {
            if (result.isConfirmed) {
                formId.submit();
            }
        });
    }else {
        Swal.fire({
            icon: 'info',
            text: 'Do you want to Active this Account?',
            showCancelButton: true,
            confirmButtonText: 'Yes, Active it!',
        }).then(function (result) {
            if (result.isConfirmed) {
                formId.submit();
            }
        });
    }
}


//
// window.confirmDeleteProduct = function(formId)
// {
//     Swal.fire({
//         icon: 'danger',
//         text: 'Do you want to delete this?',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, delete it!',
//         confirmButtonColor: '#e3342f',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             console.log('isConfirmed')
//             that.closest('.delete-product').submit();
//         }
//     });
// }
//
// //end of confirmation Delete

//
// $('.btn-delete').click(function (e) {
//     var that = $(this)
//     e.preventDefault();
//     Swal.fire({
//         title: 'Are you sure?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, delete it!',
//         customClass: {
//             confirmButton: 'btn btn-primary',
//             cancelButton: 'btn btn-outline-danger ml-1'
//         },
//         buttonsStyling: false
//     }).then(function (result) {
//         console.log('asd')
//     });
// });//end of confirmation Delete