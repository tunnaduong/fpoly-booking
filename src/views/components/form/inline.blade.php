<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Inline forms</h4>
            <p class="card-description">
                Use the <code>.form-inline</code> class to display a series of labels, form controls, and buttons on a
                single horizontal row
            </p>
            <form class="form-inline">
                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">

                <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroupUsername2"
                        placeholder="Username">
                </div>
                <div class="form-check mx-sm-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked>
                        Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>
</div>
