<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="container">
    <div class="row d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4><i class="fa fa-sitemap"></i> Sitemap Generator</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <script>
                            $(document).ready(function () {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ session('success') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                        </script>
                    @endif
                    <form action="{{ route('generate.sitemap') }}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="url" class="form-label"><i class="fa fa-globe"></i> Enter Website
                                    URL</label>
                                <input type="url" class="form-control" name="url" id="url"
                                       placeholder="https://example.com" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fa fa-cogs"></i> Generate Sitemap
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('download.sitemap') }}" class="btn btn-warning w-100 mt-2 mb-2" id="downloadBtn">
                        <i class="fa fa-download"></i> Download Sitemap
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#downloadBtn').click(function (event) {
            event.preventDefault();
            let downloadUrl = $(this).attr('href');
            $.ajax({
                url: downloadUrl,
                type: 'GET',
                success: function (response, status, xhr) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Sitemap downloaded successfully!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        window.location.href = downloadUrl;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Sitemap not found!',
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'An error occurred while downloading!',
                    });
                }
            });
        });
    });
</script>
</body>
</html>
