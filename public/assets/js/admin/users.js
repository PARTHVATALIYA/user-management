$(document).ready(function() {
    $('.table').DataTable();

    $('.approveUserButton').click(function() {
        const id = $(this).attr('id').replace('approve_' , '');
        Swal.fire({
            title: 'Approve this user?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace(`/approve/${id}`);
            }
        });
    });

    $('.toggle').click(function() {
        const id = $(this).attr('id').replace('toggle_', '');
        Swal.fire({
            title: "Are you sure",
            text: "You want to change the status of user",
            icon: "question",
            showCancelButton: true
        }). then((result) => {
            if (result.isConfirmed) {
                if ( $(this).hasClass('deActive')) {
                    $(this).removeClass('deActive');
                    $(this).addClass('active');
                    window.location.replace(`user/status/${id}`);
                } else {
                    $(this).removeClass('active');
                    $(this).addClass('deActive');
                    window.location.replace(`user/status/${id}`);
                }
                // if (button.getAttribute("class") == 'toggle active') {
                //     const id = button.getAttribute("id").slice(7);
                //     button.classList.remove('active');
                //     button.classList.add("deActive");
                //     toggle(id);
    
                // } else if (button.getAttribute("class") == 'toggle deActive') {
                //     const id = button.getAttribute("id").slice(9);
                //     button.classList.add("active");
                //     button.classList.remove("deActive");
                //     toggle(id);
    
                // }
            }
        })
    })
})