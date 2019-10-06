<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Awesome Todo list</h4>
                        <div class="add-items d-flex">
                            <button class="add btn btn-primary font-weight-bold todo-list-add-btn" data-toggle="modal" data-target="#newItemModal">Add</button>
                        </div>
                        <div class="add-items d-flex"> <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                            <button class="add btn btn-primary font-weight-bold todo-list-add-btn">Apply</button>
                        </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> For what reason would it be advisable. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> For what reason would it be advisable for me to think. <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> it be advisable for me to think about business content? <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> Print Statements all <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox" checked=""> Call Rampbo <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                                <li>
                                    <div class="form-check"> <label class="form-check-label"> <input class="checkbox" type="checkbox"> Print bills <i class="input-helper"></i></label> </div> <i class="remove mdi mdi-close-circle-outline"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newItemModalLabel">New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="itemTitle" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="itemTitle">
                    </div>
                    <div class="form-group">
                        <label for="itemDescription" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="itemDescription"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
