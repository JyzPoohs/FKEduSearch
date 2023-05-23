<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Report an issue</h5>
                <p>Found a bug? Let us know</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            
            <!-- Sidenav Type -->
            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Classification</label>
                                    <br>
                                    <div class="form-check mb-3 form-check-inline">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="customRadio1">
                                        <label class="custom-control-label" for="customRadio1">Error</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="customRadio2">
                                        <label class="custom-control-label" for="customRadio2">Improvement</label>
                                    </div>
                                </div>
                </div>
            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Severity</label>
                                    <select class="form-select">
                                        <option selected>Select option</option>
                                        <option value="1">Minor</option>
                                        <option value="2">Moderate</option>
                                        <option value="3">Major</option>
                                    </select>
                                </div>
            </div>
           
            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Describe the issue*</label>
                                    <textarea class="form-control" placeholder="The more information, the better." cols="30" rows="5"></textarea>
                                </div>
            </div>
            
            <div class="text-end mt-2">
                            <button onclick="history.back()" class="btn btn-secondary btn-md ms-auto">Back</button>
                            <button class="btn btn-success btn-md ms-auto">Save</button>
            </div>


        </div>
    </div>
</div>
