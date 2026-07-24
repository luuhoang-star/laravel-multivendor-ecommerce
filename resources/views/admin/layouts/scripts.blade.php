<script>
    tinymce.init({
        license_key: 'gpl',
        selector: '#editor',
        height: 350,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });

    $(document).ready(function() {
        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Hành động này sẽ xóa dữ liệu khỏi hệ thống!",
                icon: 'warning',
                showCancelButton: true,
                confirmColor: '#3085d6',
                cancelColor: '#d33',
                confirmButtonText: 'Đồng ý, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                window.location.reload();
                            } else {
                                Swal.fire('Lỗi!', data.message || 'Đã có lỗi xảy ra.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            let errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Đã có lỗi xảy ra!';
                            Swal.fire('Lỗi!', errMsg, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
