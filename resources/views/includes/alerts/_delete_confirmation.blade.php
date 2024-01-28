<script>
    function showDeleteConfirmation(event, Route) {
        event.preventDefault(); // Prevent the default behavior of the link

        Swal.fire({
            title: "<?php echo __('pages/admin/messages.saved'); ?>",
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimez-le!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Suppression en cours...',
                    text: 'Veuillez patienter',
                    icon: 'info',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Construct the delete URL
                const deleteUrl = Route;
                // Send a DELETE request to the delete URL using fetch API
                fetch(deleteUrl, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message || true) {
                            Swal.fire({
                                title: 'Supprimé!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                // Redirect to another page or perform any other actions
                                // window.location.href = "{{ route('banner_ads.index') }}";
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Erreur!',
                                text: 'Il y a eu une erreur lors de la suppression du bannière.',
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Il y a eu une erreur lors de la suppression du bannière.',
                            icon: 'error'
                        });
                        console.error('Delete request failed:', error);
                    });
            }
        });
    }
</script>
