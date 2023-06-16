<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary">Feedback</h3>
                        <p class="mb-0">Enter your feedback for the expert's answer</p>
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action={{ route('feedback.store') }}
                            enctype="multipart/form-data">
                            @csrf
                            <label>Description</label>
                            <input type="hidden" name="post_id" value="{{ $data->id }}">
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="feedback" cols="30" rows="5"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
