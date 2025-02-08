<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="m-4">
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
        <div class="flex flex-col space-y-2">
            <!-- Tombol Kamera -->
            <button type="button" id="toggle-camera-{{ $name }}" class="bg-blue-500 text-white py-1 px-4 rounded">
                Turn Camera On
            </button>
            <button type="button" id="switch-camera-{{ $name }}" class="bg-gray-500 text-white py-1 px-4 rounded hidden">
                Switch Camera
            </button>
            <button type="button" id="re-take-camera-{{ $name }}" class="bg-yellow-500 text-white py-1 px-4 rounded hidden">
                Re-Take
            </button>
            <button type="button" id="capture-photo-{{ $name }}" class="bg-green-500 text-white py-1 px-4 rounded hidden">
                Ambil Foto
            </button>

            <!-- Video Stream -->
            <video id="camera-stream-{{ $name }}" class="hidden w-full rounded" autoplay></video>

            <!-- Hasil Foto -->
            <canvas id="photo-canvas-{{ $name }}" class="hidden w-full rounded"></canvas>
            <img id="photo-preview-{{ $name }}" class="hidden w-full rounded" alt="{{ $label }}">

            <!-- Input untuk Data Gambar -->
            <input type="hidden" name="{{ $name }}_attachment_data" id="{{ $name }}_data">
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan
        </button>
    </div>
</form>


<script>
document.addEventListener('DOMContentLoaded', function () {
    function setupCamera(name) {
        let cameraStream = null;
        let currentFacingMode = 'user';
        const videoElement = document.getElementById(`camera-stream-${name}`);
        const canvasElement = document.getElementById(`photo-canvas-${name}`);
        const photoPreview = document.getElementById(`photo-preview-${name}`);
        const captureButton = document.getElementById(`capture-photo-${name}`);
        const toggleCameraButton = document.getElementById(`toggle-camera-${name}`);
        const switchCameraButton = document.getElementById(`switch-camera-${name}`);
        const reTakeButton = document.getElementById(`re-take-camera-${name}`);
        const photoDataInput = document.getElementById(`${name}_data`);

        async function startCamera() {
            try {
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: currentFacingMode }
                });
                videoElement.srcObject = cameraStream;
                videoElement.classList.remove('hidden');
                captureButton.classList.remove('hidden');
                switchCameraButton.classList.remove('hidden');
                toggleCameraButton.classList.add('hidden');
            } catch (error) {
                console.error('Kamera gagal dinyalakan:', error);
                alert('Gagal mengakses kamera. Pastikan izin diberikan.');
            }
        }

        toggleCameraButton.addEventListener('click', startCamera);

        switchCameraButton.addEventListener('click', () => {
            currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            if (cameraStream) {
                cameraStream.getTracks().forEach((track) => track.stop());
            }
            startCamera();
        });

        captureButton.addEventListener('click', () => {
            const context = canvasElement.getContext('2d');
            canvasElement.width = videoElement.videoWidth;
            canvasElement.height = videoElement.videoHeight;
            context.drawImage(videoElement, 0, 0);

            if (cameraStream) {
                cameraStream.getTracks().forEach((track) => track.stop());
            }

            videoElement.classList.add('hidden');
            captureButton.classList.add('hidden');
            switchCameraButton.classList.add('hidden');

            const photoDataURL = canvasElement.toDataURL('image/png');
            photoPreview.src = photoDataURL;
            photoPreview.classList.remove('hidden');
            photoDataInput.value = photoDataURL;

            reTakeButton.classList.remove('hidden');
        });

        reTakeButton.addEventListener('click', () => {
            photoPreview.classList.add('hidden');
            reTakeButton.classList.add('hidden');
            startCamera();
        });
    }

    setupCamera('{{ $name }}');
});
</script>
