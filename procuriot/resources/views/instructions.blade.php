@include('components.head')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<style>
    #geomap{
        width: 100%;
        height: 400px;
    }
</style>
@include('components.navbar')
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
@include('components.sidebar')
<!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
@include('components.rightsidebar')
<!-- #END# Right Sidebar -->
</section>

<section class="content">
    <div class="modal" id="instructionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dashboard usage guideline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            Add Venue
                            <ul>
                                <li>
                                    Enter venue name
                                </li><li>
                                    Enter venue description
                                </li>
                                <li>
                                    Search for location and select from suggestion
                                </li>
                                <li>
                                    Press add button
                                </li>
                            </ul>
                        </li>
                        <li>
                            Add Gateway

                            <ul>
                                <li>
                                    Click on gateway option from left sidebar
                                </li><li>
                                    Click on " Add Gateway " button from top right of page
                                </li>
                                <li>
                                    Enter device title , mac address, and select location and press add button
                                </li>
                                <li>
                                    Press add button
                                </li>
                            </ul>

                        </li>
                        <li>
                            Add Beacon
                            <ul>
                                <li>
                                    Click on gateway option from left sidebar
                                </li>
                                <li>
                                    Click on Add beacon button under action heading
                                </li>
                                <li>
                                    On next page click on " Add Beacon " button
                                </li>
                                <li>
                                    Enter mac address, Product Title, Tag line, Description
                                </li>
                            </ul>
                        </li>
                        <li>
                            Add Admin
                            <ul>
                                <li>
                                    Click on "Add Admin" button from right side
                                </li>
                                <li>
                                    Enter first name, last name, email, contact number and address
                                </li>
                                <li>
                                   press "Add" button
                                </li>
                                <li>
                                    wait for system response. it will add new admin
                                </li>
                            </ul>
                        </li>
                        <li>
                            Add Moderator
                            <ul>
                                <li>
                                    Click on "Add Moderator" button from right side
                                </li>
                                <li>
                                    Enter first name, last name, email, contact number and address
                                </li>
                                <li>
                                    press "Add" button
                                </li>
                                <li>
                                    wait for system response. it will add new moderator
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="https://procuriot.ioptime.com/venues" class="btn btn-sm" style="color: white;font-size: 14px;background-color: #6860FF;">Start</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $("#instructionModal").modal('show');
    });
</script>

@include('components.footer')