<!DOCTYPE html>
<html>

<head>
    <!-- ini head -->
    @include('frontpage.templates.head')

</head>

<body>

    <div class="body">
        <!-- ini header -->
        @include('frontpage.templates.header')

        <div role="main" class="main">
            <!-- ini header -->
            @include('frontpage.sections.page_header')

            <div class="container py-4">
                <h4 class="mb-3">Kritik dan Saran Anda berharga bagi perbaikan kami.</h4>
                <div class="row mb-5">
                    <div class="col">
                        <form id="commentForm">
                            @csrf
                            <div id="responseMessage" class="justify-content-center text-center"></div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label class="required font-weight-bold text-dark text-2">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="required font-weight-bold text-dark text-2">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="font-weight-bold text-dark text-2">Subjek</label>
                                    <input type="text" name="subject" id="subject" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="required font-weight-bold text-dark text-2">Pesan</label>
                                    <textarea rows="5" class="form-control" name="message" id="message"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <button type="submit" class="btn btn-success btn-modern">Kirim</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>


        </div>
        <!-- ini footer -->
        @include('frontpage.templates.footer')
    </div>

    <!-- ini js -->
    @include('frontpage.templates.js')
</body>

</html>