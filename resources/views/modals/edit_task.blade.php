<div class="modal " id="edit_task_{{$task->id}}">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Task</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Task Information</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Subject</label>
                                    <div>
                                        @php
                                            $subject_options = [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'];
                                        @endphp
                                        <select class="select2 select_contact form-control" name="subject" required>
                                            @foreach($subject_options as $key => $subject_option)
                                                <option value="{{$key}}" {{$task->subject == $key? "selected" : ""}}>{{$subject_option}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$task->user_id == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="{{ substr($task->date, 0, strpos($task->date, ' ')) }}" id="" required>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Name</label>
                                    <div>
                                        <select class="select2 select_emails form-control" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $task->contact_id ? "selected" : "" }} >{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$task->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control">{{$task->comments}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Additional Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Priority</label>
                                    <div>
                                        <select class="select2 select_emails form-control" name="priority" required>
                                            <option value="1" {{ $task->priority == 1 ? "selected" : "" }} >Normal</option>
                                            <option value="2" {{$task->priority == 2 ? "selected" : "" }} >High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Status</label>
                                    <div>
                                        <select class="select2 select_emails form-control" name="status" required>
                                            <option value="1" {{ $task->status == 2 ? "selected" : "" }} >Open</option>
                                            <option value="2" {{$task->status == 1 ? "selected" : "" }} >Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Other Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input"  name="reminder_set"
                                     {{ $task->reminder_set?"checked" :""}} id="reminder_set_task" >
                                     <label for="reminder_set_task" class="mr-sm-2">Reminder Set</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input"  name="create_recurring_series_of_tasks"
                                     {{ $task->create_recurring_series_of_tasks?"checked" :""}} id="create_recurring_series_of_tasks" >
                                     <label for="create_recurring_series_of_tasks" class="mr-sm-2">Create Recurring Series of Tasks</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6"> System Information</div>
                        </div>
                        <div class=" mt-2 pt-1 px-2 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div> Created By: {{ Auth::user()->first_name }}. {{$task->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{ Auth::user()->first_name }}. {{$task->updated_at}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>

<div class="modal " id="edit_task_comment{{$task->id}}">
    <div class="modal-dialog mt-5 modal-md">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Comment</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Comment</label>
                                <textarea name="comments" id="" cols="20" rows="5" class="form-control">{{$task->comments}}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal " id="edit_task_date{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Date</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="{{ substr($task->date, 0, strpos($task->date, ' ')) }}" id="" required>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal " id="edit_task_status{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Status</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div>
                            <label for="" class="mr-sm-2">Status</label>
                            <div>
                                <select class="select2 select_emails form-control" name="status" >
                                    <option value="1" {{ $task->status == 1 ? "selected" : "" }} >Open</option>
                                    <option value="2" {{$task->status == 2 ? "selected" : "" }} >Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal " id="edit_task_priority{{$task->id}}">
    <div class="modal-dialog mt-5 modal-sm">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Priority</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_task', [$task->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row mt2">
                            <div>
                                <label for="" class="mr-sm-2">Priority</label>
                                <div>
                                    <select class="select2 select_emails form-control" name="priority" >
                                        <option value="1" {{ $task->priority == 1 ? "selected" : "" }} >Normal</option>
                                        <option value="2" {{$task->priority == 2 ? "selected" : "" }} >High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>