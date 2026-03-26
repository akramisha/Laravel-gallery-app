<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stunning Image Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles for Aesthetics */
        body {
            background-color: #f8f9fa; /* Light gray background */
        }

        /* Premium Glass Navbar */
.custom-navbar {
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.6);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}



.navbar-brand {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: #d625a4 !important;
}


        
        .upload-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        .image-card-wrapper {
            margin-bottom: 30px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 8px;
            overflow: hidden; 
        }
        .image-card-wrapper:hover {
            transform: translateY(-5px); 
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .image-card-wrapper img {
            width: 100%;
            height: 250px; 
            object-fit: cover;
            display: block;
        }
        #drop-zone {
            transition: border-color 0.3s, background-color 0.3s;
            border-style: dashed !important;
            border-color: #ced4da !important;
        }
        #drop-zone.border-primary {
            border-color: #d625a4 !important;
            background-color: #e9f0fe;
        }

        .img-container {
            max-width: 100%;
            height: 400px;
        }
        .img-container img {
            max-width: 100%;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-images me-2"></i> Image Gallery
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
    </div>
</nav>

<br>    
<div class="container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <h6>Upload Errors:</h6>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4 mb-5 upload-card">
        <h3 class="card-title  mb-4" style="color: #d625a4">Upload New Images</h3>
        <form id="upload-form" action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <input class="form-control" type="file" id="images" name="images[]" multiple required hidden onchange="previewImages(event)">
            </div>
            
            <div id="drop-zone" class="border border-2 p-5 text-center bg-white rounded" style="cursor: pointer;">
                <p class="lead mb-0 text-muted">**Drag and drop files here** or <span class=" fw-bold" style="color: #d625a4">**click to browse**</span>.</p>
            </div>

            <div id="image-preview-container" class="row my-3 g-2"></div>
            
            <button type="submit" class="btn btn-lg w-100 mt-3" style="background-color: #d625a4; color:white">Upload to Gallery</button>
        </form>
    </div>
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image (Optional)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="imageToCrop" src="" alt="Image to Crop">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="skipCropping()">Skip & Upload Original</button>
                <button type="button" class="btn btn-success" id="cropAndUpload">Crop & Upload</button>
            </div>
        </div>
    </div>
</div>

    <h2 class="mt-5 mb-4 text-secondary">Gallery Images <small class="text-muted fs-5">({{ $images->total() }} total)</small></h2>

    @if ($images->isEmpty())
        <div class="alert alert-info text-center">
            <h4 class="alert-heading">Nothing to see here!</h4>
            <p>Start by using the upload form above to add your first images.</p>
        </div>
    @else
        <div class="row">
            @foreach ($images as $image)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="image-card-wrapper bg-white shadow-sm">
                        {{-- <a href="{{ asset('storage/' . $image->image) }}" target="_blank">
                             <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image" class="img-fluid">
                        </a> --}}
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageViewerModal" data-image-url="{{ asset('storage/' . $image->image) }}">
    <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image" class="img-fluid">
</a>
                        
                        <div class="p-2 text-center">
                            <form action="{{ route('gallery.destroy', $image->id) }}" method="POST">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                        onclick="return confirm('Are you sure you want to permanently delete this image?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $images->links('pagination::bootstrap-5') }}
        </div>
        
    @endif
    
</div>

<div class="modal fade" id="imageViewerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> 
        <div class="modal-content">
            <div class="modal-body p-0 bg-light"> 
                <img id="fullImageViewer" src="" class="img-fluid w-100" style="max-height: 90vh; object-fit: contain; margin: auto; display: block;" alt="Full Size Gallery Image">
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> 
<script src="https://kit.fontawesome.com/your-unique-kit-id.js" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // --- Global Variables and Constants ---
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('images');
    const imageToCrop = document.getElementById('imageToCrop');
    const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
    const uploadForm = document.getElementById('upload-form');
    // **FIXED: Define the image viewer modal constant**
    const imageViewerModal = document.getElementById('imageViewerModal'); 
    
    let cropper;
    let filesToProcess = [];
    let currentFileIndex = 0;
    
    // --- Core File Handling Functions (Cropper Logic) ---
    // (Content remains the same as your working cropper logic)

    // 1. Handles the initial file selection from click or drop
    function handleFileSelection(files) {
        uploadForm.querySelectorAll('input[name="images[]"]:not([hidden])').forEach(input => input.remove());
        filesToProcess = Array.from(files);
        currentFileIndex = 0;
        
        if (filesToProcess.length > 0) {
            processNextFile();
        } else {
            alert('Please select at least one image file.');
        }
    }

    // 2. Processes the next file in the queue (or moves to submit)
    function processNextFile() {
        if (currentFileIndex < filesToProcess.length) {
            const file = filesToProcess[currentFileIndex];
            
            // Check file size (2MB limit)
            if (file.size > 2 * 1024 * 1024) {
                 alert(`The file "${file.name}" is larger than 2MB and will be skipped.`);
                 currentFileIndex++;
                 processNextFile();
                 return;
            }
            
            const reader = new FileReader();
            reader.onload = (e) => {
                imageToCrop.src = e.target.result;
                cropModal.show();
            };
            reader.readAsDataURL(file);
        } else {
            submitCroppedData();
        }
    }
    
    // 3. Adds the processed file (cropped or original) to the form
    function addFileToForm(fileBlob, originalFileName) {
        const fileDataInput = document.createElement('input');
        fileDataInput.type = 'file';
        fileDataInput.name = 'images[]'; 
        
        const dataTransfer = new DataTransfer();
        const file = new File([fileBlob], `upload-${Date.now()}-${originalFileName}`, { type: fileBlob.type });
        dataTransfer.items.add(file);
        
        fileDataInput.files = dataTransfer.files;
        fileDataInput.style.display = 'none';
        
        uploadForm.appendChild(fileDataInput);
    }
    
    // 4. Submits the form with the new file inputs
    function submitCroppedData() {
        if (uploadForm.querySelectorAll('input[name="images[]"]').length > 0) {
            uploadForm.submit();
        } else {
            alert('No valid images were prepared for upload.');
        }
    }
    
    // --- Cropper.js Event Handlers ---
    document.getElementById('cropModal').addEventListener('shown.bs.modal', function () {
        if (cropper) {
            cropper.destroy();
        }
        cropper = new Cropper(imageToCrop, {
            aspectRatio: 16 / 9, 
            viewMode: 1,
            autoCropArea: 0.8,
        });
    });

    document.getElementById('cropAndUpload').addEventListener('click', function () {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob((blob) => {
                addFileToForm(blob, filesToProcess[currentFileIndex].name);
                cropModal.hide();
                currentFileIndex++;
                processNextFile();
            }, filesToProcess[currentFileIndex].type);
        }
    });

    function skipCropping() {
        const originalFile = filesToProcess[currentFileIndex];
        addFileToForm(originalFile, originalFile.name);
        cropModal.hide();
        currentFileIndex++;
        processNextFile();
    }
    
    // --- Drag-and-Drop and Click Handlers (Simplified) ---
    
    // Click-to-browse functionality
    dropZone.addEventListener('click', () => fileInput.click());

    // Handle file input change (Click to select logic)
    fileInput.onchange = (e) => {
        handleFileSelection(e.target.files);
        e.target.value = null; 
    };
    
    // Handle dropped files (Drag-and-Drop logic)
    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
      let dt = e.dataTransfer
      handleFileSelection(dt.files);
    }
    
    // Prevent default drag behaviors and highlight the drop zone
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, preventDefaults, false)   
    });
    
    function preventDefaults (e) {
      e.preventDefault()
      e.stopPropagation()
    }

    ['dragenter', 'dragover'].forEach(eventName => {
      dropZone.addEventListener(eventName, () => dropZone.classList.add('border-primary'), false)
    });

    ['dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-primary'), false)
    });
    
    // --- Image Viewer Modal Logic (The Fix) ---
    imageViewerModal.addEventListener('show.bs.modal', event => {
        // **FIXED:** Use event.relatedTarget to get the element that triggered the modal
        const button = event.relatedTarget; 
        
        // Extract info from data-image-url attribute
        const imageUrl = button.getAttribute('data-image-url');
        
        // Update the modal's image source
        const modalImage = imageViewerModal.querySelector('#fullImageViewer');
        modalImage.src = imageUrl;
    });

</script>
</body>
</html>