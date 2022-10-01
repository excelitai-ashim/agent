<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    @csrf
                    <button class="btn btn-danger" type="button" data-dismiss="modal"></button>
                    <button class="btn btn-primary" type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="popup-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h2 style="color: rgba(96,96,96,0.68)">
                                <i class="tio-shopping-cart-outlined"></i> You have new order, Check Please.
                            </h2>
                            <hr>
                            <button onclick="check_order()" class="btn btn-primary">Ok, let me check</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
