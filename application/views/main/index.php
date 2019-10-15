<div class="page-content page-container" id="page-content">
    <div class="container d-flex justify-content-center todo-list-container">

        <div class="row container d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="card px-3">
                    <div class="card-body">

                        <?php if($messageSuccess): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $messageSuccess ?>
                            </div>
                        <?php endif; ?>

                        <div class="alert alert-danger" role="alert" id="pageDangerMessage" style="display:none;"></div>

                        <h4 class="card-title">Awesome Todo list</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="add-items d-flex">
                                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" data-toggle="modal" data-target="#newItemModal">Add</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="add-items d-flex justify-content-end">
                                    <button class="add btn btn-primary font-weight-bold logout-button">Logout</button>
                                </div>
                            </div>
                        </div>

                        <!-- FILTER -->
                        <div class="add-items d-flex">
                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control filter-title" placeholder="Title" />
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" class="form-control filter-description" placeholder="Description" />
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="input-group date filter-date-from" id="filter-date-from" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input filter-date-from-input" data-target="#filter-date-from" placeholder="From" />
                                        <div class="input-group-append" data-target="#filter-date-from" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="input-group date filter-date-to" id="filter-date-to" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input filter-date-to-input" data-target="#filter-date-to" placeholder="To"/>
                                        <div class="input-group-append" data-target="#filter-date-to" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <button class="add btn btn-primary font-weight-bold todo-list-filter-btn">Apply</button>
                                </div>
                            </div>
                        </div>

                        <!-- LIST -->
                        <?php if(count($list)): ?>
                            <div class="list-wrapper">
                                <?php $this->partial('partials/task-list', [
                                    'list' => $list,
                                    'user' => $user
                                ]); ?>
                            </div>
                        <?php endif; ?>

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

            <div class="alert alert-danger" id="modalDangerMessage" role="alert" style="display:none;"></div>

            <div class="modal-body">
                <form id="taskForm">
                    <div class="form-group">
                        <label for="itemTitle" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="itemTitle">
                        <div class="invalid-feedback" style="display:none;"></div>
                    </div>
                    <div class="form-group">
                        <label for="itemDescription" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="itemDescription"></textarea>
                        <div class="invalid-feedback" style="display:none;"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary todo-submit">Save changes</button>
            </div>
        </div>
    </div>
</div>
