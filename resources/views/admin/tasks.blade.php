<link rel="stylesheet" href="{{asset('/public/admin/css/bootstrap-editable.css')}}">
<link rel="stylesheet" href="{{asset('/public/admin/css/font-awesome.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




<div class="row">
    <div class="col-md-6">
        <div class="card card-tasks">
            <div class="card-header ">
                <h4 class="card-title">Tasks</h4>
                <p class="card-category">To Do List</p>
            </div>
            <div class="card-body ">
                <div class="table-full-width">
                    <table id="task-table" class="table">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Due Date</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="extrarow">
                                <td><a href="#" class="xadd" data-pk="" data-name="task_details">Add Task</td>
                                <td><a href="#" class="xadd" data-pk="" data-name="due_date" data-type="date">&nbsp;</td>
                                <td class="td-actions text-right">
                                    <div class="form-button-action">

                                    </div>
                                </td>
                            </tr>
                            @foreach ($tasks as $task)
                            <tr>
                                <td><a href="#" class="xedit" data-pk="{{$task->id}}" data-name="task_details">{{$task->task_details}}</td>
                                <td><a href="#" class="xedit" data-pk="{{$task->id}}" data-name="due_date" data-type="date">{{$task->due_date}}</td>
                                <td class="td-actions text-center">
                                    <div class="form-button-action">
                                        {{-- <button type="button" data-toggle="tooltip" title="Edit Task" class="btn btn-link <btn-simple-primary">
                                            <i class="la la-edit"></i>
                                        </button> --}}
                                        <button data-pk="{{$task->id}}" onclick="taskRemove({{$task->id}})" type="button" data-toggle="tooltip" title="Remove" class="btn btn-link btn-simple-danger remove">
                                            <i class="la la-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer ">
                <div id="task-alert" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                    
                  </div>
            </div>
        </div>
    </div>
</div>