<x-app-layout>
    <div class="w-full max-w-lg mx-auto bg-blue-100 rounded-lg p-4 shadow-md md:max-w-3xl">
        <h1 class="text-2xl font-semibold p-4">Detail Izin</h1>
        <div class="grid grid-cols-2 gap-1 mb-4">
            <div class="font-semibold">Username:</div>
            <div>{{ $ijin->student->username }}</div>

            <div class="font-semibold">Kelas:</div>
            <div>{{ $ijin->student->studentClass->name }}</div>

            <div class="font-semibold">Alasan:</div>
            <div>{{ $ijin->reason }}</div>

            <div class="font-semibold">Tanggal Keluar:</div>
            <div>{{ $ijin->date_pick }}</div>

            <div class="font-semibold">Tanggal Kembali:</div>
            <div>{{ $ijin->date_return }}</div>

            <div class="font-semibold">Status Verifikasi:</div>
            <div>{{ $ijin->verify_status == '1' ? 'Verified' : 'Pending' }}</div>

            <div class="font-semibold">Status Siswa:</div>
            <div>
                @if ($ijin->status == '0')
                    Belum Dijemput
                @elseif ($ijin->status == '1')
                    Sudah Dijemput
                @elseif ($ijin->status == '2')
                    Sudah Kembali
                @else
                    Status Tidak Diketahui
                @endif
            </div>

            <div class="font-semibold">Lampiran:</div>
            <div>
                @if ($ijin->medic_attachment_link)
                    <a href="{{ asset('storage/' . $ijin->medic_attachment_link) }}" target="_blank"
                        class="text-blue-500 underline">Lihat Lampiran Medis</a>
                @else
                    Tidak Ada Lampiran Medis
                @endif
            </div>

            @if ($ijin->pickup_attachment_link)
                <a href="{{ asset('storage/' . $ijin->pickup_attachment_link) }}" target="_blank"
                    class="text-blue-500 underline">Lihat Bukti penjemputan</a>
            @endif
            @if ($ijin->return_attachment_link)
                <a href="{{ asset('storage/' . $ijin->return_attachment_link) }}" target="_blank"
                    class="text-blue-500 underline">Lihat Bukti pengembalian</a>
            @endif
        </div>

        <!-- Bagian Verifikasi dan Validasi -->
        <div class="flex flex-col space-y-4">
            @if ($ijin->verify_status == 0)
                @can('verifikasi izin')
                    <form action="{{ route('ijin.verify', $ijin->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal
                            Pengembalian:</label>
                        <input type="date" name="date_return" id="date_return" value="{{ $ijin->date_return }}" required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        <x-submit-button class="mt-2">Setujui Izin</x-submit-button>
                    </form>
                @endcan
            @elseif ($ijin->verify_status == 1 && $ijin->status == 0)
                @can('validasi jemput')
                    <form action="{{ route('ijin.pickup', $ijin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="m-4">
                            <label for="pickup_attachment" class="block text-sm font-medium text-gray-700">Bukti
                                Dijemput</label>
                            <button type="button" id="toggle-camera"
                                class="mb-2 bg-blue-500 text-white py-1 px-4 rounded">Turn Camera On</button>
                            <button type="button" id="toggle-front-pickup-camera"
                                class="mt-2 bg-gray-500 text-white py-1 px-4 rounded">Switch Camera</button>
                            <video id="pickup-video" width="100%" height="auto" autoplay class="hidden"></video>
                            <button type="button" id="capture-pickup"
                                class="mt-4 bg-green-500 text-white py-1 px-4 rounded hidden">Ambil Foto</button>

                            <canvas id="pickup-canvas" width="100%" height="auto" class="hidden"></canvas>
                            <img id="pickup-photo" class="mt-4 hidden object-fit" alt="Bukti Dijemput">
                            <input type="hidden" name="pickup_attachment_data" id="pickup_attachment_data">
                        </div>

                        <x-submit-button>Setujui Jemput</x-submit-button>
                    </form>
                @endcan
            @elseif ($ijin->verify_status == 1 && $ijin->status == 1)
                @can('validasi kembali')
                    <form action="{{ route('ijin.return', $ijin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="m-4">
                            <label for="return_attachment" class="block text-sm font-medium text-gray-700">Bukti
                                Dikembalikan</label>
                            <button type="button" id="toggle-camera" class="mb-2 bg-blue-500 text-white py-1 px-4 rounded">Turn Camera
                                On</button>
                            <button type="button" id="toggle-front-return-camera"
                                class="mt-2 bg-gray-500 text-white py-1 px-4 rounded">Switch Camera</button>
                            <video id="return-video" width="100%" height="auto" autoplay class="hidden"></video>
                            <button type="button" id="capture-return"
                                class="mt-4 bg-green-500 text-white py-1 px-4 rounded hidden">Ambil Foto</button>

                            <canvas id="return-canvas" width="100%" height="auto" class="hidden"></canvas>
                            <img id="return-photo" class="mt-4 hidden object-fit" alt="Bukti Dikembalikan">
                            <input type="hidden" name="return_attachment_data" id="return_attachment_data">
                        </div>

                        <x-submit-button>Setujui Kembali</x-submit-button>
                    </form>
                @endcan
            @endif
        </div>
    </div>

    <style>
        video,
        canvas {
            width: 100%;
            height: auto;
            max-width: 640px;
        }

        /* Style for images */
        .object-fit {
            width: 100%;
            height: auto;
            /* Maintain aspect ratio */
            object-fit: contain;
            /* Fit the image inside the container while preserving aspect ratio */
        }
    </style>

    <script>
        function setupCamera(videoElement, captureButton, canvasElement, photoElement, hiddenInput, toggleFront,
            toggleButton) {
            if (!videoElement || !captureButton || !canvasElement || !photoElement || !hiddenInput || !toggleFront || !
                toggleButton) {
                console.error("One or more elements not found. Ensure all IDs are correct.");
                return;
            }

            let stream = null;
            let usingFrontCamera = false;
            let cameraOn = false;

            function startCamera(facingMode) {
                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode
                        }
                    })
                    .then((newStream) => {
                        stream = newStream;
                        videoElement.srcObject = stream;
                        videoElement.classList.remove('hidden');
                        captureButton.classList.remove('hidden');
                        toggleButton.textContent = "Turn Camera Off";
                        cameraOn = true;
                    })
                    .catch((error) => {
                        console.error("Error accessing camera:", error);
                    });
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                    videoElement.classList.add('hidden');
                    captureButton.classList.add('hidden');
                    toggleButton.textContent = "Turn Camera On";
                    cameraOn = false;
                }
            }

            toggleFront.addEventListener('click', () => {
                usingFrontCamera = !usingFrontCamera;
                if (cameraOn) {
                    stopCamera();
                    startCamera(usingFrontCamera ? "user" : "environment");
                }
            });

            toggleButton.addEventListener('click', () => {
                if (cameraOn) {
                    stopCamera();
                } else {
                    startCamera(usingFrontCamera ? "user" : "environment");
                }
            });

            captureButton.addEventListener('click', () => {
                const context = canvasElement.getContext('2d');
                // Menyesuaikan ukuran canvas berdasarkan ukuran video
                canvasElement.width = videoElement.videoWidth;
                canvasElement.height = videoElement.videoHeight;

                context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
                const dataURL = canvasElement.toDataURL('image/png');
                photoElement.src = dataURL;
                photoElement.classList.remove('hidden');
                hiddenInput.value = dataURL;
            });

        }

        document.addEventListener('DOMContentLoaded', () => {
            const verifyStatus = @json($ijin->verify_status);
            const status = @json($ijin->status);

            if (verifyStatus == 1 && status == 0) {
                setupCamera(
                    document.getElementById('pickup-video'),
                    document.getElementById('capture-pickup'),
                    document.getElementById('pickup-canvas'),
                    document.getElementById('pickup-photo'),
                    document.getElementById('pickup_attachment_data'),
                    document.getElementById('toggle-front-pickup-camera'),
                    document.getElementById('toggle-camera')
                );
            }
            if (verifyStatus == 1 && status == 1) {
                setupCamera(
                    document.getElementById('return-video'),
                    document.getElementById('capture-return'),
                    document.getElementById('return-canvas'),
                    document.getElementById('return-photo'),
                    document.getElementById('return_attachment_data'),
                    document.getElementById('toggle-front-return-camera'),
                    document.getElementById('toggle-camera')
                );
            }
        });
    </script>
</x-app-layout>
