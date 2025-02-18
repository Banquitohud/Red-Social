function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
            document.getElementById('saveImageButton').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function uploadImage() {
    const formData = new FormData();
    const fileInput = document.getElementById('profileImageInput');

    if (fileInput.files.length > 0) {
        formData.append('profile_image', fileInput.files[0]);

        // Agregar el token CSRF para Laravel
        formData.append('_token', '{{ csrf_token() }}');

        fetch('/update-profile-image', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('saveImageButton').classList.add('hidden');
                // Puedes agregar aquí una notificación de éxito
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Puedes agregar aquí una notificación de error
        });
    }
}
