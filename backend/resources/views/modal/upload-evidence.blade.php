<div class="modal fade login-modal" id="upload-form" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <!--<div class="logo-area">
                    <img class="logo" src="assets/images/logo.png" alt="">
                </div>-->
                <div class="header-area">
                    <h2 class="title" style="font-size: 14px">UPLOAD YOUR EVIDENCE FOR MATCH EVALUATION</h2>
                    <p class="text-danger">
                        <i class="fa fa-alert"></i> Choose evidence files wisely because you cannot change after submit and only one member can upload once per match
                    </p>
                </div>
                <div class="form-area">
                    <form action="{{route('evidence.upload')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-2">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="customFile" required>
                                <label class="custom-file-label w-100" for="customFile">Choose Image Evidence</label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="custom-file">
                                <input type="file" name="video" class="custom-file-input" id="customFile" required>
                                <label class="custom-file-label w-100" for="customFile">Choose Video Evidence</label>
                            </div>
                        </div>

                        <div>
                            <input type="hidden" name="team" value="" id="e-team-id">
                            <input type="hidden" name="match_id" value="" id="e-match-id">
                            <button type="submit" class="mybtn1">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



