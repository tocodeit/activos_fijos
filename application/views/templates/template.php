<div class="container-fluid px-5 pt-4">
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center">Sweet Alert</h3>

            <ul class="list-group">
                <li class="list-group-item">
                    <button class="btn btn-block btn-primary" onclick="show_success()">Show Success Message</button>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-10">
                            <p>A custom positioned dialog</p>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" onclick="show_title_error_icon_text_footer()">Try!</button>
                        </div>
                    </div>
                    
                </li>
                <li class="list-group-item">
                    <p>A modal with a title, an error icon, a text, and a footer</p>
                    <button class="btn btn-primary" onclick="posiioned()">Try!</button>
                </li>
                <li class="list-group-item">
                    <p>Custom animation with <a href="https://daneden.github.io/animate.css/" target="_blank">Animate.css <i class="fa fa-external-link"></i></a></p>
                    <button class="btn btn-primary" onclick="animated()">Try!</button>
                </li>
                <li class="list-group-item">
                    <p>A confirm dialog, with a function attached to the "Confirm"-button...</p>
                    <button class="btn btn-primary" onclick="confirm_function()">Try!</button>
                </li>
                <li class="list-group-item">
                    <p>A message with auto close timer</p>
                    <button class="btn btn-primary" onclick="autoclose()">Try!</button>
                </li>
                <li class="list-group-item"><a href="https://sweetalert2.github.io/" target="_blank">Sweet Alert2</a></li>
            </ul>
        </div>
        <div class="col-md-4">        
            <h3 class="text-center">Bootstrap</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <script type="text/javascript">
                            function show_modal_js(x) {
                                $('#exampleModal').modal('show')
                            }
                        </script>                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button>
                        <button type="button" class="btn btn-primary" onclick="show_modal_js()">Launch demo by JS</button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </li>
                </ul>

        </div>
        
    </div>
</div>