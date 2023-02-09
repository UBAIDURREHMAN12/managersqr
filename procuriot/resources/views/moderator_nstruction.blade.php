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
                            Edit Venue
                            <ul>
                                <li>
                                    Click on "Venues" option from sidebar.
                                </li>
                                <li>
                                    Click on "Edit" icon under "Action" in table data.
                                </li>

                                <li>
                                    view and update information as per requirement
                                </li>
                                <li>
                                    press "update" button
                                </li>
                                <li>
                                    wait for system response. it will update Venue
                                </li>
                            </ul>
                        </li>

                        <li>
                            Edit Beacon
                            <ul>
                                <li>
                                    Click on "Beacons" option from sidebar.
                                </li>
                                <li>
                                    Click on "Edit" icon under "Action" in table data.
                                </li>

                                <li>
                                    view and update information as per requirement
                                </li>
                                <li>
                                    press "update" button
                                </li>
                                <li>
                                    wait for system response. it will update Beacon
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <a href="https://procuriot.ioptime.com/venues/list/for/moderator" class="btn btn-sm" style="color: white;font-size: 14px;background-color: #6860FF;">Start</a>
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